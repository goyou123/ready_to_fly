<?php
include_once 'Snoopy.class.php'; 
session_start();
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
        <link rel="stylesheet" href="css/default.css">
        <link rel="stylesheet" href="css/style.css">
        <!-- XI ICON -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/xeicon@2.3.3/xeicon.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Parisienne&family=Special+Elite&display=swap" rel="stylesheet">
        <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
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
                background: url("/images/droneback4.jpg") no-repeat bottom center /100% auto;
            }
            .visual1 h2 {
                font-size: 50px;
                color: #fff;
                line-height: 450px;
                text-align: center;
            }
        </style>

        <script>
            $(document).ready(function() {
                $('.more_news').click(function() {
                    $(this).parent().parent().parent().children('.back2').show();
                    $(this).parent().hide();
                });

                                        
            });
        </script>
    </head>
    <body>
        <header>
            <div class="loginandsignup">
                <?php 
        if($sslogin){  
        ?>
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
        <section class="visual1">
            <div class="h2news">
                <h2>뉴스</h2>
            </div>
        </section>
        <!-- 여기서부턴 style.css에 있음 -->
        <section class ="visual2_news">
            <h2>드론 관련 뉴스</h2>
            <div class="back">
            <?php 
            $snoopy = new snoopy;
            //전체 불러오기 
            // $snoopy->fetch("https://www.sciencetimes.co.kr/news/tag/%eb%93%9c%eb%a1%a0/");
            // $text =  $snoopy->results;
            // print_r($text);

            //엔조이뉴스 가져오기
            // $snoopy->fetch("https://www.enjoydrone.com/bbs/board.php?bo_table=news");
            // preg_match('/<div class="template_type7">(.*?)<\/div>/is', $snoopy->results, $text);
            // $txt = $snoopy->results; 
            // print_r($txt);


            //필요한 데이터 가져오기
            $snoopy->fetch("https://www.sciencetimes.co.kr/news/tag/%eb%93%9c%eb%a1%a0/");
            preg_match('/<ul class="board_list type_thumb">(.*?)<\/ul>/is', $snoopy->results, $text);
            // print_r($text);
            // preg_match('/<span class=thumb">(.*?)<\/span>/is', $snoopy->results, $text2);
            echo $text[0];
            // echo $text2[0];
        
            echo '<br><br><br><br>';
            echo '<div class = "more">
            <span class ="more_news">더보기<i class ="xi-angle-down-thin"></i></span>
        </div>';
            // $snoopy->fetch("https://www.sciencetimes.co.kr/news/tag/%eb%93%9c%eb%a1%a0/page/2/");
            // preg_match('/<ul class="board_list type_thumb">(.*?)<\/ul>/is', $snoopy->results, $text1);
            // // print_r($text);
            // echo $text1[0];
            ?>
            </div>
            <!-- <div class = "more">
                <p class ="more_news">더보기<i class ="xi-angle-down-thin"></i></p>
            </div> -->
            <div class ="back2">
                <?php
                $snoopy = new snoopy;
                $snoopy->fetch("https://www.sciencetimes.co.kr/news/tag/%eb%93%9c%eb%a1%a0/page/2/");
                preg_match('/<ul class="board_list type_thumb">(.*?)<\/ul>/is', $snoopy->results, $text1);
                // print_r($text);
                echo $text1[0];

                ?>
            </div>
        </section>

    </body>
</html>