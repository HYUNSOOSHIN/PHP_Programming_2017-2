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

date_default_timezone_set("Asia/Seoul");
$time = date("Y-m-d");
$time2 = date("H:i");

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>축.잘.알_출석체크</title>
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
                <li><a href="koreasoccer.php"> 한축잘알  </a></li>
                <li><a href="free.php"> 자유게시판  </a></li>
                <li><span>출석체크</span></li>
                <li><a href="notice.php"> 공지사항  </a></li>
            </ul>
    </div>	

    	<div class="blank"></div>
	
	<div id="bodycontainer">
		<div id="bodycontainerleft">
			<div id="lmaim">
				<form method="post" action="free.php">
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
				<div id="panmaim">
					<h3 align="center">출석체크</h3><br><br> 
					<h2 align="center"><?=$time?></h2><br><br> 
					<div class="container">  
						<form class="form-inline" action="check.php" method="POST">
							<div class="col-xs-7">  
							<div class="form-group">
						        		
								<table class="table">
									<thead>
										<tr class="success">
											<th width="80px"><label>이름</label></th>
						        			<th width="500px">
						        				<input type="text" name="check" class="form-control" id="check" size="40">
						        				<input type="submit" name="checkbtn" value="출석하기" class="btn btn-default">
						        			</th>
						        			
						    			</tr>
									</thead>


								<?php
								
								if(isset($_POST['checkbtn'])){ //출석하기 버튼  
									$list = fopen("$time.txt", "a");  //파일 열고 
									$txt =$_SESSION['login']."*".$_POST['check']."*"."($time2)"."\n"; //들어갈 텍스트 준비
									fwrite($list, $txt); //파일에 텍스트를 쓴다.
									fclose($list); //파일 닫는다.

								}

								if(file_exists("$time.txt")){
									fopen("$time.txt", "r");
									$users = explode("\n",file_get_contents("$time.txt"));

								    foreach ( $users as $user1 ) {
								       	$check = explode("*",$user1);
								       	$check_name = $check[0];
								        $check_comment = isset($check[1]) ? $check[1] : '';
								        $check_time = isset($check[2]) ? $check[2] : '';   
								        //offset 에러 없애주는 코드
								?>

                                	<tbody>
                                      <tr class="success">
                                        <td width="80px"><?=$check_name?></td>
                                        <td width="700px"><?=$check_comment?> <?=$check_time?></td>
                                      </tr>
                                	</tbody>
                                <?php
	                            	}
	                            }
	                            ?>
                                </table>
						    </div>
							</div>	
						</form>	
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
					<a href="koreasoccer.php" class="fnav" title="축잘알_해축잘알">한국잘알</a> &nbsp;| &nbsp;
					<span class="fnav">자유게시판</span> &nbsp;| &nbsp;      
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