<?php
 require('../application_top.php');
 define('TABLE',MTABLE.'questions_answers');
 
	$by_id=$_POST['by_id'];

	$condi = " question_answer_ID= ".$by_id;
	//print_r($query);exit;
	deleteQuery(TABLE, $condi);?>
