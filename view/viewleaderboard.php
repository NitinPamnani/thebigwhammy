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
                <li class="active"><a data-toggle="tab" href="#LiveAwards">Live Awards</a></li>
                <li><a data-toggle="tab" href="#Leaderboard">Leaderboard</a></li>
                <li><a data-toggle="tab" href="#Cup">Cup</a></li>

            </ul>
        </div>
    </div><!-- /.container -->
</nav>
<body style="padding-top: 60px;">
 <div class="container">
  <div class="tab-content">
  <!--<div class="container">-->

          <div id= "LiveAwards" class="tab-pane active">
              <div class="row">
                  <h3>Live Awards</h3>
                  
                  <div class="col-sm-4">


                      <div class="card" style="width: 20rem;">
                          <img class="card-img-top" src="http://www.thebigwhammy.com/assets/images/default.jpg" alt="Card image cap">
                          <div class="card-block">
                              <h4 class="card-title">Monthly</h4>
                              <p class="card-text">Monthly Award is given to the player who scored the maximum cumulative in a month.</p>

                          </div>
                      </div>




                  </div><!-- /.col-sm-4 -->
                  <div class="col-sm-4">


                      <div class="card" style="width: 20rem;">
                          <img class="card-img-top" src="http://www.thebigwhammy.com/assets/images/default.jpg" alt="Card image cap">
                          <div class="card-block">
                              <h4 class="card-title">Iron Man</h4>
                              <p class="card-text">Stay Tuned. Will be updated shortly.</p>

                          </div>
                      </div>




                  </div><!-- /.col-sm-4 -->
                  <div class="col-sm-4">
					<div class="card" style="width: 20rem;">
                          <img class="card-img-top" src="http://www.thebigwhammy.com/assets/images/default.jpg" alt="Card image cap">
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

		  <div id= "Leaderboard" class="tab-pane">
          <div class="row">
              <div class="col-sm-1">
              </div><!-- /.col-sm-1 -->

              <div class="col-sm-10">

                  <h3 class=>The LeaderBoard - click on manager's name to view gameweek history</h3>
				
				  <div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example
						<span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Overall</a></li>
								<li><a href="#">September</a></li>
								<li><a href="#">October</a></li>
								<li><a href="#">November</a></li>
								<li><a href="#">December</a></li>
								<li><a href="#">January</a></li>
							</ul>
				  </div>

                  <table class="table table-hover table-responsive">
                      <tr>
                          <th>Rank</th>
                          <th>Team</th>
                          <th>Manager</th>
                          <!--<th>GW</th>-->
                          <th>Total</th>
                      </tr>
                      <?php foreach($_SESSION['set1data'] as $item){
                          echo "<tr>";?>


                          <?php echo "<th>".$item['rank_sort']."</th>";?>
                          <?php echo "<th>".$item['entry_name']."</th>";?>
                          <?php echo "<th><a data-toggle=\"modal\" data-target=\"#gwHistoryModal\" data-id=".$item['entry'].">".$item['player_name']."</a></th>";?>
                          <?php //echo "<!--<th>-->".$item['event_total']."</th>";?>
                          <?php echo "<th>".$item['total']."</th>";?>


                      <?php echo "</tr>";} ?>

                      <?php foreach($_SESSION['set2data'] as $item){
                          echo "<tr>";?>


                          <?php echo "<th>".$item['rank_sort']."</th>";?>
                          <?php echo "<th>".$item['entry_name']."</th>";?>
                          <?php echo "<th><a data-toggle=\"modal\" data-target=\"#gwHistoryModal\"  data-id=".$item['entry'].">".$item['player_name']."</a></th>";?>
                          <?php //echo "<!--<th>-->".$item['event_total']."</th>";?>
                          <?php echo "<th>".$item['total']."</th>";?>


                          <?php echo "</tr>";} ?>

                  </table>


              </div><!-- /.col-sm-10 -->
              <div class="col-sm-1">

              </div>
          </div><!-- /.row -->
		  </div>


          
                    <div id="footballLoader"></div>
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

    <!--</div>-->

</div>
  </div>

  <?php include 'footer.php';?>
</body>
</html>


