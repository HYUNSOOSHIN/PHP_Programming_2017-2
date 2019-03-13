<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
if (!isset($_SESSION['adminlogin'])) {
    header("Location: index.php");
} 
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>축.잘.알_관리자</title>
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
                <li><a href="admin.php"> HOME  </a></li>
                <li><a href="worldsoccer.php"> 해축잘알  </a></li>
                <li><a href="koreasoccer.php"> 한축잘알  </a></li>
                <li><a href="free.php"> 자유게시판  </a></li>
                <li><span>회원관리</span></li>
                <li><a href="notice.php"> 공지사항  </a></li>
            </ul>
    </div>

    	<div class="blank"></div>
	
	<div id="bodycontainer">
		<div id="bodycontainerleft">
			<div id="lmaim">
				<form method="post" action="logout.php">
					관리자 <?=$_SESSION['adminlogin']?>
					<br><br>
					<button type="submit" class="btn btn-success" name="logout">로그아웃</button>
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
					<h3 align="center">회원관리</h3><br><br>    
					  <table class="table table-striped" >
					    <thead>
					      <tr>
					        <th>이름</th>
					        <th>비밀번호</th>
					        <th>이메일</th>
					        <th>전화번호</th>
					        <th>회원정보수정</th>
					        <th>회원삭제</th>
					      </tr>
					    </thead>
					    <?php
					    $con = mysqli_connect('localhost','root','123123','soccer');
					    $query = "SELECT * FROM user_info";
					    $result = mysqli_query($con,$query);
					    $table_name="user_info";

					    while ($row = mysqli_fetch_array($result)){
					    $id = $row[0];
					    $user_id = $row[1];
					    $user_pass = $row[2];
					    $email = $row[3];
					    $phone = $row[4];
					    ?>
					    <tbody>
					      <tr>
					        <td><?= $user_id ?></td>
					        <td><?= $user_pass ?></td>
					        <td><?= $email ?></td>
					        <td><?= $phone ?></td>
					        <td><a href="modification_admin.php?mod=<?=$id?>">수정</a></td>
							<td><a href="delete.php?del=<?=$id?>&table_name=<?=$table_name?>">삭제</a></td>
					      </tr>
					    </tbody>
					    <?php
						}
						?>
					  </table>
					</div>
				</div>
				

				<div class="container" align="center"> 
					<div class="col-xs-9">            
					  <ul class="pagination">
					  	<li><a href="#"><</a></li>
					    <li class="active"><a href="#">1</a></li>
					    <li class="disabled"><a href="#">2</a></li>
					    <li class="disabled"><a href="#">3</a></li>
					    <li class="disabled"><a href="#">4</a></li>
					    <li class="disabled"><a href="#">5</a></li>
					    <li><a href="#">></a></li>
					  </ul>
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
					<a href="admin.php" class="fnav" title="축잘알">HOME</a> &nbsp;| &nbsp; 
					<a href="worldsoccer.php" class="fnav" title="축잘알_해축잘알">해축잘알</a> &nbsp;| &nbsp; 
					<a href="koreasoccer.php" class="fnav" title="축잘알_한축잘알">한축잘알</a> &nbsp;| &nbsp; 
					<a href="free.php" class="fnav" title="축잘알_자유게시판">자유게시판</a>&nbsp; |&nbsp;  
					<a href="management.php" class="fnav" title="축잘알_출석체크">회원관리</a>&nbsp; |&nbsp; 
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