<?php


namespace Modules\Phue\Thing;

use App\Things\Light\Light;
use Modules\Phue\Binding\PhueBinding;


/**
 * Class Phue
 * @package App\Things\Light
 */
class Phue extends Light
{

    public function __construct($meta)
    {
        try {
            $this->thing = new PhueBinding($meta);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
        $this->channels = $this->getChannels($this);
        $this->meta = $meta;
    }

    public function on($lv_cmd = null)
    {
        $this->thing->on();
        $this->setStatus('ON');
    }

    public function off($lv_cmd = null)
    {
        $this->thing->off();
        $this->setStatus('OFF');
    }


    public function output()
    {
        switch ($this->thing->getStatus()) {
            case
            true:
                return 1;
                break;
            case false:
                return 0;
                break;
            default:
                return 0;
                break;
        }
        return true;
    }

    public function discover()
    {
        // TODO: Implement discover() method.
    }

    public function onSuccess()
    {
        // TODO: Implement onSuccess() method.
    }

    public function setBrightness()
    {
        $this->thing->setBrightness($this->getInput());
    }

    public function getBrightness()
    {
        return $this->thing->getBrightness();
    }

    
}
