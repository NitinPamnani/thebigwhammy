<?php
/*
 *
 *
 */
require_once 'controller/indexcontroller.php';
$cont=new indexcontroller();
if(@$_GET['bwc']) $err=@$_GET['bwc'];
else $err=0;
if(@$_GET['payment_id']) $paymentid = @$_GET['payment_id'];
$cont->handlerequest($err, $paymentid);
?>