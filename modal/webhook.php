<?php
session_start();
/**
 * Created by IntelliJ IDEA.
 * User: Nitin Pamnani
 * Date: 4/8/17
 * Time: 2:34 AM
 */
require_once 'dbfunctions.php';
require_once 'indexmodal.php';

$indexModal = new indexmodal();
$conn = new dbfunctions();
$data = $_POST;
$mac_provided = $data['mac'];  // Get the MAC from the POST data
unset($data['mac']);  // Remove the MAC key from the data.

$ver = explode('.', phpversion());
$major = (int) $ver[0];
$minor = (int) $ver[1];

if($major >= 5 and $minor >= 4){
    ksort($data, SORT_STRING | SORT_FLAG_CASE);
}
else{
    uksort($data, 'strcasecmp');
}

// You can get the 'salt' from Instamojo's developers page(make sure to log in first): https://www.instamojo.com/developers
// Pass the 'salt' without the <>.
//$mac_calculated = hash_hmac("sha1", implode("|", $data), "edfa018c2c0741daa627936add928161");
$mac_calculated = hash_hmac("sha1", implode("|", $data), "119db13571cd4f4f88e3660fa71f70a1");

if($mac_provided == $mac_calculated){
    //echo "MAC is fine";
    // Do something here
    $paymentid = $data['payment_id'];
    $name = $data['buyer_name'];
    $email = $data['buyer'];
    /*$whatsappnum = $_SESSION['whatsappcontactnumber'];
    $fplteamname = $_SESSION['fplteamname'];
    $favClub = $_SESSION['favclub'];
    $mobilenumber = $_SESSION['contactphone'];
    $refferedby = $_SESSION['refferedby'];*/

    $stmt = $conn->db->prepare("UPDATE users SET paymentid = ? WHERE firstname=? and email=?");
    $stmt -> bind_param("sss", $paymentid, $name, $email);
    $stmt->execute();
    if($data['status'] == "Credit"){
        // Payment was successful, marking it as completed in database
      $temp = 1;
      //$indexModal->Add($name, /*$lastname,*/ $email, $whatsappnum, $mobilenumber, $fplteamname, $favClub, $refferedby, $paymentid);
        /*$stmt = $conn -> db -> prepare("INSERT INTO users(firstname, mobilenumber, whatsappnumber, fplteamname, favclub, referredby, email, paymentid) VALUES (?,?,?,?,?,?,?,?)");
        $stmt -> bind_param("ssssssss", $firstname, $mobilenum, $whatsappnum, $fplteam, $favClub, $referredby, $email, $paymentid);
        if ($stmt -> execute()) {
            return TRUE;
        } else {
            //echo var_dump($stmt);
            return FALSE;
            $_SESSION['bwc'] = 7822377;

        }*/
      $stmt = $conn->db->prepare("UPDATE users SET ispaymentdone = ? WHERE paymentid = ? and firstname = ? and email = ?");
      $stmt -> bind_param("isss",$temp,$paymentid, $name, $email );
      $stmt->execute();

    }
    else{
        // Payment was unsuccessful, marking it as failed in database
        $temp = 0;
        $stmt = $conn->db->prepare("UPDATE users SET ispaymentdone = ? WHERE paymentid = ? and firstname = ? and email = ?");
        $stmt -> bind_param("isss",$temp,$paymentid, $name, $email );
        $stmt->execute();

    }
}
else{
    echo "Invalid MAC passed";
}
?>