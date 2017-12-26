<?php
/**
 * Created by IntelliJ IDEA.
 * User: root
 * Date: 2/8/17
 * Time: 11:23 PM
 */
require_once 'dbfunctions.php';
class indexmodal {
    private $conn;
    function __construct()
    {
        $this -> conn=new dbfunctions();
    }
    function getLinkToDBConnectionObject(){
        return $this -> conn -> getDBConnectionObject();
    }

    function Check() {
        if ($this -> conn -> db) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function Add($firstname, /*$lastname,*/ $email, $whatsappnum, $mobilenum, $fplteam, $favClub, $referredby) {
       // $pass = md5($password);
       // $salt = $this -> usf -> randomAlphaNum(5);
       // $hash = crypt($pass, $salt);
        $stmt = $this -> conn -> db -> prepare("INSERT INTO users(firstname, mobilenumber, whatsappnumber, fplteamname, favclub, referredby, email) VALUES (?,?,?,?,?,?,?)");
        $stmt -> bind_param("sssssss", $firstname, $mobilenum, $whatsappnum, $fplteam, $favClub, $referredby, $email);
        if ($stmt -> execute()) {
            return TRUE;
        } else {
            //echo var_dump($stmt);
            return FALSE;

        }

    }

    function checkIfPaymentPassed($paymentId){
        $stmt = $this -> conn -> db -> prepare ("SELECT ispaymentdone FROM users where paymentid = ?");
        $stmt->bind_param("s", $paymentId);
        $stmt -> execute();
        $result = $stmt -> get_result();
        $row = $result -> fetch_assoc();
        if($row['ispaymentdone'] == null or $row['ispaymentdone'] == 0){
            return false;
        }else if($row['ispaymentdone'] == 1){
            return true;
        }

    }

    function flushIfIamThere($whatsappnum, $email, $mobilenumber){
        $stmt = $this -> conn -> db -> prepare("DELETE FROM users WHERE email = '$email' AND whatsappnumber = '$whatsappnum' AND mobilenumber = '$mobilenumber'");
        if($stmt->execute()){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function checkIfPaid($firstname, /*$lastname,*/ $email, $whatsappnum, $mobilenum, $fplteam, $favClub, $referredby){
        $stmt = $this -> conn -> db -> prepare("SELECT ispaymentdone FROM users WHERE email = '$email' AND whatsappnumber ='$whatsappnum' AND firstname = '$firstname' AND  mobilenumber = '$mobilenum'" );
        $stmt -> execute();
        $result = $stmt -> get_result();
        $row = $result -> fetch_assoc();
        return $row;
    }

    function checkIfEmailExists($email){
        $stmt = $this -> conn -> db -> prepare("SELECT firstname FROM users WHERE email = '$email'");
        $stmt -> execute();
        $result = $stmt -> get_result();
        $row = $result -> fetch_assoc();
        if($row['firstname'] == null){
            return false;
        }else{
            return true;
        }
    }
    function checkContactPhone($contact){
        $stmt = $this -> conn -> db -> prepare("SELECT firstname FROM users WHERE mobilenumber = '$contact'");
        $stmt -> execute();
        $result = $stmt -> get_result();
        $row = $result -> fetch_assoc();
        if($row['firstname'] == null){
            return false;
        }else{
            return true;
        }
    }
    function checkWhatsappPhone($whatsapp){
        $stmt = $this -> conn -> db -> prepare("SELECT firstname FROM users WHERE whatsappnumber = '$whatsapp'");
        $stmt -> execute();
        $result = $stmt -> get_result();
        $row = $result -> fetch_assoc();
        if($row['firstname'] == null){
            return false;
        }else{
            return true;
        }
    }

    function loginfetch($username, $pass) {
        $stmt = $this -> conn -> db -> prepare("SELECT hash, salt from users where username = '$username'");
        $stmt -> execute();
        $result = $stmt -> get_result();
        $row = $result -> fetch_assoc();
        return $row;

    }


}
			?>