<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();

$con = mysqli_connect('localhost', 'root', '123123', 'soccer');

$id = $email = $phone = "";
$nameErr = $emailErr = $phoneErr = "";

if (isset($_POST['submit'])) {

    $id = $_POST['id'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    if (empty($_POST['id']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['phone'])) {
        echo "<script> alert('빈 칸을 채워주세요')</script>";

    } if (!preg_match("/^[a-z A-Z]+$/",$id)) {

        $nameErr = "영어 이름을 써주세요."; 

    } if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {

        $emailErr = "이메일 형식을 지켜주세요."; 

    } if (!preg_match("/^[0-9]+$/",$phone)) {

        $phoneErr = "숫자만 입력해주세요."; 

    } else {
        $query = "SELECT * FROM user_info WHERE user_id='$id' OR email='$email' ";
        $result = mysqli_query($con,$query);
        
        if ( mysqli_num_rows($result) > 0 ) {
            header("Location: registration.php?MSG=ID 또는 EMAIL 이 이미 존재합니다.");
        } else {
            $query = "INSERT INTO user_info (user_id, user_pass, email, phone) 
            VALUES ('$id','$password','$email', '$phone')";
            if (mysqli_query($con,$query)) {
                $_SESSION['login']=$id;
                header("Location: content.php"); 
            }        
        }
    }
} else if (isset($_POST['login'])) {

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

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>축.잘.알_국축잘알</title>
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

    <script>
        function showHint(str) {
        table_name="korea";
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","getHint.php?q="+str+"&table_name="+table_name,true);
        xmlhttp.send();
        }
    </script>

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
                <div id="leftmaim">
                <form method="post" action="registration.php">
                    <div class ="form-group">
                        <input type="text" class="form-control" name="id" size="10" placeholder="이름">
                        <input type="password" class="form-control" name="password" size="10" placeholder="비밀번호">
                        <br>
                        <button type="submit" class="btn btn-success" name="login">로그인</button>
                        <button type="submit" class="btn btn-success" name="registration">회원가입</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <div id="bodycontainerpan">
            <div id="pmaim">
                <div id="pmaim">
                    <h2 align="center">축.잘.알 회원가입</h2><br>
                    <div class="container">  
                        <?php
                            if(isset($_GET['MSG'])) {
                            echo $_GET['MSG'];
                            }
                        ?>
                        <form method="post" action="registration.php">
                            <div class="col-xs-7">  
                                <br><br>
                                <div class ="form-group">
                                    <table class="table">
                                    <tbody>
                                      <tr>
                                        <td width="100px"><label for="id">이름:</label></td>
                                        <td width="300px"><input type="text" class="form-control" name="id" size="10" placeholder="id" value="<?php echo $id;?>" onkeyup="showHint(this.value)"><div id="txtHint"></div></td>
                                        <td><span class="error">* <?php echo $nameErr;?></span></td> 
                                      </tr> 
                                      <tr>
                                        <td><label for="password">비밀번호:</label></td>
                                        <td><input type="password" class="form-control" name="password" size="10" placeholder="password"></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td><label for="email">이메일:</label></td>
                                        <td><input type="text" class="form-control" name="email" size="10" placeholder="E-mail" value="<?php echo $email;?>"></td>
                                        <td><span class="error">* <?php echo $emailErr;?></span></td>

                                      </tr>
                                      <tr>
                                        <td><label for="phone">전화번호:</label></td>
                                        <td><input type="text" class="form-control" name="phone" size="10" placeholder="Phone" value="<?php echo $phone;?>"></td>
                                        <td><span class="error">* <?php echo $phoneErr;?></span></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  
                                    <button type="submit" class="btn btn-success pull-right" name="submit">가입하기</button>
                                    <br><br>
                                    <b> 이미 회원이시면  <a href="index.php"> 여기</a>를 눌러주세요</b>
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
                    <span class="fnav">축잘알</span> &nbsp;| &nbsp;  
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