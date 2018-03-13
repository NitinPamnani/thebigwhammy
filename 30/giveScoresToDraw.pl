#!/usr/bin/perl

use strict;
use warnings;

use Data::Dumper;

use Encode;
use JSON qw(encode_json decode_json);

use File::Path qw(mkpath);

my $json = JSON->new;
my $inputFileDraw = "versusTable.json";
my $outputFile = "versusTable30.json";
#my $outputFileFinalList = "finalListAfterGW28.json";
#open(my $OTPTF, ">>$outputFileFinalList") or die "Cannot open file $!";
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
  my $score1 = $data->{'30'}->{$player1};
  $inputData->{$set}->{'score1'} = $score1;

  my $player2 = $inputData->{$set}->{'player2'};
  my $score2 = $data->{'30'}->{$player2};
  $inputData->{$set}->{'score2'} = $score2;
  
#$finalMap{$set} = %{$set};
}


#print Dumper($inputData);
my $jsonString = encode_json($inputData);
print $OTPT $jsonString;
close $OTPT;
#close $OTPTF;





