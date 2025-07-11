<?php
namespace business;
use business\Destination;
require 'Destination.php';
class Miscellaneous
{

    public function __construct()
    {
    }

    public function uploadFile(string $directory, $file, $filename): bool
    {
        $target_file = $directory . $filename;
        if (move_uploaded_file($file["file"]["tmp_name"], $target_file)) {
            return true;
        } else {
            return false;
        }
    }

    public function getDistance(float $lon1, float $lat1, float $lon2, float $lat2): float
    {
        $distance = .0;
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

    public function googleGetDistance( $lon1,  $lat1,  $lon2,  $lat2)
    {
        $distance = -1;
        // The Google Maps Distance Matrix API URL
        $point1=$lat1.",".$lon1;
        $point2=$lat2.",".$lon2;
        $key="AIzaSyB0nKwKyFJ6bQuyVew-RGf12E8tRM-7Eyc";
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$point1."&destinations=".$point2."&units=metric&key=".$key;
            //"https://maps.googleapis.com/maps/api/distancematrix/json?origins=53.9962218,-6.377908&destinations=53.9962218,-6.377908&key=AIzaSyB0nKwKyFJ6bQuyVew-RGf12E8tRM-7Eyc";

            //"https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $lat1 . ", " . $lon1 . "&destinations=" . $lat2 . "," . $lon2 . "&key=AIzaSyB0nKwKyFJ6bQuyVew-RGf12E8tRM-7Eyc";

        // Use cURL to send a request to the API
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        // Decode the JSON response
        $data = json_decode($response, true);

        // Check if the response has 'rows' and 'elements' to extract the distance
        if (isset($data['rows'][0]['elements'][0]['distance']['text'])) {
            $destination= new Destination();
            $distance = $data['rows'][0]['elements'][0]['distance']['text'];
            $destination->Destination($distance,null,null );
            if(isset($data['rows'][0]['elements'][0]['duration']['text'])){
                $duration = $data['rows'][0]['elements'][0]['duration']['text'];
                $destination->setDuration($duration);
            }
            if(isset($data['destination_addresses'][0])){
                $address=$data['destination_addresses'][0];
                $destination->setAddress($address);
            }
            return $destination;
        } else {
            return null;
        }

    }

    public function verifyDistance(int $maxDistance, string $distance):bool
    {
       $distanceArray= explode(" ", $distance);
       if($distanceArray[1]=="m"){
          $km= $distanceArray[0]/1000;
          if($km<=$maxDistance){
              return true;
          }
       }else if($distanceArray[1]=="km"){
           if($distanceArray[0]<=$maxDistance){
               return true;
           }
       }
       return false;
    }
}

//$m = new Miscellaneous();
$myLat = "53.9962218";
$myLong = "-6.377908";
//$lat1 = deg2rad($myLat);
//$lon1 = deg2rad($myLong);
//phpinfo();
//$d = $m->googleGetDistance($myLong, $myLat, $myLong, $myLat);
//$d=$m->verifyDistance(30,$d->getDistance());
//var_dump($d);
//echo $d;
//https://maps.googleapis.com/maps/api/distancematrix/json?origins=53.9962218,-6.377908&destinations=53.9962218,-6.377908&key=AIzaSyB0nKwKyFJ6bQuyVew-RGf12E8tRM-7Eyc