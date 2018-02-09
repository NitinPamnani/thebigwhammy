<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nitin Pamnani
 * Date: 17/8/17
 * Time: 11:26 PM
 */
session_start();
class leadercontroller {
    function __construct() {

    }

    public function redirect($location) {
        header('location: ' . $location);
    }

    public function handlerequest($stat) {

        ini_set("allow_url_fopen", 1);
        $phase = 1;
        if(strcmp($stat, "overall") == 0){
            $phase = 1;
        }else if(strcmp($stat, "august") == 0){
            $phase = 2;
        }else if(strcmp($stat, "september") == 0){
            $phase = 3;
        }else if(strcmp($stat, "october") == 0){
            $phase = 4;
        }else if(strcmp($stat, "november") == 0){
            $phase = 5;
        }else if(strcmp($stat, "december") == 0){
            $phase = 6;
        }else if(strcmp($stat, "january") == 0){
            $phase = 7;
        }

        $set2 = file_get_contents('https://fantasy.premierleague.com/drf/leagues-classic-standings/402475?phase='.$phase.'&le-page=2&ls-page=2');
        $set1 = file_get_contents('https://fantasy.premierleague.com/drf/leagues-classic-standings/402475?phase='.$phase.'&le-page=2&ls-page=1');

		$set3 = file_get_contents('tableOutputMonthsPoints.json');
        $set1data = json_decode($set1,true);
        $set2data = json_decode($set2,true);

        $_SESSION['set1data'] = $set1data['standings']['results'];
        $_SESSION['set2data'] = $set2data['standings']['results'];
		$_SESSION['set3data'] = $set3;
        $_SESSION['phaseValue'] = $phase;

        $myfile = fopen("data.txt","w");
        echo fwrite($myfile, "Hello World.");
        fclose($myfile);

        include 'view/viewleaderboard.php';
    }



}