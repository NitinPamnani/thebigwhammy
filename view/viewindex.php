<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nitin Pamnani
 * Original Creator: Vishal Pamnani
 * Date: 2/8/17
 * Time: 11:11 PM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>The Big Whammy</title>


    <?php
       include 'depend.php';
    ?>
</head>
<body data-spy="scroll" data-target="#site-nav">

<!--<div class="modal fade show">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">We are currently under maintenance</h4>
            </div>
            <div class="modal-body">
                <p>Stay tuned! We shall be back in the game real soon.&hellip;</p>
            </div>
            <div class="modal-footer">
                <legend>The Big Whammy Team</legend>
            </div>
        </div> /.modal-content -->

<!-- Modal for Invalidate user-->
<?php //echo var_dump($_SESSION); ?>
<?php if($_SESSION['bwc'] == 2573239 or $_SESSION['bwc'] == 7822377){?>
    <div class="modal fade bs-example-modal-sm " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" name="messages" id="invalidate">
        <div class="modal-dialog modal-sm alert alert-info">
            Congratulations <stong><?php echo $_SESSION['firstname'] ?>!</stong> You have successfully registered on the big whammy fantasy football. Your league code is 212512-402475.  Please do not share this league code with anyone. We wish you all the best and hope that you win some big cash prizes this year.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" data-toggle="modal" data-target="#invalidate">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <script>
        $('#invalidate').modal('show');
    </script>
<?php }else if($_SESSION['bwc'] == 72953687363464){?>
    <div class="modal fade bs-example-modal-sm " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" name="messages" id="invalidate">
        <div class="modal-dialog modal-sm alert alert-info">
            Hello <?php echo $_SESSION['firstname'] ?>! We noticed you already tried paying once. Your data has been registered with us. Click again on Proceed to Payment on the page and complete the transaction.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" data-toggle="modal" data-target="#invalidate">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <script>
        $('#invalidate').modal('show');
    </script>
<?php }else if($_SESSION['bwc'] == 35245 or $_SESSION['bwc'] == 94287277 or $_SESSION['bwc'] == 562453 or $_SESSION['bwc'] == 7296368424533 or $_SESSION['bwc'] == 74663){?>
    <div class="modal fade bs-example-modal-sm " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" name="messages" id="invalidate">
        <div class="modal-dialog modal-sm alert alert-warning">
            Hello <?php echo $_SESSION['firstname'] ?>!
            <?php if($_SESSION['bwc'] == 35245) { echo "This email id is already registered with bigwhammy. Please use a new email-id for new registration.";}
                  else if($_SESSION['bwc'] == 94287277) {echo "The whatsapp number stated by you is associated with a user registered with Big whammy please use a different one.";}
                  else if($_SESSION['bwc'] == 562453) {echo "The contact number stated by you is associated with a user registered with Big whammy please use a different one.";}
                  else if($_SESSION['bwc'] == 7296368424533){echo "Sorry, we could not process your payment please try again.";}
                  else if($_SESSION['bwc'] == 74663){echo "Sorry, your mobile number seems to be invalid. Please make sure that you are prefixing it with your country code. For example if you are in India, and your number is 999966xxxx then you should prefix this number with 0091 (country code) and enter 0091999966xxxx. Thanks.";}

            ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" data-toggle="modal" data-target="#invalidate">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <script>
        $('#invalidate').modal('show');
    </script>
<?php } ?>

<!--Invalidate user modal ends-->
<nav id="site-nav" class="navbar navbar-fixed-top navbar-custom">
    <div class="container">
        <?php include 'header.php'; ?>

        <div class="collapse navbar-collapse" id="navbar-items">
            <ul class="nav navbar-nav navbar-right">

                <!-- navigation menu -->
                <li class="active"><a data-scroll href="#about">About</a></li>
                <li><a data-scroll href="#speakers">Masterminds</a></li>
                <!-- <li><a data-scroll href="#schedule">Schedule</a></li> -->
                <li><a data-scroll href="#prizes">Prizes</a></li>
                <!-- <li><a data-scroll href="#">Sponsorship</a></li> -->
                <li><a data-scroll href="#faq">FAQ</a></li>
                <!-- <li><a data-scroll href="#photos">Photos</a></li> -->
                <!--<li><a data-scroll href="#contact">Contact us</a></li>-->

            </ul>
        </div>
    </div><!-- /.container -->
</nav>

<header id="site-header" class="site-header valign-center">
    <div class="intro">

        <h2>August 11, 2017 / The Game Begins!</h2>

        <h1>The Big Whammy Fantasy Football</h1>



        <!--<a class="btn btn-white" data-scroll href="#registration">Register Now</a>-->
        <form action=" " method ="post">
          <button type="submit" class="btn btn-black" id="leaderboard" name="leaderboard" formtarget="_blank">View Leaderboard</button>
        </form>

    </div>
</header>

<section id="about" class="section about">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">

                <!--<h3 class="section-title">The Pioneers</h3>

                <p>Though unofficially thought of and compiled almost 5 years ago, The Big Whammy officially kicked off in the 2015-2016 season.
                    The Big Whammy is a result of pure passion and love for football and the support of loyal friends, more like family now.
                    The Big Whammy has grown exponentially over the years and we are at our biggest season yet.
                    Join us for the Ultimate Fantasy gaming experience.</p>

                <figure>
                    <img alt="" class="img-responsive" src="assets/images/pioneers.jpg">
                </figure>-->

            </div><!-- /.col-sm-6 -->

            <div class="col-sm-6">

                <h3 class="section-title multiple-title">Our Journey</h3>

                <p>Though unofficially thought of and compiled almost 5 years ago, The Big Whammy officially kicked off in the 2015-2016 season.
                    The Big Whammy is a result of pure passion and love for football and the support of loyal friends, more like family now.
                    The Big Whammy has grown exponentially over the years and we are at our biggest season yet.
                    Join us for the Ultimate Fantasy gaming experience.</p>
                <figure>
                    <img alt="" class="img-responsive" src="assets/images/pioneers.jpg">
                </figure>

            </div><!-- /.col-sm-6 -->
            <div class="col-sm-3">

            </div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>

<section id="registration" class="section registration">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="section-title">Registration</h3>
            </div>
        </div>

        <form action="" id="signupandpay" method="post" name="registration">
            <div class="row">
                <div class="col-md-12" id="registration-msg" style="display:none;">
                    <div class="alert"></div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Full Name" id="firstname" name="firstname" value="<?php if(isset($_SESSION['firstname'])){echo $_SESSION['firstname'];}  ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" id="email" name="email" value="<?php if(isset($_SESSION['email'])) {echo $_SESSION['email'];} ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Favourite Club" id="favclub" name="favclub" value="<?php if(isset($_SESSION['favclub'])){echo $_SESSION['favclub']; }?>" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Fantasy Team Name" id="fanasyteamname" name="fplteamname" value="<?php if(isset($_SESSION['fplteamname'])) {echo $_SESSION['fplteamname']; } ?>" required>
                    </div>





                </div>

                <div class="col-sm-6">
                    <!--<div class="form-group">-->
                       <!-- <input type="text" class="form-control" placeholder="Last Name" id="lname" name="lastname" value="<?php //if(isset($_SESSION['lastname'])) { echo $_SESSION['lastname'];*/ } ?>" required>-->
                    <!--</div>-->

                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="Contact: Add your country code without the + or - sign followed by your number. Eg: 0091xxxxxxxxxx for an Indian number" title="If your number is 999966xxxx and if it is an Indian number then please write it as 0091999966xxxx" id="cell" name="contactphone" value="<?php if(isset($_SESSION['contactphone'])) {echo $_SESSION['contactphone']; } ?>" required>
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="Whatsapp Contact: Add your country code without the + or - sign followed by your number. Eg: 0091xxxxxxxxxx for an Indian number" title="If your number is 999966xxxx and if it is an Indian number then please write it as 0091999966xxxx" id="wcell" name="whatsappcontactnumber" value="<?php if(isset($_SESSION['whatsappcontactnumber'])) {echo $_SESSION['whatsappcontactnumber']; } ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Referred By" id="rfname" name="refferedby" value="<?php if(isset($_SESSION['refferedby'])) {echo $_SESSION['refferedby'];} ?>" required>
                    </div>
                 <?php session_destroy();?>

                </div>
            </div>
            <div class="text-center mt20">
                <button type="submit" class="btn btn-black" id="registration-btn" name="signup">Proceed to Payment</button>
            </div>
        </form>
    </div>
</section>

<section id="prizes" class="section faq">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="section-title">PRIZES</h3>
            </div>
        </div>

        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseMamooty" aria-expanded="true" aria-controls="collapseMamooty">Man of the Month (Mamooty Award)</a>
                    </h4>
                </div>

                <div id="collapseMamooty" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <p><ul>
                            <li>This award  will be given to the Participant who bags the highest points in a Particular Month</li>
                            <li>This award will be given from August 2017 uptil April 2018 viz 9 months. The month of May 2018 will not be considered irrespective of any revision in Premier League(PL) schedule.</li>
                            <li>The points in the month will be strictly calculated based on the Game Week's(GW) in that particular month in the Fantasy Premier League(FPL) website. Any changes in the PL schedule which has been incorporated to the GW's in that month will be followed. The month in which the first game of a particular 'GW' falls in shall be the month considered for Man of the Month Award. </li>
                        </ul></p>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseIronMan" aria-expanded="true" aria-controls="collapseIronMan">Iron Man Award</a>
                    </h4>
                </div>

                <div id="collapseIronMan" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <p><ul>
                            <li>This award will be given to the participant who climbs the maximum ranks in The Big Whammy Table of XXXX participants from GW 19 to GW 38</li>
                            <li>The participant's rank AFTER GW 19 will be noted and the rank AFTER GW 38. The participant who has climbed the maximum ranks is the IRON MAN.</li>
                        </ul></p>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEverest" aria-expanded="true" aria-controls="collapseEverest">Everest Award</a>
                    </h4>
                </div>

                <div id="collapseEverest" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <p><ul>
                            <li>This award will be given to the participant who scores the maximum Points in a single Game week.</li>
                            <li>This will be decided at the end of GW 38 to decide the highest scored GW.</li>
                            <li>The use of your wildcards, bench boost, triple captain or free hit will not affect your right to win this award in any way.</li>
                        </ul></p>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFourth" aria-expanded="true" aria-controls="collapseFourth">4th Place Award</a>
                    </h4>
                </div>

                <div id="collapseFourth" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <p><ul>
                            <li>This award will be given to the participant who finishes 4th at the end of GW 38 in The Big Whammy Table of XXXXX participants.</li>
                        </ul></p>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThird" aria-expanded="true" aria-controls="collapseThird">3rd Place Award</a>
                    </h4>
                </div>

                <div id="collapseThird" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <p><ul>
                            <li>This award will be given to the participant who finishes 3rd at the end of GW 38 in The Big Whammy Table of XXXXX participants.</li>
                        </ul></p>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSecond" aria-expanded="true" aria-controls="collapseSecond">2nd Place Award</a>
                    </h4>
                </div>

                <div id="collapseSecond" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <p><ul>
                            <li>This award will be given to the participant who finishes 2nd at the end of GW 38 in The Big Whammy Table of XXXXX participants.</li>
                        </ul></p>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseWhammy" aria-expanded="true" aria-controls="collapseWhammy">THE BIG WHAMMY Award</a>
                    </h4>
                </div>

                <div id="collapseWhammy" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <p><ul>
                            <li>This award will be given to the participant who finishes 1st at the end of GW 38 in The Big Whammy Table of XXXXX participants.</li>
                        </ul></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section id="faq" class="section faq">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="section-title">Rules &amp; FAQs</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> General Rules and Regulations.</a>
                            </h4>
                        </div>

                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <p><ul>
                                    <li>In case of a tie of points for any award, the Award will be split irrespective of the overall points or their position in the FPL table, or any other factor. The Award will be split.</li>
                                    <li>The use of your wildcards, bench boost, triple captain or free hit will not affect your liability to any of the awards in any way. Use them as per your discretion.</li>

                                    <li>Any conflict to the Rules mentioned above or discrepancies arising in the season will be discussed by The Big Whammy management and their decision on the same will be final and irrevocable.</li>
                                    <li>Apart from the XXXX participants, no participant will be allowed to enter the competition at any later stage.</li>
                                </ul></p>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> Why should I play with The Big Whammy when I can just play in a league in the premier league website?</a>
                            </h4>
                        </div>

                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">The Big Whammy offers you a real chance to win actual prizes, gifts and vouchers. Instead of competing with the millions of competitors for a single top prize, The Big Whammy offers several interesting prizes within a small group of participants which increase your chance to actually win awards.</div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                                <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">  How can I register with The Big Whammy? How much does it cost and how can I be sure that my money is safe?</a>
                            </h4>
                        </div>

                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="panel-body">There is a very simple registration process to take part in The Big Whammy. Click here to register. The registration is a simple INR 1100 /-. The Big Whammy has been running successfully since 2013 and several participants have played through the years and won. Please check our reviews and feedback section for more details. Moreoever, all payments are taken ONLY through our payment gateway and acknowledged with an email confirmation.</div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingFour">
                            <h4 class="panel-title">
                                <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour"> How is the scoring system of The Big Whammy and is the exact system of fantasypremierleague website used?</a>
                            </h4>
                        </div>

                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                            <div class="panel-body">The scoring is exactly as per the FPL rules. Minus points are calculated into your monthly score and all other scores. Prizes and awards are different and the rules are as mentioned in the rules and prizes section.</div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingFive">
                            <h4 class="panel-title">
                                <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive"> I am new to fantasy football/ The Big Whammy and not sure if I can win anything as this is my first season. How can I play ?</a>
                            </h4>
                        </div>

                        <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                            <div class="panel-body">The Big Whammy has a 24 hour tips and suggestions chat Room. It also has experts and pundits to guide you if you are a beginner. Considering the number of awards and prizes, you can surely win something if you regularly play and make changes weekly without fail.</div>
                        </div>
                    </div>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingSeven">
                            <h4 class="panel-title">
                                <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven"> When will I get to see my position in The Big Whammy Table after the Gameweek ends?</a>
                            </h4>
                        </div>

                        <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                            <div class="panel-body">Though FPL website has a league table for The Big Whammy, The Big Whammy follows its own tables ensuring minus points are calculated. The Big Whammy website will update its tables 48 hours after FPL scores are updated.</div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingEight">
                            <h4 class="panel-title">
                                <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight"> What is the basic guideline to win something in The Big Whammy?</a>
                            </h4>
                        </div>

                        <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
                            <div class="panel-body">Do not forget to make your changes. Read at least 2 articles and take basic tips before every gameweek.</div>
                        </div>
                    </div>

                </div>
            </div>
</section>
<section id="speakers" class="section speakers">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h3 class="section-title">The Masterminds</h3>

            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="speaker">

                    <figure>
                        <img alt="" class="img-responsive center-block" src="assets/images/speakers/CM.jpg">
                    </figure>

                    <h4>Cherian Mathan</h4>

                    <p>CEO</p>

                    <ul class="social-block">
                        <li><a href="https://twitter.com/cherianmathan" target="_blank"><i class="ion-social-twitter"></i></a></li>
                        <li><a href="https://www.facebook.com/cherian.mathan?fref=ts&ref=br_tf" target="_blank"><i class="ion-social-facebook"></i></a></li>
                        <li><a href="https://www.instagram.com/cherianmathan/?hl=en" target="_blank"><i class="ion-social-instagram"></i></a></li>
                    </ul>

                </div><!-- /.speaker -->
            </div><!-- /.col-md-4 -->

            <div class="col-md-4">
                <div class="speaker">

                    <figure>
                        <img alt="" class="img-responsive center-block" src="assets/images/speakers/JK.jpg">
                    </figure>

                    <h4>Jason Kurien</h4>

                    <p>Director - Operations</p>

                    <ul class="social-block">
                        <li><a href="https://twitter.com/jasonkurien1" target="_blank"><i class="ion-social-twitter"></i></a></li>
                        <li><a href="https://www.facebook.com/jzen93?fref=ts" target="_blank"><i class="ion-social-facebook"></i></a></li>
                        <li><a href="https://www.instagram.com/jason_kurien/?hl=en" target="_blank"><i class="ion-social-instagram"></i></a></li>
                    </ul>

                </div><!-- /.speaker -->
            </div><!-- /.col-md-4 -->

            <div class="col-md-4">
                <div class="speaker">

                    <figure>
                        <img alt="" class="img-responsive center-block" src="assets/images/speakers/VP.jpg">
                    </figure>

                    <h4>Vishal Pamnani</h4>

                    <p>Director - Design &amp; Communication</p>

                    <ul class="social-block">
                        <li><a href="https://twitter.com/aalsipehlwaan" target="_blank"><i class="ion-social-twitter"></i></a></li>
                        <li><a href="https://www.facebook.com/pamnanivishal" target="_blank"><i class="ion-social-facebook"></i></a></li>
                        <li><a href="https://www.instagram.com/pamnanivishal/?hl=en" target="_blank"><i class="ion-social-instagram"></i></a></li>
                    </ul>

                </div><!-- /.speaker -->
            </div><!-- /.col-md-4 -->
        </div><!-- /.row -->


</section>

<!--<section id="contact" class="section about">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="section-title">Contact Us</h3>
            </div>
            <div class="col-sm-12">
                <legend>Vishal Pamnani</legend>
                <address>
                    <strong>+91-8087795471</strong><br>
                </address>
                <legend>Jason Kurien</legend>
                <address>
                    <strong>+91-8879463164</strong>
                </address>
                <legend>
                    <strong>info@thebigwhammy.com</strong>
                </legend>
            </div>

    </div><!-- /.container
</section>-->


<?php include 'footer.php';?>
</body>
</html>