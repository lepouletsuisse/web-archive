<?php
require_once "C:/laragon/www/ToornamentFinal/library/globalLibrary/Request/Requests.php";
Requests::register_autoloader();

$API_KEY_PRODUCTION = "";

$GLOBAL_URL_TOURNAMENTCODE = "https://global.api.pvp.net/";
$REGION = "EUW";
$CALLBACK_URL = "http://lepouletsuisse.ch";

// Script : http://pastebin.com/XJArc7Lz

function sendRequestTournamentcode($endpoint, $param = array(), $innerQuery = array())
{
    global $GLOBAL_URL_TOURNAMENTCODE, $API_KEY_PRODUCTION;

    $url = $GLOBAL_URL_TOURNAMENTCODE . $endpoint;
    $data = $param;
    $queryParam = "?";
    foreach ($innerQuery as $key => $value) {
        $queryParam .= $key . "=" . $value . "&";
    }
    $noJson = substr($queryParam,0,strlen($queryParam) - 1);
    $header = array('Content-Type' => 'application/json', 'X-Riot-Token' => $API_KEY_PRODUCTION);
    return Requests::post($url.$noJson, $header, json_encode($data));

}