<?php
session_start();

require_once "library/tournamentCode/TournamentCode.php";
require_once "library/toornament/Toornament.php";

//$tournamentIdToornament = $_SESSION['tournamentId'];
$tournamentIdToornament = "572dedf4150ba01a158b4567";

$REGION = "EUW";
$CALLBACK_URL = "";

$providerId = 508;
$tournamentId = 17049;

$COUNT = 4*10;

$CACHE = 0;
$CACHE_FILENAME = "TournamentCode_cache.txt";

//State 0: Creating the tournament codes
echo "Creating $COUNT tournaments codes...</br>";
//$providerId = sendRequestTournamentcode('tournament/public/v1/provider/', array('region' => $REGION, 'url' => $CALLBACK_URL))->body;
//$tournamentId = sendRequestTournamentcode('tournament/public/v1/tournament/', array('providerId' => $providerId, 'name' => "Tournament test"))->body;
if($CACHE == 0){
    $tournamentCode = sendRequestTournamentcode('tournament/public/v1/code/', array('teamSize' => 5, 'spectatorType' =>
        'LOBBYONLY', 'pickType' => 'TOURNAMENT_DRAFT', 'mapType' => 'SUMMONERS_RIFT', 'metadata' => 'Tournament code for Festigeek'),
        array('tournamentId' => $tournamentId, 'count' => $COUNT))->body;
    $tournamentCode = json_decode($tournamentCode);
    file_put_contents($CACHE_FILENAME ,json_encode($tournamentCode));
}else{
    $tournamentCode = json_decode(file_get_contents($CACHE_FILENAME));
}

echo "$COUNT Tournament codes created with success!</br>";

// Step 1: push the Tournament codes in the games
//Retrieve all the matches id
$matches = json_decode(sendRequestToornament("v1/tournaments/$tournamentIdToornament/matches")->body);
$i = 0;
foreach ($matches as $match){
    if($i != 0 && $i%10 == 0){
        sleep(3);
    }
    $request = sendRequestToornament("v1/tournaments/$tournamentIdToornament/matches/".$match->id, array(
        "note" => $tournamentCode[$i++],
        "private_note" => ""
    ),array(), "PATCH");
    if($request->status_code == "429") echo $request->status_code. " => ".$request->body."</br>";
}
echo "Done";
