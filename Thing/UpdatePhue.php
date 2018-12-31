<?php
namespace Modules\Phue\Thing;

use App\Models\Thing;
use App\Models\Room;
/**
 * Class UpdatePhue
 */
class UpdatePhue
{
    /**
     * @var
     */
    private $data;
   
    /**
     * CreatePhue constructor.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Updates Thing
     */
    public function update(){
        $thingID = $this->data['thingID'];
        $thingName = $this->data['thingname'];
        $thingType = 'Light';
        $binding = $this->data['binding'];
        $roomID = $this->data['room'];
        $json = $this->data['json'];
        $protocol = 'upnp';


        if(empty($json->ip) ){
            Thing::where('id', $thingID)
                ->update(
                    [
                        'thing' => $thingName,
                        'thingType' => $thingType,
                        'binding' => $binding,
                        'protocol' => $protocol,
                        'room_id' => $roomID
                    ]);
                    return;
        }
        
        Thing::where('id', $thingID)
                ->update(
                    [
                        'thing' => $thingName,
                        'thingType' => $thingType,
                        'binding' => $binding,
                        'protocol' => $protocol,
                        'ip' => $json->ip,
                        'room_id' => $roomID
                    ]);
    }
}
