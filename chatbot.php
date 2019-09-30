
<?php

$lat=(string)$_GET['lat'];
$long=(string)$_GET['long'];
/*$msg=array("messages"=>array(["text"=>$lat],["text"=>$long]));
echo json_encode($msg);*/

$url="https://api.openweathermap.org/data/2.5/weather?lat=".$lat."&lon=".$long."&units=metric"."&APPID=7077abc65cdb45d9c496bc2e25598219";
/*$msg=array("messages"=>array(["text"=>$url]));
echo json_encode($msg);*/

$ch=curl_init($url);
$options = array(
CURLOPT_RETURNTRANSFER => true,
);
curl_setopt_array( $ch, $options );
$result =json_decode(curl_exec($ch)) ;

$place=(string)"Place: ".$result->name;
$country="Country: ".$result->sys->country;
$long="Longitude: ".$result->coord->lon;
$lat="Latitude: ".$result->coord->lat;
$temp="Temperature: ".$result->main->temp." °Celsius";

$desc="Description: " .$result->weather[0]->description;
$icon=$result->weather[0]->icon;

$url2="http://openweathermap.org/img/w/".$icon.".png";

$msg1=array("messages"=>array(["text"=>$place],["text"=>$country],["text"=>$lat],["text"=>$long],["text"=>$temp],["text"=>$desc]));
$msg2=array("messages"=>array(["attachment"=>["type"=>"image","payload"=>["url"=>$url2]]]));
echo json_encode($msg1);
echo json_encode($msg2);

?>


