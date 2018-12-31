<?php
namespace Modules\Phue\Thing;

use App\Models\Thing;
use App\Models\Room;
/**
 * Class CreatePhue
 */
class CreatePhue 
{
    /**
     * @var
     */
    private $data;
   
    /**
     * CreateSonos constructor.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Creates Thing
     */
    public function create(){
        $thingName = $this->data['thingname'];
        $thingType = 'Light';
        $binding = $this->data['binding'];
        $roomID = $this->data['room'];
        $json = json_decode($this->data['json']);
        $protocol = 'upnp';

        if(is_null($json->ip) ){
            return "Arguments missing";
        }
        
        $thing = new Thing;

        $thing->thing = $thingName;
        $thing->thingType = $thingType;
        $thing->binding = $binding;
        $thing->protocol = $protocol;
        $thing->ip = $json->ip;
        $thing->room_id = $roomID;
        $thing->state = 'OFF';
        
        $thing->save();

    }
}
