#!/usr/bin/perl

use strict;
use warnings;

use Data::Dumper;

use Encode;
use JSON qw(encode_json decode_json);

use File::Path qw(mkpath);

my $json = JSON->new;
my $inputFileDraw = "versusTable.json";
my $outputFile = "versusTable28Final.json";
my $outputFileFinalList = "finalListAfterGW28.json";
open(my $OTPTF, ">>$outputFileFinalList") or die "Cannot open file $!";
open(my $OTPT, ">>$outputFile") or die "Cannot open file $!";
my $json_inputFileDraw = do {
  open(my $json_fh, "<:encoding(UTF-8)", $inputFileDraw) or die "Can't open $inputFileDraw:$!\n";
 local $/;
 <$json_fh>
};

my $inputData = $json->decode($json_inputFileDraw);

my $playerPoints = "tableOutputPoints.json";

my $json_textPlNameToPoints = do {
  open(my $json_fh, "<:encoding(UTF-8)", $playerPoints) or die "Can't open $playerPoints:$!\n";
 local $/;
 <$json_fh>
};


my $data = $json->decode($json_textPlNameToPoints);

my %finalMap;

foreach my $set (keys %{$inputData}){
  my $player1 = $inputData->{$set}->{'player1'};
  my $score1 = $data->{'28'}->{$player1};
  $inputData->{$set}->{'score1'} = $score1;

  my $player2 = $inputData->{$set}->{'player2'};
  my $score2 = $data->{'28'}->{$player2};
  $inputData->{$set}->{'score2'} = $score2;
  
  if($score1 > $score2){
    $finalMap{$set}{'playerWon'} = $inputData->{$set}->{'player1'};
    $finalMap{$set}{'team'} = $inputData->{$set}->{'team1'};
    $finalMap{$set}{'score'} = $score1;
  }elsif($score2 > $score1){
    $finalMap{$set}{'playerWon'} = $inputData->{$set}->{'player2'};
    $finalMap{$set}{'team'} = $inputData->{$set}->{'team2'};
    $finalMap{$set}{'score'} = $score2;
  }
}


#print Dumper($inputData);
my $jsonString = encode_json($inputData);
my $jsonFinal = encode_json(\%finalMap);
print $OTPTF $jsonFinal;
print $OTPT $jsonString;
close $OTPT;
close $OTPTF;





