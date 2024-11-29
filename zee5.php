/*===========Maxmentor===========*/
/*=======www.maxmentor.in========*/
/*======Telegram @maxmentor========*/
/*===========Github @maxmentor===========*/


<?php

/*  Fill this with your actual access token */
$x_access_token = "";
$authorization_token = "";

if (isset($_GET["id"])) {
    $channel = $_GET["id"];
} else {
    exit("Error: Channel ID not found.");
}

$curl = curl_init();

$url="https://spapi.zee5.com/singlePlayback/getDetails/secure?channel_id=$channel&device_id=9bea555b-c43b-47dd-b02b-40476086152f&platform_name=desktop_web&translation=en&user_language=en,hi,hr,pa&country=IN&state=DL&app_version=4.14.2&user_type=premium&check_parental_control=false&gender=Unknown&version=12";

curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "application/json",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => '{
        "x-access-token": "' . $x_access_token. '",
        "Authorization": "' . $authorization_token . '"
    }',
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ],
]);

$response = curl_exec($curl);

if ($response === false) {
    exit("cURL Error: " . curl_error($curl));
}

curl_close($curl);

$zx = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    exit("JSON Decode Error: " . json_last_error_msg());
}

if (isset($zx["keyOsDetails"]) && isset($zx["keyOsDetails"]["video_token"])) {
    $playit = $zx["keyOsDetails"]["video_token"];

    header("Location: $playit");
} else {
    exit("Error: Api Response Error.");
}

?>
