<?php
session_start();

$con=mysqli_connect('localhost','root','123123','soccer');

$q=$_GET['q'];

?>

<table class="table table-striped" >
	<thead>
		<tr>
			<th width="100px">분류</th>
			<th width="300px">제목</th>
			<th width="100px">글쓴이</th>
			<?php 
			if(isset($_SESSION['adminlogin'])){
			?>
			<th width="100px">관리</th>
			<?php
			} 
			?> 			        	
		</tr>
	</thead>

	<?php
	$con = mysqli_connect('localhost','root','123123','soccer');

	if($q != ""){
	$sql="SELECT * FROM free WHERE selected = '$q' order by id desc ";
	$result=mysqli_query($con,$sql);
	} else{
		$query = "SELECT * FROM free order by id desc";
		$result = mysqli_query($con,$query);
	}

	$table_name="free";

	while ($row = mysqli_fetch_array($result)){
	$id = $row[0];
	$selected = $row[1];
	$name = $row[2];
	$user = $row[3];
	$data = $row[4];
	?>

	<tbody>
		<tr>
			<td><?= $selected ?></td>
			<td><a href="get.php?name=<?=$name?>&table_name=<?=$table_name?>"><?= $name ?></a></td>
			<td><?= $user ?></td>
			<?php 
			if(isset($_SESSION['adminlogin'])){
			?>
			<td><a href="delete.php?del=<?=$id?>&table_name=<?=$table_name?>">삭제</a></td>
			<?php
			} 
			?> 
		</tr>
	</tbody>
	<?php
	}
	?>
</table>
						      	
<?php

mysqli_close($con);
?>