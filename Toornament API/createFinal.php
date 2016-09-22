<?php
session_start();

require_once "library/tournamentCode/TournamentCode.php";
require_once "library/toornament/Toornament.php";

class Player{
    var $name;

    function Player($name){
        $this->name = $name;
    }
}

class Team{
    var $players;
    var $points;
    var $name;
    var $id;

    function Team($name, $id) {
        $this->players = array();
        $this->points = 0;
        $this->name = $name;
        $this->id = $id;
    }

    function compare($team){
        if($this->points < $team->points) return -1;
        elseif($this->points == $team->points) return 0;
        else return 1;
    }
}

$teams = array();
$group1 = array();
$group2 = array();
$group3 = array();
$group4 = array();

$tournamentIdToornament = "572cefe8fc7b7eb60f8b456b";

//Get all the participants of the tournament
$participants = json_decode(sendRequestToornament("v1/tournaments/$tournamentIdToornament/participants",array(), array(
    "with_lineup" => 1
))->body);

foreach($participants as $participant){
    $currentTeam = new Team($participant->name,$participant->id);
    foreach ($participant->lineup as $player){
        array_push($currentTeam->players, new Player($player->name));
    }

    $teams[$currentTeam->id] = $currentTeam;
}

//Get the result of matches for each group
foreach ($teams as $id => $participant){
    $result = json_decode(sendRequestToornament("v1/tournaments/$tournamentIdToornament/matches",array(), array(
        "has_result" => 1,
        "participant_id" => $id
    ))->body);
    foreach ($result as $match){
        foreach ($match->opponents as $opponent){
            if(!isset($opponent->participant)) continue;
            switch ($match->group_number){
                case "1":
                    $group1[$opponent->participant->id] = $teams[$opponent->participant->id];
                    break;
                case "2":
                    $group2[$opponent->participant->id] = $teams[$opponent->participant->id];
                    break;
                case "3":
                    $group3[$opponent->participant->id] = $teams[$opponent->participant->id];
                    break;
                case "4":
                    $group4[$opponent->participant->id] = $teams[$opponent->participant->id];
                    break;
                default:
                    echo "Strange!!!";
            }
            if($opponent->participant->id == $id && $opponent->result == 1){
                $participant->points += 3;
            }
        }
    }
}
// State 1: Create the tournament
echo "Creating the tournament...</br>";
$retToornamentCreate = json_decode(sendRequestToornament("v1/tournaments", array(
    "discipline" => "leagueoflegends",
    "name" => "Festigeek2016_Pro",
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

