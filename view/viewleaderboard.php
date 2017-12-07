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
<body data-spy="scroll" data-target="#site-nav">
  <nav id="site-nav" class="navbar navbar-fixed-top navbar-custom">
      <div class="container">
          <?php include 'header.php'; ?>
		  <div class="collapse navbar-collapse" id="navbar-items">
            <ul class="nav navbar-nav nav-tabs">

                <!-- navigation menu -->
                <li class="active"><a data-toggle="tab" href="#LiveAwards">Live Awards</a></li>
                <li><a data-toggle="tab" href="#Leaderboard">Leaderboard</a></li>
                <li><a data-toggle="tab" href="#Cup">Cup</a></li>

            </ul>
        </div>
      </div><!-- /.container -->
  </nav>

  <section id="about" class="section about">
      <div class="container">
          <div class="row">
              <div class="col-sm-1">
              </div><!-- /.col-sm-1 -->

              <div class="col-sm-10">

                  <h3 class="section-title multiple-title">The LeaderBoard</h3>


                  <table class="table table-hover table-responsive">
                      <tr>
                          <th>Rank</th>
                          <th>Team</th>
                          <th>Manager</th>
                          <th>GW</th>
                          <th>TOT</th>
                      </tr>
                      <?php foreach($_SESSION['set1data'] as $item){
                          echo "<tr>";?>


                          <?php echo "<th>".$item['rank_sort']."</th>";?>
                          <?php echo "<th>".$item['entry_name']."</th>";?>
                          <?php echo "<th>".$item['player_name']."</th>";?>
                          <?php echo "<th>".$item['event_total']."</th>";?>
                          <?php echo "<th>".$item['total']."</th>";?>


                      <?php echo "</tr>";} ?>

                      <?php foreach($_SESSION['set2data'] as $item){
                          echo "<tr>";?>


                          <?php echo "<th>".$item['rank_sort']."</th>";?>
                          <?php echo "<th>".$item['entry_name']."</th>";?>
                          <?php echo "<th>".$item['player_name']."</th>";?>
                          <?php echo "<th>".$item['event_total']."</th>";?>
                          <?php echo "<th>".$item['total']."</th>";?>


                          <?php echo "</tr>";} ?>

                  </table>


              </div><!-- /.col-sm-10 -->
              <div class="col-sm-1">

              </div>
          </div><!-- /.row -->
      </div><!-- /.container -->
  </section>


  <?php include 'footer.php';?>
</body>
</html>


