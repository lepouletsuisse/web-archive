<?php
require_once "C:/laragon/www/ToornamentFinal/library/globalLibrary/Request/Requests.php";
Requests::register_autoloader();

$API_KEY_TOORNAMENT = "";
$CLIENT_ID = "";
$CLIENT_SECRET = "";

$GLOBAL_URL_TOORNAMENT = "https://api.toornament.com/";

$OAUTH = "";

//OAUTH
function callOAuth(){
    global $OAUTH, $CLIENT_ID, $CLIENT_SECRET;
    $OAUTH = json_decode(sendRequestToornament("oauth/v2/token", array(
        "grant_type" => "client_credentials",
        "client_id" => $CLIENT_ID,
        "client_secret" => $CLIENT_SECRET),
        array(), "POST")
        ->body)->access_token;
}


function sendRequestToornament($endpoint, $param = array(), $innerQuery = array(), $methode = "GET")
{
    global $GLOBAL_URL_TOORNAMENT, $API_KEY_TOORNAMENT, $OAUTH;

    if($OAUTH == "" && $endpoint != "oauth/v2/token") callOAuth();

    $url = $GLOBAL_URL_TOORNAMENT . $endpoint;
    $data = $param;
    $header = array('Content-Type' => 'application/json', 'X-Api-Key' => $API_KEY_TOORNAMENT, 'Authorization' => 'Bearer ' . $OAUTH);

    if (empty($innerQuery)) {
        $query = "";
    } else {
        $queryParam = "?";
        foreach ($innerQuery as $key => $value) {
            $queryParam .= $key . "=" . $value . "&";
        }
        $query = substr($queryParam, 0, strlen($queryParam) - 1);
    }

    if ($methode == "POST") {
        return Requests::post($url . $query, $header, json_encode($data));
    } elseif ($methode == "GET") {
        return Requests::get($url . $query, $header);
    } elseif($methode == "PATCH"){
        return Requests::patch($url, $header, json_encode($data));
    }
    else {
        echo "Erreur de methode!!";
        exit(1);
    }

}