<?php
/**
 * Created by IntelliJ IDEA.
 * User: root
 * Date: 17/8/17
 * Time: 11:21 PM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>The Big Whammy Leaderboard</title>


    <?php
    include 'depend.php';
    ?>
</head>
<!--made the id as site-nav2 to keep the navbar as solid-->
<nav id="site-nav2" class="navbar navbar-solid navbar-fixed-top navbar-custom">
    <div class="container">
        <?php include 'header.php'; ?>
        <div class="collapse navbar-collapse" id="navbar-items">
            <ul class="nav navbar-nav navbar-right">

                <!-- navigation menu -->
                <li class="active"><a data-toggle="tab" href="#Leaderboard">Leaderboard</a></li>
                <li><a data-toggle="tab" href="#LiveAwards">Live Awards</a></li>
                <li><a data-toggle="tab" href="#Cup">Cup</a></li>

            </ul>
        </div>
    </div><!-- /.container -->
</nav>
<body style="padding-top: 60px;">
 <div class="container">
  <div class="tab-content">
  <!--<div class="container">-->

          <div id= "LiveAwards" class="tab-pane">
              <div class="row">
                  <h3>Live Awards</h3>
                  
                  <div class="col-sm-4">


                      <div id="monthlyawardcarousel" class="card carousel slide" data-ride="carousel" style="width: 20rem;">

                          <div class="carousel-inner">
                              <div class="item active">
                                  <canvas id="monthly-January" class="card-img-top" width="360" height="235"></canvas>
                              </div>
                              <div class="item">
                                  <canvas id="monthly-February" class="card-img-top" width="360" height="235"></canvas>
                              </div>

                              <div class="item">
                                  <canvas id="monthly-August" class="card-img-top" width="360" height="235"></canvas>
                              </div>

                              <div class="item">
                                  <canvas id="monthly-September" class="card-img-top" width="360" height="235"></canvas>
                              </div>

                              <div class="item">
                                  <canvas id="monthly-October" class="card-img-top" width="360" height="235"></canvas>
                              </div>

                              <div class="item">
                                  <canvas id="monthly-November" class="card-img-top" width="360" height="235"></canvas>
                              </div>

                              <div class="item">
                                  <canvas id="monthly-December" class="card-img-top" width="360" height="235"></canvas>
                              </div>


                          </div>

                          <div class="card-block">
                              <h4 class="card-title">Monthly</h4>
                              <p class="card-text">Monthly Award is given to the player who scored the maximum cumulative in a month.</p>

                          </div>
                          <a class="left carousel-control" href="#monthlyawardcarousel" data-slide="prev">
                              <span class="glyphicon glyphicon-chevron-left"></span>
                              <span class="sr-only">Previous</span>
                          </a>
                          <a class="right carousel-control" href="#monthlyawardcarousel" data-slide="next">
                              <span class="glyphicon glyphicon-chevron-right"></span>
                              <span class="sr-only">Next</span>
                          </a>
                      </div>




                  </div><!-- /.col-sm-4 -->
                  <div class="col-sm-4">


                      <div class="card" style="width: 20rem;">
                          <!--<img class="card-img-top" src="http://www.thebigwhammy.com/assets/images/default.jpg" alt="Card image cap">-->
                          <canvas id="ironman-award" class="card-img-top" width="360" height="235"></canvas>

                          <div class="card-block">
                              <h4 class="card-title"><a id="ironmanmodalopener">Iron Man</a></h4>
                              <p class="card-text">Click on "Iron Man" for more details</p>

                          </div>
                      </div>




                  </div><!-- /.col-sm-4 -->
                  <div class="col-sm-4">
					<div class="card EverestCard" style="width: 20rem;">


                          <!--<img class="card-img-top" src="http://www.thebigwhammy.com/assets/images/default.jpg" alt="Card image cap">-->
                        <canvas id="everest-award" class="card-img-top" width="360" height="235"></canvas>
                            <div class="card-block">
                                <h4 class="card-title">Everest</h4>
                                <p class="card-text">Everest Award is given to the player who achieved the highest score in a month, in any game week.</p>

                           </div>


                      </div>


                  </div>
              </div><!-- /.row -->
          </div>
      <!--</div>-->




    <!--<div class="container">-->

		  <div id= "Leaderboard" class="tab-pane active">
          <div class="row">
              <div class="col-sm-1">
              </div><!-- /.col-sm-1 -->

              <div class="col-sm-10">

                  <h3 class=>The LeaderBoard - click on manager's name to view gameweek history</h3>
				<div class="row">
				  <div class="col-md-4"></div>
				  <div class="col-md-4">
				   <div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php if($_SESSION['phaseValue']) {echo $_SESSION['phaseValue'];} else{ echo "Select Phase"; }?>
						<span class="caret"></span></button>
							<ul class="dropdown-menu phase-menu">
								<li><a href="?stat=overall" data-value="overall">Overall</a></li>
                                <li><a href="?stat=august" data-value="august">August</a></li>
                                <li><a href="?stat=september" data-value="september">September</a></li>
								<li><a href="?stat=october" data-value="october">October</a></li>
								<li><a href="?stat=november" data-value="november">November</a></li>
								<li><a href="?stat=december" data-value="december">December</a></li>
								<li><a href="?stat=january" data-value="january">January</a></li>
								<li><a href="?stat=february" data-value="february">February</a></li>
							</ul>
				    </div>
					</div>
					<div class="col-md-4"></div>
				  </div>
				  <br>
                 <div class="row">
                  <table id="leaderboardTable" class="table table-hover table-responsive">
                      <tr>
                          <th>Rank</th>
                          <th>Team</th>
                          <th>Manager</th>
                          <!--<th>GW</th>-->
                          <!--<th>Total</th>-->
						  <th>Total</th>
                      </tr>
                      <?php foreach($_SESSION['set1data'] as $item){
                          echo "<tr>";?>


                          <?php echo "<th>".$item['rank_sort']."</th>";?>
                          <?php echo "<th>".$item['entry_name']."</th>";?>
                          <?php echo "<th><a data-toggle=\"modal\" data-target=\"#gwHistoryModal\" data-id=".$item['entry']." data-name=\"".$item["player_name"]."\">".$item['player_name']."</a></th>";?>
                          <?php //echo "<!--<th>-->".$item['event_total']."</th>";?>
                          <?php //echo "<th>".$item['total']."</th>";?>
						  <?php if($_SESSION['phaseValue2'] > 1){echo "<th>".$_SESSION['set3data'][$item["player_name"]][$_SESSION['phaseValue2']]."</th>";}else{echo "<th>".$item['total']."</th>";}?>


                      <?php echo "</tr>";} ?>

                      <?php foreach($_SESSION['set2data'] as $item){
                          echo "<tr>";?>


                          <?php echo "<th>".$item['rank_sort']."</th>";?>
                          <?php echo "<th>".$item['entry_name']."</th>";?>
                          <?php echo "<th><a data-toggle=\"modal\" data-target=\"#gwHistoryModal\"  data-id=".$item['entry']." data-name=\"".$item["player_name"]."\">".$item['player_name']."</a></th>";?>
                          <?php //echo "<!--<th>-->".$item['event_total']."</th>";?>
                          <?php //echo "<th>".$item['total']."</th>";?>
						  <?php if($_SESSION['phaseValue2'] > 1){echo "<th>".$_SESSION['set3data'][$item["player_name"]][$_SESSION['phaseValue2']]."</th>";}else{echo "<th>".$item['total']."</th>";}?>


                          <?php echo "</tr>";} ?>

                  </table>

                </div>
              </div><!-- /.col-sm-10 -->
              <div class="col-sm-1">

              </div>
          </div><!-- /.row -->
		  </div>


          
                    <div id="footballLoader"></div>
      <div id="ironmanloader" class="elementToFadeInAndOut"> <img src="http://localhost/thebigwhammy/assets/images/imload.png"> </div>
      <!-- Modal -->

      <div class="modal fade" id="gwHistoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog " role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Game Week History</h4>
                  </div>
                  <div class="modal-body gwHistoryModal">

                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default gwclose" data-dismiss="modal">Close</button>

                  </div>
              </div>
          </div>
      </div>
	  
	  <div class="modal fade" id="ironManModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog " role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">THE FIGHT FOR IRON MAN</h4>
                  </div>
                  <div class="modal-body ironManModal">

                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default gwclose" data-dismiss="modal">Close</button>

                  </div>
              </div>
          </div>
      </div>

    <!--</div>-->

</div>
  </div>

  <?php include 'footer.php';?>
</body>
</html>


