/*===========Maxmentor===========*/
/*=======www.maxmentor.in========*/
/*======Telegram @maxmentor========*/
/*===========Github @maxmentor===========*/


<?php

/*  Fill this with your actual access token */
$x_access_token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJwbGF0Zm9ybV9jb2RlIjoiV2ViQCQhdDM4NzEyIiwiaXNzdWVkQXQiOiIyMDI0LTExLTI5VDAzOjUxOjA5LjE1MVoiLCJwcm9kdWN0X2NvZGUiOiJ6ZWU1QDk3NSIsInR0bCI6ODY0MDAwMDAsImlhdCI6MTczMjg1MjI2OX0.qz0KXk3yOMwoVAt9xZq6xs5ZdXvm38Wzbb1T7ytOj8Q";
$authorization_token = "bearer eyJraWQiOiJkZjViZjBjOC02YTAxLTQ0MWEtOGY2MS0yMDllMjE2MGU4MTUiLCJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJzdWIiOiJFMjM4Qzg2Ri1DODhFLTQ3RjMtOTI4NC00MDIyQTE3QzE1OUMiLCJkZXZpY2VfaWQiOiJiMTY0MmZkZS0wOGRlLTQzMjgtYTU0OS1kZjE4NjJkOTBlZDEiLCJhbXIiOlsiZGVsZWdhdGlvbiJdLCJ0YXJnZXRlZF9pZCI6dHJ1ZSwiaXNzIjoiaHR0cHM6Ly91c2VyYXBpLnplZTUuY29tIiwidmVyc2lvbiI6MTAsImNsaWVudF9pZCI6InJlZnJlc2hfdG9rZW4iLCJhdWQiOlsidXNlcmFwaSIsInN1YnNjcmlwdGlvbmFwaSIsInByb2ZpbGVhcGkiLCJnYW1lLXBsYXkiXSwidXNlcl90eXBlIjoiUmVnaXN0ZXJlZCIsIm5iZiI6MTczMjg5MjE4MywidXNlcl9pZCI6ImUyMzhjODZmLWM4OGUtNDdmMy05Mjg0LTQwMjJhMTdjMTU5YyIsInNjb3BlIjpbInVzZXJhcGkiLCJzdWJzY3JpcHRpb25hcGkiLCJwcm9maWxlYXBpIl0sInNlc3Npb25fdHlwZSI6IkdFTkVSQUwiLCJleHAiOjE3MzMyMzc3ODMsImlhdCI6MTczMjg5MjE4MywianRpIjoiZDUzY2M0OTctM2JkOC00MDUyLTg2ZjctNDczNWZhNzk4ZGU5In0.ajNSf4r-CYUZ9u2WYNkebr-IJlH5TgfBC26r7NUI7yyiv2s29AqVwltasC-22CeBvnX2drT0tTdghmU7Up2JxCghmbs4xJXIJl0bkzj5Hco3xKImQNcCB5s1amFWyMgvNyCnmKKHUsSYvMY0E6F2WAtkhLDqbXdrDR2xSOBKYlAFT4JNvOrNxCbwiZWJ_zF2icLnNIN9i2w7QSu6ETwUN6QIuFq248Dshw3TN8xOKyznS-vo20E7CIQx5GP5dpO33pYSUMdegOpK-NvrHxNtrLgXJqHBnhGDllwGJtybmke7E-sNNM2sMJ3Uvftnorl05VEwduvk0OGCoF2t747Exg";

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
