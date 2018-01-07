<?php
/**
 * Created by IntelliJ IDEA.
 * User: root
 * Date: 17/8/17
 * Time: 11:25 PM
 */
require_once 'controller/leadercontroller.php';
$cont=new leadercontroller();
if(@$_GET['bwc']) $err=@$_GET['bwc'];
if(@$_GET['stat']){
    $stat = @$_GET['stat'];
    $cont->handlerequest($stat);
}
$cont->handlerequest();
?>