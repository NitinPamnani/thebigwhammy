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
      </div><!-- /.container -->
  </nav>

  <section id="about" class="section about">
      <div class="container">
          <div class="row">
              <div class="col-sm-1">
              </div><!-- /.col-sm-1 -->

              <div class="col-sm-10">

                  <h3 class="section-title multiple-title">|| आप एडमिन है || </h3>
				   
					<form action ="" method ="post">
						<button type="submit" class="btn btn-default " name ="getUsers">Get Users</button>
					</form>
					
			<?php		
					if(isset($_SESSION['set1data']) && isset($_SESSION['set2data'])){
			            foreach($_SESSION['set1data'] as $item){
							echo $item['player_name'];
							echo "<br>";
						}
						foreach($_SESSION['set2data'] as $item){
							echo $item['player_name'];
							echo "<br>";
						}
					}
			?>

                  <!--<table class="table table-hover table-responsive">
                      <tr>
                          <th>Rank</th>
                          <th>Team</th>
                          <th>Manager</th>
                          <th>GW</th>
                          <th>TOT</th>
                      </tr>
                      <?php //foreach($_SESSION['set1data'] as $item){
                          //echo "<tr>";?>


                          <?php //echo "<th>".$item['rank_sort']."</th>";?>
                          <?php //echo "<th>".$item['entry_name']."</th>";?>
                          <?php //echo "<th>".$item['player_name']."</th>";?>
                          <?php //echo "<th>".$item['event_total']."</th>";?>
                          <?php //echo "<th>".$item['total']."</th>";?>


                      <?php //echo "</tr>";} ?>

                      <?php //foreach($_SESSION['set2data'] as $item){
                          //echo "<tr>";?>


                          <?php //echo "<th>".$item['rank_sort']."</th>";?>
                          <?php //echo "<th>".$item['entry_name']."</th>";?>
                          <?php //echo "<th>".$item['player_name']."</th>";?>
                          <?php //echo "<th>".$item['event_total']."</th>";?>
                          <?php //echo "<th>".$item['total']."</th>";?>


                          <?php //echo "</tr>";} ?>

                  </table>-->


              </div><!-- /.col-sm-10 -->
              <div class="col-sm-1">

              </div>
          </div><!-- /.row -->
      </div><!-- /.container -->
  </section>


  <?php include 'footer.php';?>
</body>
</html>


