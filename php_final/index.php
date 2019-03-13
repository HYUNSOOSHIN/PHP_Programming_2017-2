<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();

$con = mysqli_connect('localhost', 'root', '123123', 'soccer');

if (isset($_POST['login'])) {
	
    $id = $_POST['id'];
    $password = $_POST['password'];

    if (empty($_POST['id'])) {
        echo "<script> alert('아이디를 입력하세요')</script>";
        }
    else if (empty($_POST['password'])) {
        echo "<script> alert('비밀번호를 입력하세요')</script>";
        }
    else {
    	$query = "SELECT user_id, user_pass FROM user_info WHERE user_id='$id' AND user_pass='$password' ";
    	$result = mysqli_query($con,$query);

  		$query2 = "SELECT admin_name, admin_pass FROM admin WHERE admin_name='$id' AND admin_pass='$password' ";
  		$result2 = mysqli_query($con,$query2);
    
    	if ( mysqli_num_rows($result) > 0 ) {
     	       	$_SESSION['login']=$id;
        	    header("Location: content.php");
   		} else if(mysqli_num_rows($result2) > 0){
    			$_SESSION['adminlogin']=$id;
     	     	header("Location: admin.php");
   		} else {
       			echo "<script> alert('아이디 또는 비밀번호가 틀렸습니다.')</script>";
    	}
    }
} else if(isset($_POST['registration'])){
	header("Location: registration.php");
}
?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>축.잘.알</title>
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
				<a href="index.php">
				<img src="images/banner.png" alt="축.잘.알" title="축.잘.알" width="100%" height="300px" />
				</a>
			</div>				
		</div>			
		<br class="spacer" />
	</div>

		<div class="blank"></div>

	<div id="navcontainer">
        <ul>
            <li><span>Home</span></li>
            <li><a href="worldsoccer.php"> 해축잘알  </a></li>
            <li><a href="koreasoccer.php"> 한축잘알  </a></li>
            <li><a href="free.php"> 자유게시판  </a></li>
            <li><a href="check.php"> 출석체크  </a></li>
            <li><a href="notice.php"> 공지사항  </a></li>
        </ul>
    </div>

    		<div class="blank"></div>
	
	<div id="bodycontainer">
		<div id="bodycontainerleft">
			<div id="lmaim">
				<form method="post" action="index.php">
					<div class ="form-group">
						<input type="text" class="form-control" name="id" size="10" placeholder="이름">
						<input type="password" class="form-control" name="password" size="10" placeholder="비밀번호">
						<br>
						<button type="submit" class="btn btn-success" name="login">로그인</button>
						<button type="submit" class="btn btn-success" name="registration">회원가입</button>
					</div>
				</form>
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
				       	 	<img src="images/epl.png" alt="Los Angeles" style="width:100%; height: 200px;">
				      	</div>

				      	<div class="item">
				      		<h5>라리가</h5>
				        	<img src="images/la.png" alt="Chicago" style="width:100%; height: 200px;">
				      	</div> 

				      	<div class="item">
				      		<h5>분데스리가</h5>
				        	<img src="images/bun.png" alt="Chicago" style="width:100%; height: 200px;">
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

		<div id="bodycontainercenter">
			<div id="cmaim">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
				    <!-- Indicators -->
				    <ol class="carousel-indicators">
				      	<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				      	<li data-target="#myCarousel" data-slide-to="1"></li>
				      	<li data-target="#myCarousel" data-slide-to="2"></li>
				      	<li data-target="#myCarousel" data-slide-to="3"></li>
				      	<li data-target="#myCarousel" data-slide-to="4"></li>
				    </ol>

				    <!-- Wrapper for slides -->
				    <div class="carousel-inner">
				      	<div class="item active">
				       	 	<img src="images/park.png" alt="Los Angeles" style="width:100%; height: 400px;">
				      	</div>

				      	<div class="item">
				        	<img src="images/lampard.png" alt="Chicago" style="width:100%; height: 400px;">
				      	</div>
				    
				      	<div class="item">
				        	<img src="images/zlatan.png" alt="New york" style="width:100%; height: 400px;">
				      	</div>

				      	<div class="item">
				        	<img src="images/kaka.png" alt="New york" style="width:100%; height: 400px;">
				      	</div>

				      	<div class="item">
				        	<img src="images/totti.png" alt="New york" style="width:100%; height: 400px;">
				      	</div>
				    </div>

				    <!-- Left and right controls -->
				    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
				      	<span class="glyphicon glyphicon-chevron-left"></span>
				      	<span class="sr-only">Previous</span>
				    </a>
				    <a class="right carousel-control" href="#myCarousel" data-slide="next">
				      	<span class="glyphicon glyphicon-chevron-right"></span>
				      	<span class="sr-only">Next</span>
				    </a>
				</div>	
			</div>
		</div>

		<div id="bodycontainerright">
			<div id="rmaim">
				<div id="Carousel" class="carousel slide" data-ride="carousel">
				    <!-- Indicators -->
				    <ol class="carousel-indicators">
				      	<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				      	<li data-target="#myCarousel" data-slide-to="1"></li>
				    </ol>

				    <!-- Wrapper for slides -->
				    <div class="carousel-inner">
				      	<div class="item active">
				       	 	<img src="images/toto.png" alt="Los Angeles" style="width:100%; height: 400px;">
				      	</div>

				      	<div class="item">
				        	<img src="images/toto2.png" alt="Chicago" style="width:100%; height: 400px;">
				      	</div> 
				    </div>

				    <a class="left carousel-control" href="#Carousel" data-slide="prev">
				      	<span class="glyphicon glyphicon-chevron-left"></span>
				      	<span class="sr-only">Previous</span>
				    </a>
				    <a class="right carousel-control" href="#Carousel" data-slide="next">
				      	<span class="glyphicon glyphicon-chevron-right"></span>
				      	<span class="sr-only">Next</span>
				    </a>
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
					<span class="fnav">HOME</span> &nbsp;| &nbsp;    
					<a href="worldsoccer.php" class="fnav" title="축잘알_해축잘알">해축잘알</a> &nbsp;| &nbsp; 
					<a href="koreasoccer.php" class="fnav" title="축잘알_한축잘알">한축잘알</a> &nbsp;| &nbsp; 
					<a href="free.php" class="fnav" title="축잘알_자유게시판">자유게시판</a>&nbsp; |&nbsp;  
					<a href="worldsoccer.php" class="fnav" title="축잘알_출석체크">출석체크</a>&nbsp; |&nbsp; 
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