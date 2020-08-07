<?php
session_start();
include_once 'Snoopy.class.php'; 
if(isset ($_SESSION['name'])){
    $sslogin=TRUE;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Parisienne&family=Special+Elite&display=swap" rel="stylesheet">
        <!-- XI ICON -->
        <link
            rel="stylesheet"
            href="//cdn.jsdelivr.net/npm/xeicon@2.3.3/xeicon.min.css">

        <!-- JQUERY -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
        $( document ).ready( function() {
            $( window ).scroll( function() {
            if ( $(this).scrollTop() > 200 ) {
                $( '.top' ).fadeIn();
            } else {
                $( '.top' ).fadeOut();
            }
            } );
            $( '.top' ).click( function() {
            $( 'html, body' ).animate( { scrollTop : 0 }, 400 );
                return false;
                } );
            } );
        </script>
        <link rel="stylesheet" href="css/default.css">
        <link rel="stylesheet" href="css/style.css">
        <style>
            header {
                background: none;
            }
            header .loginandsignup {
                background: none;
            }
            .visual1 {
                position: relative;
                width: 100%;
                height: 400px;
                background: url("/images/droneback8.jpg") no-repeat center center /100% auto;
            }
            .visual1 h2 {
                font-size: 50px;
                color: #fff;
                line-height: 450px;
                text-align: center;
            }

            /* 페이징 */
            #page_num {
                font-size: 14px;
                width: 260px;
                margin: 30px auto;
            }
            #page_num ul li {
                float: left;
                margin-left: 10px;
                text-align: center;
            }
            .fo_re {
                font-weight: bold;
                color: #fbb036;
            }
        </style>

    </head>
    <body>
        <header>
            <div class="loginandsignup">
                <?php 
        if($sslogin){  ?>
                <p><?php echo $_SESSION['name']."(".$_SESSION['id'].")님 환영합니다.";?></p>
                <a href="logout.php">로그아웃</a>
                <a href="mypage.php">마이 페이지</a>
            <?php } else { 
        echo "<a href='signup.php'>회원가입</a>";
        echo "<a href='login.php'>로그인</a>";
        }?>
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
                        <!-- <li> <a href="#a" class="three">드론영상</a> </li> -->
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
        <section class="visual1">
            <div class="h2news">
                <h2>초보 가이드</h2>
            </div>
        </section>
    
        <!--여기서부터 시작-->
        <section class="visual2_guide1">
            <div class="backmenu" >
                <a href="guide.php">< 목록으로 가기</a>
                <h2>첫 드론 구매 팁</h2>
            </div>
            <br>
            <a href = "#" class="top">맨 위로</a>
        <?php 
            $snoopy = new snoopy;
            //필요한 데이터 가져오기
            $snoopy->fetch("https://www.enjoydrone.com/bbs/board.php?bo_table=guide&wr_id=18");
            preg_match('/<div class="view_detail">(.*?)<\/div>/is', $snoopy->results, $text);
            print_r($text[1]);
          
            ?>

        <a href="https://www.enjoydrone.com">출처 : 엔조이드론 (https://www.enjoydrone.com)</a>
        </section>

           <!-- footer -->
        <footer>
            <p>COPYRIGHT ⓒ 2020 BY GO EUN-CHAN all right reserved.</p>
        </footer>
    </body>
</html>