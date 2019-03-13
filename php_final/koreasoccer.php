<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
if (!isset($_SESSION['login']) && !isset($_SESSION['adminlogin']) ) {
        header("Location: index.php");
}

if(isset($_POST['logout'])){
	header("Location: logout.php");
} else if(isset($_POST['userprofile'])){
	header("Location: userprofile.php");
}
?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>축.잘.알_국축잘알</title>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="style.css" rel="stylesheet" type="text/css" />

</head>

<body>	
<div id="frame"> 
	<div id="headcontainer">
		<div id="container">
			<div id="banner">
				<a href="content.php">
				<img src="images/banner.png" alt="축.잘.알" title="축.잘.알" width="100%" height="100%" />
				</a>
			</div>				
		</div>			
		<br class="spacer" />
	</div>

		<div class="blank"></div>

	<div id="navcontainer">
            <ul>
                <li><a href="content.php"> Home  </a></li>
                <li><a href="worldsoccer.php"> 해축잘알  </a></li>
                <li><span>한축잘알</span></li>
              	<li><a href="free.php"> 자유게시판  </a></li>
              	<?php 
					if(isset($_SESSION['adminlogin'])){
						echo "<li><a href='management.php'> 회원관리  </a></li>";
					} else {
		     			 echo "<li><a href='check.php'> 출석체크 </a></li>"; 
					}
				?>
                <li><a href="notice.php"> 공지사항  </a></li>
            </ul>
    </div>	

    	<div class="blank"></div>
	
	<div id="bodycontainer">
		<div id="bodycontainerleft">
			<div id="lmaim">
				<form method="post" action="koreasoccer.php">
					<?php 
					if(isset($_SESSION['adminlogin'])){
						echo "관리자 ".$_SESSION['adminlogin'];
					} else {
						echo $_SESSION['login']."님"; 
					}
					?> 
					<br><br>
					<?php 
					if(isset($_SESSION['adminlogin'])){
					?>
						<button type="submit" class="btn btn-success" name="logout">로그아웃</button>
					<?php
					}

					else {
					?>
						<button type="submit" class="btn btn-success" name="userprofile">내프로필</button>
						<button type="submit" class="btn btn-success" name="logout">로그아웃</button>
					<?php
					}
					?>
				</form>
				<br>
				<h5>해축 순위</h5>
				<div id="myCarousel3" class="carousel slide" data-ride="carousel">
				    <!-- Indicators -->
				    <ol class="carousel-indicators">
				      	<li data-target="#myCarousel3" data-slide-to="0" class="active"></li>
				      	<li data-target="#myCarousel3" data-slide-to="1"></li>
				      	<li data-target="#myCarousel3" data-slide-to="1"></li>
				    </ol>

				    <!-- Wrapper for slides -->
				    <div class="carousel-inner">
				      	<div class="item active">
				      		<h5>프리미어리그</h5>
				       	 	<img src="images/epl.png" alt="Los Angeles" style="width:100%; height: 40%;">
				      	</div>

				      	<div class="item">
				      		<h5>라리가</h5>
				        	<img src="images/la.png" alt="Chicago" style="width:100%; height: 40%;">
				      	</div> 

				      	<div class="item">
				      		<h5>분데스리가</h5>
				        	<img src="images/bun.png" alt="Chicago" style="width:100%; height: 40%;">
				      	</div> 
				    </div>

				    <a class="left carousel-control" href="#myCarousel3" data-slide="prev">
				      	<span class="glyphicon glyphicon-chevron-left"></span>
				      	<span class="sr-only">Previous</span>
				    </a>
				    <a class="right carousel-control" href="#myCarousel3" data-slide="next">
				      	<span class="glyphicon glyphicon-chevron-right"></span>
				      	<span class="sr-only">Next</span>
				    </a>
				</div>
			</div>
		</div>

		<div id="bodycontainerpan">
			<div id="pmaim">
				<div class="container">         
					<div class="col-xs-7">
						<h4 align="center">한국축구에 대해 잘 아는 사람을 위한</h4>
						<h3 align="center">한.축.잘.알 게시판</h3><br><br> 
					<form class="form-inline" method="post" action="koreasoccer.php"> 
					<select class="form-control" name="select">
					<option value="제목">제목</option>
					<option value="작성자">작성자</option>
					</select>
					<input type="text" class="form-control" name="search" size="20">
					<input type="submit" name="searchbtn" value="검색" class="btn btn-success">
					</form>
					<br><br>
					</div>
					
					<div class="col-xs-7"> 
					<table class="table table-striped" >
						    <thead>
						      <tr>
						        <th width="20%">분류</th>
						        <th width="50%">제목</th>
						        <th width="20%">작성자</th>
						        <?php 
						      	if(isset($_SESSION['adminlogin'])){
								?>
								<th width="10%">관리</th>
								<?php
								} 
								?> 
						      </tr>
						    </thead>

						    <?php
						    $con = mysqli_connect('localhost','root','123123','soccer');

							if(isset($_POST['searchbtn'])){
								$select = $_POST['select'];
								$search = $_POST['search'];

								if($select=="제목"){
									$sql="SELECT * FROM korea WHERE name  like '%$search%' order by id desc";
								} else if($select=="작성자"){
									$sql="SELECT * FROM korea WHERE user  like '%$search%' order by id desc";
								}

								$result=mysqli_query($con,$sql);

							} else{
							    $query = "SELECT * FROM korea order by id desc";
							    $result = mysqli_query($con,$query);
							}
							
						    $table_name="korea";

						    while ($row = mysqli_fetch_array($result)){
						    $id = $row[0];
						    $name = $row[1];
						    $user = $row[2];
						    $data = $row[3];
						    ?>
						    <tbody>
						      <tr>
						        <td>[한국]</td>
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
				      	if(isset($_SESSION['login'])){
					  ?>
						<a class="btn btn-success pull-right" href="write_korea.php">글쓰기</a>
					  <?php
					    } 
					  ?> 
					</div>
				</div>
			</div>
		</div>
                  		
        <br class="spacer" />

	</div>

  	<div class="blank"></div>

  	<div id="footercontainer">
		<div id="footer">
			<div id="frtop">
				<div id="fooertxt">
					<a href="content.php" class="fnav" title="축잘알_해축잘알">HOME</a> &nbsp;| &nbsp; 
					<a href="worldsoccer.php" class="fnav" title="축잘알_해축잘알">해축잘알</a> &nbsp;| &nbsp;    
					<span class="fnav">한축잘알</span> &nbsp;| &nbsp;    
					<a href="free.php" class="fnav" title="축잘알_자유게시판">자유게시판</a>&nbsp; |&nbsp;  
					<a href="check.php" class="fnav" title="축잘알_출석체크">출석체크</a>&nbsp; |&nbsp; 
					<a href="notice.php" class="fnav" title="축잘알_공지사항">공지사항</a>&nbsp; |&nbsp; 
				</div>
			</div>

			<div>
				<div class="copyrighttxt" id="copyright">Copyright &copy; 2006. All rights reserved.<br /> 
				Designed by <a href="http://www.free-css-templates.com/">Free CSS Templates</a>, 
				Thanks to <a href="http://www.openwebdesign.org/">Web Design UK</a></div>
			    <div id="cardcontainer">
					<div id="card"><a href="#"><img src="images/card.jpg" alt="" width="141" height="21" border="0" /></a></div>
					<div class="cardtxt" id="cardtxtcontainer">All major credit cards accepetd</div>
			    </div>					
			</div>
		</div>
		<br class="spacer" />	
  	</div>

</div>

</body>
</html>