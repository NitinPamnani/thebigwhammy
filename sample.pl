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
my %experimentMap;
my %experimentMap2;
my %individualGwPoints;
my $tableFile = "tableOutputFinal.txt";
my $pointsFile = "tableOutputPoints.json";
open(my $FH, ">>tableOutputRanks.json") or die "Cannot open file $!";
open(my $GH, ">>tableOutputPoints.json") or die "Cannot open file $!";
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

my $jsonString = encode_json(\%experimentMap2);
my $jsonPoints = encode_json(\%individualGwPoints);

print $GH $jsonPoints;
print $FH $jsonString;
close $FH;
close $GH;


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
  }
}
