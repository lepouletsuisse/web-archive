<?php
session_start();

require_once "library/tournamentCode/TournamentCode.php";
require_once "library/toornament/Toornament.php";

// Constante
$PARTICIPANT_FILENAME = "participants.json";
$OUTPUT_FILENAME = "outputParticipants.csv";


/* Main ------------------------------------------------------------------------------------------------------------- */
// State 1: Create the tournament
echo "Creating the tournament...</br>";
$retToornamentCreate = json_decode(sendRequestToornament("v1/tournaments", array(
    "discipline" => "leagueoflegends",
    "name" => "Festigeek2016",
    "size" => 24,
    "participant_type" => "team",
    "full_name" => "Phase de poule",
    "organization" => "Festigeek",
    "website" => "www.festigeek.ch",
    "date_start" => "2016-05-07",
    "date_end" => "2016-05-08",
    "timezone" => "Europe/Zurich",
    "online" => false,
    "public" => false,
    "location" => "Yverdon-les-Bains",
    "country" => "CH",
    "check_in" => false,
    "participant_nationality" => false,
    "match_format" => "one"
), array(), "POST")->body);
$tournamentId = $retToornamentCreate->id;
echo "Tournament created!</br>";

// Step 2: Create the participants
echo "Pushing the participants!</br>";
$particpantsContent = json_decode(file_get_contents($PARTICIPANT_FILENAME));
$resultToFile = "";
foreach ($particpantsContent as $participant){
    $result = json_decode(sendRequestToornament("v1/tournaments/$tournamentId/participants", $participant, array(), "POST")->body);
    $resultToFile .= $result->name . ";" . $result->id . "\n";
}
file_put_contents($OUTPUT_FILENAME, $resultToFile);
echo "Participants done (with the output file)!</br>";

$_SESSION['tournamentId'] = $tournamentId;

echo "<span id = 'buttonNext'><div>Set the match structure and the seeding of participant before next step...</div><button onclick='addTournamentCode()'>Next step</button></span>";



