<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
}

if(isset($_POST['logout'])){
    header("Location: logout.php");
} else if(isset($_POST['userprofile'])){
    header("Location: userprofile.php");
}

$modify_id = $_GET['mod'];

$email = $phone = "";
$emailErr = $phoneErr = "";

if(isset($_POST['modify'])){

    $password=$_POST['password_modify'];   
    $email=$_POST['email_modify'];
    $phone=$_POST['phone_modify'];

    if (empty($password) || empty($email) || empty($phone)) {

        echo "<script> alert('빈 칸을 채워주세요')</script>";

    } if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {

        $emailErr = "이메일 형식을 지켜주세요."; 

    } if (!preg_match("/^[0-9]+$/",$phone)) {

            $phoneErr = "숫자만 입력해주세요."; 

    } else {

        $con = mysqli_connect('localhost', 'root','123123','soccer');

        $query = "UPDATE user_info SET user_pass='$password', email='$email', phone='$phone' WHERE id='$modify_id'";

        if (mysqli_query($con, $query)) {
            header("Location: userprofile.php");
        }
    }
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

    <style>
    .error {color: #FF0000;}
    </style>
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
                <li><a href="management.php"> 회원관리  </a></li>
                <li><a href="notice.php"> 공지사항  </a></li>
            </ul>
    </div>

            <div class="blank"></div>

    <div id="bodycontainer">
        <div id="bodycontainerleft">
            <div id="lmaim">
                <form method="post" action="modification.php">
                    <?=$_SESSION['login']?>님 <br><br>
                    <button type="submit" class="btn btn-success" name="userprofile">내프로필</button>
                    <button type="submit" class="btn btn-success" name="logout">로그아웃</button>
                </form>
            </div>
        </div>

        <div id="bodycontainerpan">
            <div id="pmaim">
                <div class="container"> 
                    <div class="col-xs-7">  
                    <h3 align="center">축.잘.알 회원정보수정</h3><br>
                        <?php
                            if(isset($_GET['MSG'])) {
                            echo $_GET['MSG'];
                            }
                        ?>
                        <form method="post" action="modification.php?mod=<?=$modify_id?>">
                        <br><br> 
                        <div class ="form-group">
                            <table class="table">
                            <?php
                            $con = mysqli_connect('localhost','root','123123','soccer');
                            $query = "SELECT * FROM user_info WHERE id= '$modify_id' ";
                            $result = mysqli_query($con,$query);

                            while ($row = mysqli_fetch_array($result)){
                            $id = $row[0];
                            $user_id = $row[1];
                            $user_pass = $row[2];
                            $user_email = $row[3];
                            $user_phone = $row[4];
                            ?>
                            <tbody>
                              <tr>
                                <td width="100px"><label for="id">이름:</label></td>
                                <td width="300px"><?= $user_id ?></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td><label for="passworda">비밀번호:</label></td>
                                <td><input type="password" class="form-control" name="password_modify" size="10" placeholder="Password"></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td><label for="emaila">이메일:</label></td>
                                <td><input type="text" class="form-control" name="email_modify" size="10" placeholder="E-mail" value="<?php echo $email;?>"></td>
                                <td><span class="error">* <?php echo $emailErr;?></span></td>
                              </tr>
                              <tr>
                                <td><label for="phonea">전화번호:</label></td>
                                <td><input type="text" class="form-control" name="phone_modify" size="10" placeholder="Phone" value="<?php echo $phone;?>"></td>
                                <td><span class="error">* <?php echo $phoneErr;?></span></td>
                              </tr>
                            </tbody>
                           <?php
                           }
                           ?>
                          </table>  
                          <button type="submit" class="btn btn-success pull-right" name="modify">수정하기</button>
                        </div>
                    </div>
                    </form>
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