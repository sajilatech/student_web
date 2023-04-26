<?php 
$counter=$_POST['counter'];

$outof=$_POST['outof'];
$mark_value=$_POST['mark_value'];
$result_percentage=($mark_value / $outof) * 100;
echo $result_percentage." %";