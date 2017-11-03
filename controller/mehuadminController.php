<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nitin Pamnani
 * Date: 17/8/17
 * Time: 11:26 PM
 */
session_start();
class mehuadminController {
    function __construct() {

    }

    public function redirect($location) {
        header('location: ' . $location);
    }

    public function handlerequest() {

        ini_set("allow_url_fopen", 1);

		if(isset($_POST['getUsers'])){
			$set2 = file_get_contents('https://fantasy.premierleague.com/drf/leagues-classic-standings/402475?phase=2&le-page=2&ls-page=2');
			$set1 = file_get_contents('https://fantasy.premierleague.com/drf/leagues-classic-standings/402475?phase=2&le-page=2&ls-page=1');
        
			$set1data = json_decode($set1,true);
			$set2data = json_decode($set2,true);

			$_SESSION['set1data'] = $set1data['standings']['results'];
			$_SESSION['set2data'] = $set2data['standings']['results'];
			
						
			$fp = fopen("users-list.txt", "w");
			foreach($_SESSION['set1data'] as $item){
			  $text .= $item['player_name']."\n";
			}
			foreach($_SESSION['set2data'] as $item){
			  $text .= $item['player_name']."\n";
			}
			fwrite($fp, $text);
			fclose($fp);
			
			header('Content-Type: application/download');
			header('Content-Disposition: attachement; filename="users-list.txt"');
			header("Content-Length:".filesize("users-list.txt"));
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			readfile('users-list.txt');
			exit;
		}
        include 'view/viewmehuadmin.php';
    }



}
?>