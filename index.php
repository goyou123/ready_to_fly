<?php
session_start();
// if(isset ($_SESSION['name'])){
//     $sslogin=TRUE;
// }

$conn = mysqli_connect("localhost:3306","root","9159348","user");
if(isset ($_COOKIE['user_id_cookie']) && isset ($_COOKIE['user_password_cookie'])) {
    //체크박스 체크해서 쿠키 있을때
    $cookie_user = $_COOKIE['user_id_cookie']; //goyou123
    $cookie_password =$_COOKIE['user_password_cookie']; //123123
    $query = "SELECT * FROM user_info WHERE id = '$cookie_user'";
    $result = mysqli_query($conn,$query);
    $row3 = mysqli_fetch_array($result);
    $pass = $row3[0]; // = goyou123 (입력) / 이름
    $names = $row3[2]; // 고은찬 

    // var_dump($pass); //goyou123 
    // var_dump($cookie_user); //goyou123
    // var_dump($cookie_password); //123123
    // var_dump($names); //고은찬
    // // session_start();
    // var_dump($_SESSION['id']);
    
    //쿠키가 있고 그게 db의 이름과 일치하면 세션값에 쿠키값을 넣는다.
    if($cookie_user==$pass){
        // echo " 실행?";
        // echo $cookie_user;
        $_SESSION['id'] = $cookie_user;
        $_SESSION['name'] = $names;
        // echo $_SESSION['name'];
        if(isset ($_SESSION['name'])){
            $sslogin=TRUE;
        }
      
    }
}else{
    // 자동로그인 비 체크시 그냥 세션만
    if(isset ($_SESSION['name'])){
    $sslogin=TRUE;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>dronecommunity</title>
        <!-- default.css 연결 -->
        <link rel="stylesheet" href="css/default.css">
        <link rel="stylesheet" href="css/style.css">
        <!-- <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet"> -->
        <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Parisienne&family=Special+Elite&display=swap" rel="stylesheet">
        <!-- 제이쿼리가 맨 위로 -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        
        <!-- XI ICON -->
        <link
            rel="stylesheet"
            href="//cdn.jsdelivr.net/npm/xeicon@2.3.3/xeicon.min.css">

        <!-- 폰트- google -->
        <link
            href="https://fonts.googleapis.com/css?family=Fredericka+the+Great&display=swap"
            rel="stylesheet">


        <!-- 슬릭 스와이퍼 -->
        <link rel="stylesheet" type="text/css" href="http://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <script type="text/javascript" src="http://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>



        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->



        <script>
            // 팝업창 실행되는 스크립트
            function viewpop(){
                <?php if(!isset($_COOKIE['POPUP'])) { ?>
                    popwin = open("popup24.php","popwin","width=400,height=480");
                    popwin.focus();

                <?php } ?>
            }
        </script>


        


    </head>
<!--홈페이지 들어오면 팝업창 실행-->
    <body onload="viewpop()"> 
    <!-- <body>  -->
        <header>
            <?php 
                // var_dump($pass); //goyou123 
                // var_dump($cookie_user); //goyou123
                // var_dump($cookie_password); //123123
                // var_dump($names); //고은찬
            ?>

            <div class="loginandsignup">
                <?php 
                // setcookie("POPUP",true,time(),"/");
        if($sslogin){  
        ?>
                <p><?php echo $_SESSION['name']."(".$_SESSION['id'].")님 환영합니다.";?></p>
                <a href="logout.php">로그아웃</a>
                <a href="mypage.php">마이 페이지</a>
            <?php } else { 
        echo "<a href='signup.php'>회원가입</a>";
        echo "<a href='login.php'>로그인</a>";
    
    }?>
                <!-- <a href="signup.php">회원가입</a> <a href="login.php">로그인</a> -->
            </div>
            <div class="center">
                <h1>
                    <a href="index.php">Ready To Fly</a>
                </h1>
                <h2 class="hide">대메뉴</h2>
                <nav>
                    <ul>
                        <li>
                            <a href="news.php" class="one">드론뉴스</a>
                        </li>
                        <!-- <li>
                            <a href="#a" class="three">드론영상</a>
                        </li> -->
                        <li>
                            <a href="community.php" class="four">커뮤니티</a>
                        </li>
                        <li>
                            <a href="flyzone.php" class="five">비행금지구역</a>
                        </li>
                        <li>
                            <a href="guide.php" class="one">초보 가이드</a>
                        </li>
                        <!-- <li><a href="#a" class="two">자격증</a></li> -->
                    </ul>
                    <a href="#a" class="menu">
                        <i class="xi-bars"></i>
                    </a>
                </nav>
            </div>
        </header>

        <!-- 메인첫화면 -->
        <section class="visual1" >
            
            <div class="index">
                <div class="face">
                    <b>DRONE COMUNNITY</b>
                    <a href="guide.php">초보자 바로가기</a>
                </div>
            </div>
            <div class="index2">
				<div class="backblack">
				<div class ="face2">
				
				<iframe width="560" height="315" src="https://www.youtube.com/embed/cVwW8WMGvI4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					<b>DRONE MOTIVATION</b>
				</div>
				</div>
			</div>
           
            <!-- <a class="left_click">
                <i class="xi-angle-left"></i>
            </a>
            <a class="right_click">
                <i class="xi-angle-right"></i>
            </a> -->
        </section>
        <!-- 슬릭 슬라이더 -->
        <script type="text/javascript">
            //슬릭 - Jquery
            //페이지 자동 넘김
            $('.visual1').slick({
                autoplay: true,
                autoplaySpeed: 3500,
            });
        </script>
        <!-- 인기영상보여줄예정 -->
        <section class="visual2">
            <div class="h2h2">
                <h2 hidden="hidden">메뉴상세이동</h2>
            </div>
            <div class ="menu_box">
                <ul>
                    <li>
                        <a href="news.php">
                            <div class="outbox">
                                <div class ="inbox">
                                    <b>드론 뉴스</b>
                                    <p>드론에 관련된 최신 뉴스들을 만나보실 수 있습니다.</p>
                                </div>
                            </div>
                            <span class="plus">
                                <i class="xi-plus"></i>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="community.php">
                            <div class="outbox">
                                <div class ="inbox">
                                    <b>커뮤니티</b>
                                    <p>사람들과 드론에 관한 이야기를 주고 받을 수 있습니다.</p>
                                </div>
                            </div>
                            <span class="plus">
                                <i class="xi-plus"></i>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="flyzone.php">
                            <div class="outbox">
                                <div class ="inbox">
                                    <b>비행금지구역</b>
                                    <p>비행금지구역을 지도로 확인하고 비행 장소를 추천받을 수 있습니다.
                                    </p>
                                </div>
                            </div>
                            <span class="plus">
                                <i class="xi-plus"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>  
        </section>




        <!-- footer -->
        <footer>
            <p>COPYRIGHT ⓒ 2020 BY GO EUN-CHAN all right reserved.</p>
        </footer>

    </body>
</html>