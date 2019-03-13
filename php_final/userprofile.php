<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();

$session=$_SESSION['login'];

if (!isset($_SESSION['login'])) {
	header("Location: index.php");
}

if(isset($_POST['logout'])){
    header("Location: logout.php");
} else if(isset($_POST['userprofile'])){
    header("Location: userprofile.php");
}

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>축.잘.알_내프로필</title>
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
                <li><a href="check.php"> 출석체크  </a></li>
                <li><a href="notice.php"> 공지사항  </a></li>
            </ul>
    </div>

            <div class="blank"></div>

    <div id="bodycontainer">
        <div id="bodycontainerleft">
            <div id="lmaim">
                <form method="post" action="userprofile.php">
					<?=$_SESSION['login']?>님 <br><br>
					<button type="submit" class="btn btn-success" name="userprofile">내프로필</button>
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
                    <h3 align="center">축.잘.알 내프로필</h3><br>
                     
                    <?php
                        if(isset($_GET['MSG'])) {
                        echo $_GET['MSG'];
                        }
                    ?>  
                        <br><br>
                        <div class ="form-group">
                            <table class="table">
                            <?php
						    $con = mysqli_connect('localhost','root','123123','soccer');
						    $query = "SELECT * FROM user_info WHERE user_id= '$session' ";
						    $result = mysqli_query($con,$query);

						    while ($row = mysqli_fetch_array($result)){
						    $id = $row[0];
						    $user_id = $row[1];
						    $user_pass = $row[2];
						    $email = $row[3];
						    $phone = $row[4];
						    ?>
                            <tbody>
                              <tr>
                                <td><label for="id">이름:</label></td>
                                <td><?= $user_id ?></td>
                              </tr>
                              <tr>
                                <td><label for="password">비밀번호:</label></td>
                                <td><?= $user_pass ?></td>
                              </tr>
                              <tr>
                                <td><label for="email">이메일:</label></td>
                                <td><?= $email ?></td>
                              </tr>
                              <tr>
                                <td><label for="phone">전화번호:</label></td>
                                <td><?= $phone ?></td>
                              </tr>
                            </tbody>
                           <?php
						   }
						   ?>
                          </table>

                          <a class="btn btn-success pull-right" href="modification.php?mod=<?=$id?>">수정하기</a>
                        </div>
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
                <div id="fooertxt"><span class="fnav">축잘알</span> &nbsp;| &nbsp;  
                    <a href="worldsoccer.php" class="fnav" title="축잘알">해축잘알</a> &nbsp;| &nbsp; 
                    <a href="koreasoccer.php" class="fnav" title="축잘알_국축잘알">한축잘알</a> &nbsp;| &nbsp; 
                    <a href="worldsoccer.php" class="fnav" title="축잘알_축알못">축알못</a>&nbsp; |&nbsp;  
                    <a href="worldsoccer.php" class="fnav" title="축잘알_공지사항">공지사항</a>&nbsp; |&nbsp;  
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