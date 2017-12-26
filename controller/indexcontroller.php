<?php
session_start();
/**
 * Created by IntelliJ IDEA.
 * User: Nitin Pamnani
 * Date: 2/8/17
 * Time: 11:21 PM
 */


require_once 'modal/indexmodal.php';
include 'src/Instamojo.php';

class indexcontroller {
    function __construct() {
        $this -> conn = new indexmodal();

    }

    public function redirect($location) {
        header('location: ' . $location);
    }

    public function handlerequest($err, $paymentid) {
        $msg = $this -> conn -> Check();
        if($paymentid) {
            if($this->checkIfPaymentSuccess($paymentid)){
                $_SESSION['bwc'] = 7822377;
                $this->redirect('index.php');
                exit();
            }
        }

        if (isset ($_POST['leaderboard'])) {
            $this -> redirect('leaderboard.php');
            exit();
        }

        if (isset($_POST['login'])) {
            $this -> validateuser();
        }
        if (isset($_POST['signup'])) {//header("location:index.php?error=1");

            if(!$this -> checkIfAlreadyPaid()){

                $this->adduser();
            }
        }
        include 'view/viewindex.php';
    }
    public function checkIfPaymentSuccess($paymentId) {
        $msg = $this->conn->checkIfPaymentPassed($paymentId);
        return $msg;
    }

    public function validateuser() {
        $link = $this -> conn -> getLinkToDBConnectionObject();
        $username = mysqli_real_escape_string($link, $_POST['username']);
        if (trim($username) == "" or trim($_POST['password'] == "")) {
            $this -> redirect('index.php?error=1');
            //$this -> invalidate();
        } else {
            $password = $_POST['password'];
            $result = $this -> conn -> loginfetch($username, $password);

            $pass = md5($password);
            $currhash = crypt($pass, $result['salt']);
            if ($currhash == $result['hash']) {
                $values = $this -> usf -> messages("login");

                $_SESSION['username'] = $username;
                $_SESSION['messages'] = $values[0];
                $_SESSION['class'] = $values[1];
                //$_SESSION['flag'] = TRUE;
                $this -> redirect('user.php');

            } else {
                $this -> redirect('index.php?error=1');
                //echo 'wrong';
                //echo "error=1";
                //include 'view/viewindex.php?';
                //	$this -> invalidate();
            }
        }
    }

    public function flushMe($whatsappnum, $email, $mobilenumber) {
        $msg = $this -> conn -> flushIfIamThere($whatsappnum, $email, $mobilenumber);
        if($msg){
            echo "flushed non paid";
        }else{
            echo "not flushed";
        }
    }

    public function checkIfAlreadyPaid() {
        $firstname = $_POST['firstname'];
        $_SESSION['firstname'] = $firstname;
        /*$lastname = $_POST['lastname'];
        $_SESSION['lastname'] = $lastname;*/
        $email = $_POST['email'];
        $_SESSION['email'] = $email;
        $whatsappnum = $_POST['whatsappcontactnumber'];
        $_SESSION['whatsappcontactnumber'] = $whatsappnum;
        $mobilenumber = $_POST['contactphone'];
        $_SESSION['contactphone'] = $mobilenumber;
        $fplteamname = $_POST['fplteamname'];
        $_SESSION['fplteamname'] = $fplteamname;
        $favClub = $_POST['favclub'];
        $_SESSION['favclub'] = $favClub;
        $refferedby = $_POST['refferedby'];
        $_SESSION['refferedby'] = $refferedby;
        $msg = $this -> conn -> checkIfPaid($firstname, /*$lastname,*/ $email, $whatsappnum, $mobilenumber, $fplteamname, $favClub, $refferedby);
        echo "Entered this sub";
        echo var_dump($msg);
        if($msg['ispaymentdone'] == 1) {
            $this->redirect('index.php');
            $_SESSION['bwc'] = 2573239;
            exit();
        }else if($msg == null){
            return false;
        }else if($msg['ispaymentdone'] == 0){
            $this->flushMe($whatsappnum, $email, $mobilenumber);
            $this->redirect('index.php');
            $_SESSION['bwc'] = 72953687363464;
            exit();
        }
        return false;

    }

    public function adduser() {
        $firstname = $_POST['firstname'];
        //$lastname = $_POST['lastname'];
        $email = $_POST['email'];
        if($this-> conn -> checkIfEmailExists($email)){
            $this->redirect('index.php');
            $_SESSION['bwc'] = 35245;
            exit();
        }

        $whatsappnum = $_POST['whatsappcontactnumber'];
        if($this->conn -> checkWhatsappPhone($whatsappnum)){
            $this->redirect('index.php');
            $_SESSION['bwc'] = 94287277;
            exit();
        }
        $mobilenumber = $_POST['contactphone'];

        if($this-> conn -> checkContactPhone($mobilenumber)){
            $this->redirect('index.php');
            $_SESSION['bwc'] = 562453;
            exit();
        }
        $fplteamname = $_POST['fplteamname'];
        $favClub = $_POST['favclub'];
        $refferedby = $_POST['refferedby'];
        //$this->makePayment($firstname, $mobilenumber, $email);

        $msg = $this -> conn -> Add($firstname, /*$lastname,*/ $email, $whatsappnum, $mobilenumber, $fplteamname, $favClub, $refferedby);
        if ($msg) {
            /*$usf = new userfunctions();
            $values = $this -> usf -> messages("signup");

            $_SESSION['messages'] = $values[0];
            $_SESSION['class'] = $values[1];
            header("location:user.php");*/
          //  echo 'Successfully made entries in db';
            $this->makePayment($firstname, $mobilenumber, $email, $whatsappnum);
        } else {
            echo 'Error';
        }
    }

    public function makePayment($fname, $mnum, $em, $whatsappnum) {
        echo "make payment tak bhi me aya\n";
        $firstname = $fname;
        $mobilenumber = $mnum;
        $email = $em;
        $productName = "Registration For Big Whammy";
        $price = "1100";

        //$api = new \Instamojo\Instamojo('ddd5183d5065612dc2c027527ae052b0', '4a0900a4ebf7b25a0ef1326731774635', 'https://test.instamojo.com/api/1.1/');
        $api = new \Instamojo\Instamojo('a7969b2677f4b5cf13f71b89446d17a0', '8477943f643a8b28fa56a9c324537bb4', 'https://www.instamojo.com/api/1.1/');

        try{
            $response = $api->paymentRequestCreate(array(
                "purpose" => $productName,
                "amount" => $price,
                "buyer_name"=> $firstname,
                "phone" => $mobilenumber,
                "send_email" => true,
                "send_sms"=> true,
                "email" => $email,
                'allow_repeated_payments' => false,
                "redirect_url" => "http://www.thebigwhammy.com/index.php",

                "webhook" => "http://www.thebigwhammy.com/modal/webhook.php"
                //"webhook" => "https://requestb.in/1hny4lt1"
            ));
            echo var_dump($response);
            $pay_url = $response['longurl'];

            header("Location:$pay_url");
            exit();
        }
        catch (Exception $e) {
            print('Error: Yaha par fat raha hai' . $e->getLine());
            if($e->getLine() == 119){


                $this->flushMe($whatsappnum, $email, $mobilenumber);
                $this->redirect('index.php');
                $_SESSION['bwc'] = "74663";
                exit();
            }
        }

    }

    public function invalidate()
    {

        echo"<script>
				$('#invalidate').modal('show');
			</script>";
    }


}

?>