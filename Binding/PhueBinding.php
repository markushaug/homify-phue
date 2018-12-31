<?php

namespace Modules\Phue\Binding;

/**
 * Class PhueBinding
 * @package App\Binding\Phue
 */
class PhueBinding
{

    protected $Bridge_IP;
    protected $client;
    protected $meta;

    /**
     * PhueBinding constructor.
     * @param        $Phue_IP
     * @param string $Phue_Port
     */
    public function __construct($meta)
    {
        $this->Bridge_IP = $meta->ip;
        $this->meta = $meta;

        try {
            $isAuthenticated = (new \Phue\Client($this->Bridge_IP, env('PHUE_USER',"default")))->sendCommand(new \Phue\Command\IsAuthorized);
        } catch (\Exception $e) {
            //throw $th;
            $isAuthenticated = false;
            retry;
        }
       
        // if not -> create one
        if (!$isAuthenticated){
            // Push the bridge's link button prior to running this
            try {
                $createUser = new \Phue\Command\CreateUser("HOMIFY");
                $response = $createUser->send(new \Phue\Client($this->Bridge_IP));

                $this->setEnv("PHUE_USER",$response->username);
            } catch (\Phue\Transport\Exception\LinkButtonException $e) {
                throw new \Exception('Not authorized. Please press the link button and try it again.');
            }
        }
        $this->client = new \Phue\Client($this->Bridge_IP, env('PHUE_USER'));
    }

    public function on()
    {
        $this->getLightByName()->setOn(true);
    }

    public function off()
    {
        $this->getLightByName()->setOn(false);
    }
    
    public function getStatus(){
        return $this->getLightByName()->isOn();
    }

    public function setBrightness($level){
        $this->getLightByName()->setBrightness($this->per2bin($level));
    }

    public function getBrightness(){
        return $this->bin2per($this->getLightByName()->getBrightness());
    }

    private function getLightByName(){
        $lights = $this->client->getLights();
        foreach ($lights as $light) {
            if($light->getName() == $this->meta->thing){
                return $light;
            }
        }
        return false;
    }

    private function bin2per($bin){
        return (int) $bin*100/255;
    }

    private function per2bin($perc){
        return (int) 255*$perc/100;
    }

    private function setEnv($name, $value)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                $name . '=' . env($name), $name . '=' . $value, file_get_contents($path)
            ));
        }
    }
}
