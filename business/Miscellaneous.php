<?php

class Miscellaneous
{

    public function __construct()
    {
    }
    public function uploadFile(string $directory, $file,$filename):bool{
        $target_file = $directory . $filename;
        if (move_uploaded_file($file["file"]["tmp_name"], $target_file)) {
  return true;
        }
        else{
            return false;
        }
    }

    public function getDistance(float $lon1,float $lat1,float $lon2, float $lat2):float{
        $distance=.0;
        //convert to radians
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
         $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);
        $earth_radius = 6371.0;
        // Differences in coordinates
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;
        // Haversine formula
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earth_radius * $c;
        return $distance;
    }
}
/*$m=new Miscellaneous();
$myLat=53.9962218;
$myLong=-6.377908;
$lat1 = deg2rad($myLat);
$lon1 = deg2rad($myLong);
$d=$m->getDistance($lon1,$lat1,$lon1,$lat1);
echo $d;*/
