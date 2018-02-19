#!/usr/bin/perl

use strict;
use warnings;

use Data::Dumper;

use Encode;
use JSON qw(encode_json decode_json);

use File::Path qw(mkpath);
my $outputFileDraw = "versusTable.json";
my %rankUsed;
my %sets;
my $rankList = "tableOutputRanks.json";
open(my $FH, ">>$outputFileDraw") or die "Cannot open file $!";
my $playerToTeamList = "tableOutputTeamNameToPlayerName.json";
my $json_textRankList = do {
  open(my $json_fh, "<:encoding(UTF-8)", $rankList) or die "Can't open $rankList:$!\n";
  local $/;
  <$json_fh>
};
my $json_textPlNameToTeamName = do {
  open(my $json_fh, "<:encoding(UTF-8)", $playerToTeamList) or die "Can't open $playerToTeamList:$!\n";
 local $/;
 <$json_fh>
};

my $json = JSON->new;
my $data = $json->decode($json_textRankList);
my $teamNames = $json->decode($json_textPlNameToTeamName);


my %top64;

foreach my $playerName (keys %{$data->{'27'}}){
  if($data->{'27'}{$playerName} <= 64){
    my $rankOfPlayer = $data->{'27'}{$playerName};
    $top64{$rankOfPlayer}{"playerName"} = $playerName;
    $top64{$rankOfPlayer}{"teamName"} = $teamNames->{$playerName};
  }
}

for (my $i = 1; $i <= 64; $i++){
  $rankUsed{$i} = 0;
}

#print Dumper(\%top64);

generateDraw(\%top64);

my $jsonWrite = encode_json(\%sets);
print $FH $jsonWrite;
close $FH;
print Dumper(\%sets);
sub generateDraw{
  my ($top64_href) = @_;
  my $count = 1;
  while($count <= 32){
   my $playersIn = 1;
   while($playersIn != 3){ 
    my $randomNumber = int(rand(64)) + 1;
    if($rankUsed{$randomNumber} == 0){
     $sets{$count}{"player".$playersIn} = $top64{$randomNumber}{"playerName"};
     $sets{$count}{"team".$playersIn} = $top64{$randomNumber}{"teamName"};
     $playersIn++;
     $rankUsed{$randomNumber} = 1;
    }
  }
  $count++;
 } 
}

