<?php
$con = mysqli_connect('localhost', 'root','123123','soccer');

$delete_id = $_GET['del'];
$table_name = $_REQUEST['table_name'];

$query = "DELETE FROM $table_name WHERE id='$delete_id'";

if (mysqli_query($con, $query)) {
	if($table_name=="user_info"){
		header("Location: management.php");
	} else if($table_name=="korea"){
		header("Location: koreasoccer.php");
	} else if($table_name=="world"){
		header("Location: worldsoccer.php");
	} else if($table_name=="free"){
		header("Location: free.php");
	} else if($table_name=="notice"){
		header("Location: notice.php");
	}
}

?>