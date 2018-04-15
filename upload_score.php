<?php
include "dbcon1.php";
include "dbcon2.php";

$query1 = mysqli_query($link, "SELECT * FROM total_score WHERE session_names = '2016/2017' AND term_name='FIRST TERM' ");
echo mysqli_num_rows($query1);
 while ($row1 = mysqli_fetch_array($query1)) {
 	$id = $row1['id'];
 	$student_id = $row1['student_id'];
 	$total_score = $row1['total_score'];
 	$average_score = $row1['average_score'];
 	$position = $row1['position'];
 	$level_name = $row1['level_name'];
 	$class_arm = $row1['class_arm'];
 	$session_names = $row1['session_names'];
 	$term_name = $row1['term_name'];

 // 	$query2 = mysqli_query($link2, "INSERT INTO total_score(
 //  `id`,`student_id`,`total_score`,`average_score`,`position`,`level_name`,`class_arm`,`session_names`,`term_name`) VALUES(
 // '$id','$student_id','$total_score','$average_score','$position','$level_name','$class_arm','$session_names','$term_name')" ) or die('Error');
 	//echo "Upload Successful";
 }
 	echo "<br/>";
 	$query3 = mysqli_query($link2, "SELECT * FROM total_score WHERE session_names = '2016/2017' AND term_name='FIRST TERM' ");
echo mysqli_num_rows($query3);

?>