#!/usr/bin/perl

use strict;
use warnings;

use Data::Dumper;
use LWP::UserAgent;
use Encode;
use JSON qw(encode_json decode_json);

use File::Path qw(mkpath);

my @collectedUserIds;
my %idToPlayerName;
my %teamNameToPlayerName;
my %experimentMap;
my %experimentMap2;
my %individualGwPoints;
my %player2RankJump;#since gw 19
my %player2RankClimb;
my %player2RankClimbFinal;
my %player2Mon2Points;
my %month2Winner;
my %firstDraw;
my %gw2m;
$gw2m{'2'}{'start'} = 1;
$gw2m{'2'}{'end'} = 3;

$gw2m{'3'}{'start'} = 4;
$gw2m{'3'}{'end'} = 7;

$gw2m{'4'}{'start'} = 8;
$gw2m{'4'}{'end'} = 10;

$gw2m{'5'}{'start'} = 11;
$gw2m{'5'}{'end'} = 14;

$gw2m{'6'}{'start'} = 15;
$gw2m{'6'}{'end'} = 21;

$gw2m{'7'}{'start'} = 22;
$gw2m{'7'}{'end'} = 25;

$gw2m{'8'}{'start'} = 26;
$gw2m{'8'}{'end'} = 28;

$gw2m{'9'}{'start'} = 29;
$gw2m{'9'}{'end'} = 32;

$gw2m{'10'}{'start'} = 33;
$gw2m{'10'}{'end'} = 36;

$gw2m{'11'}{'start'} = 37;
$gw2m{'11'}{'end'} = 38;

my $tableFile = "tableOutputFinal.txt";
my $pointsFile = "tableOutputPoints.json";
open(my $FH, ">>tableOutputRanks.json") or die "Cannot open file $!";
open(my $GH, ">>tableOutputPoints.json") or die "Cannot open file $!";
open(my $RJ, ">>tableOutputRankJumps.json") or die "Cannot open file $!";
open(my $IMS, ">>tableOutputRankJumpsSorted.json") or die "Cannot open file $!";
open(my $PTM, ">>tableOutputMonthsPoints.json") or die "Cannot open file $!";
open(my $MTW, ">>tableOutputMonthWinners.json") or die "Cannot open file $!";
open(my $TNPN, ">>tableOutputTeamNameToPlayerName") or die "Cannot open file $!";
my $userDetails_aref = getUserList(402475,1);
#print Dumper($userDetails_aref);
appendUsersToCollectedUserIds($userDetails_aref);


$userDetails_aref = getUserList(402475,2);
#print Dumper($userDetails_aref);
appendUsersToCollectedUserIds($userDetails_aref);

#print Dumper(\@collectedUserIds);
#print Dumper(\%idToPlayerName);

foreach (@collectedUserIds){
  #print $FH $_." ";
  #next;
  my $id = $_;
  my $userHistory_aref = getUserHistory($_);
  my $gwPoints = 0;
  foreach (@{$userHistory_aref}){
    #print $FH $_->{'points'}." ";
        $gwPoints += ($_->{'points'} - $_->{'event_transfers_cost'});
	$experimentMap{$_->{'event'}}{$idToPlayerName{$id}} = $gwPoints;
        $individualGwPoints{$_->{'event'}}{$idToPlayerName{$id}} = $_->{'points'} - $_->{'event_transfers_cost'};
  }
  #print $FH "\n";
} 

#print $FH Dumper(\%experimentMap) ;

sortExperimentMap(\%experimentMap);
getRankJumpMap(\%experimentMap2);
getSortedRankJumps(\%player2RankClimb);
getPlayer2MonthPoints(\%individualGwPoints);
getMonth2Winner(\%player2Mon2Points);

my $jsonString = encode_json(\%experimentMap2);
my $jsonPoints = encode_json(\%individualGwPoints);
my $jsonIronMan = encode_json(\%player2RankJump);
my $jsonIronManSorted = encode_json(\%player2RankClimbFinal);
my $jsonPointsToMonth = encode_json(\%player2Mon2Points);
my $jsonMonth2Winner2Points = encode_json(\%month2Winner);
my $jsonTeamNameToPlayerName = encode_json(\%teamNameToPlayerName);

print $GH $jsonPoints;
print $FH $jsonString;
print $RJ $jsonIronMan;
print $IMS $jsonIronManSorted;
print $PTM $jsonPointsToMonth;
print $MTW $jsonMonth2Winner2Points;
print $TNPN $jsonTeamNameToPlayerName;
close $FH;
close $GH;
close $RJ;
close $IMS;
close $PTM;
close $MTW;

sub getMonthByNumber{
  my ($value) = @_;
  if($value == 2){
    return "August";
  }elsif($value == 3){
    return "September";
  }elsif($value == 4){
    return "October";
  }elsif($value == 5){
    return "November";
  }elsif($value == 6){
    return "December";
  }elsif($value == 7){
    return "January";
  }elsif($value == 8){
    return "February";
  }elsif($value == 9){
    return "March";
  }elsif($value == 10){
    return "April";
  }elsif($value == 11){
    return "May";
  }
}
sub getMonth2Winner{
  my ($player2Mon2Points) = @_;
  #$month2Winner{$month}{$player} = $points;
  my @months = keys(%gw2m);
  foreach my $month (@months){
    my $monthValue = getMonthByNumber($month);
    my $max = -1;
    my $playerName;
    foreach my $player (keys %{$player2Mon2Points}){
      my $pointsForThisMonth = $player2Mon2Points->{$player}{$month};
      if($pointsForThisMonth > $max){
        $max = $pointsForThisMonth;
        $playerName = $player;
      }
    }
   $month2Winner{$monthValue}{$playerName} = $max;
  }
}
sub sortExperimentMap{
  my ($experimentMap_href) = @_;
  foreach my $gameWeeks (keys %$experimentMap_href){
    #print Dumper($gameWeeks);
	my %gwMap = %{$experimentMap_href->{$gameWeeks}};
	#print Dumper(%gwMap);
	#next;
    my $rank = 1;
    foreach my $name (sort { $gwMap{$b} <=> $gwMap{$a} } keys %gwMap){
	  $experimentMap2{$gameWeeks}{$name} = $rank;
	  $rank++;
	}
  }
}

sub getRankJumpMap{
  my ($experimentMap2) = @_;
  my $totalGameWeeks =  scalar (keys %$experimentMap2);
  foreach my $player (keys %{$experimentMap2->{'10'}}){
    $player2RankJump{$player}{'gw19rank'} = $experimentMap2->{'19'}{$player};
    $player2RankJump{$player}{'presentrank'} = $experimentMap2->{$totalGameWeeks}{$player}; 
    $player2RankJump{$player}{'climbed'} = $experimentMap2->{'19'}{$player} - $experimentMap2->{$totalGameWeeks}{$player};

    $player2RankClimb{$player} = $experimentMap2->{'19'}{$player} - $experimentMap2->{$totalGameWeeks}{$player};
  }
}
 

sub getSortedRankJumps{
  my ($player2RankClimb_href) = @_;
    my %playerDetails = %{$player2RankClimb_href};
  foreach my $name (sort { $playerDetails{$b} <=> $playerDetails{$a} } keys %playerDetails){
     $player2RankClimbFinal{$name}{'climbed'} = $player2RankClimb_href->{$name};
     $player2RankClimbFinal{$name}{'gw19rank'} = $player2RankJump{$name}{'gw19rank'};
     $player2RankClimbFinal{$name}{'presentrank'} = $player2RankJump{$name}{'presentrank'};
  }
}

sub getUserHistory{
 my ($userId) = @_;
 
 my $ua = LWP::UserAgent->new;
 my $historyURL = "https://fantasy.premierleague.com/drf/entry/".$userId."/history";
 my $req = HTTP::Request->new (GET => $historyURL,
								['Content-Type' => 'application/json; charset=UTF-8'],
							  );
 my $response = $ua->request($req);
 my $respStr = $response->as_string;
 #print "Response is".Dumper($respStr);
 my $decoded = decode_json(encode_utf8($response->decoded_content()));
 #print Dumper($decoded->{'history'});
 return $decoded->{'history'};
 
}

sub getUserList{
  my ($leagueId, $page) = @_;
  my $ua = LWP::UserAgent->new;
  
  my $historyURL = "https://fantasy.premierleague.com/drf/leagues-classic-standings/".$leagueId."?phase=1&ls-page=".$page;

  my $req = HTTP::Request->new (GET => $historyURL,
								['Content-Type' => 'application/json; charset=UTF-8'],
			       );
  #print "Rquest made is:".$req->as_string;
  my $response = $ua->request($req);
  my $respStr = $response->as_string;
  #print "Response is".Dumper($respStr);
  my $decoded = decode_json(encode_utf8($response->decoded_content()));
  #print Dumper($decoded->{'standings'}{'results'});
  return   $decoded->{'standings'}{'results'};
}

sub appendUsersToCollectedUserIds{
  my ($userDetails_aref) = @_;
  foreach my $userMap (@{$userDetails_aref}){
    push @collectedUserIds, $userMap->{"entry"};
	$idToPlayerName{$userMap->{"entry"}} = $userMap->{"player_name"};
        $teamNameToPlayerName{$userMap->{"player_name"}} = $userMap->{"entry_name"};
  }
}

sub getPlayer2MonthPoints{
  my ($invGwPoints) = @_;
  foreach my $gameweek (keys %{$invGwPoints}){
    foreach my $player (keys %{$invGwPoints->{$gameweek}}){
	  
	  foreach my $month (keys %gw2m){
	    my $start = $gw2m{$month}{'start'};
		my $end = $gw2m{$month}{'end'};
		my $points = 0;
		for (my $iter = $start; $iter <= $end; $iter+=1){
			$points += $invGwPoints->{$iter}{$player};
		}
		$player2Mon2Points{$player}{$month} = $points;
	  }
	}
  }

}
