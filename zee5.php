<?php

$curl = curl_init();
$channel =$_GET['c'];

$url="https://spapi.zee5.com/singlePlayback/getDetails/secure?channel_id=$channel";

curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "x-access-token": "",  
  "Authorization": ""
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));


$response = curl_exec($curl);
curl_close($curl);

$zx = json_decode($response, true);
$image= $zx["assetDetails"]['image_url'];
$img = str_replace('270x152', '1170x658', $image);
$title= $zx["assetDetails"]['title'];
$des= $zx["assetDetails"]['description'];
$playit= $zx["keyOsDetails"]['video_token'];



header("Location: $playit");

?>
