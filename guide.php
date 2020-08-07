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
        <?php 
            // $snoopy = new snoopy;
            // //필요한 데이터 가져오기
            // $snoopy->fetch("https://www.enjoydrone.com/bbs/board.php?bo_table=guide&wr_id=24&page=2");
            // preg_match('/<div class="view_detail">(.*?)<\/div>/is', $snoopy->results, $text);
            // print_r($text[1]);
          
            ?>

        <!--여기서부터 시작-->
        <section class="visual2_guide">
            <h3>드론 초보 가이드</h3>
            <p class="section-lead">드론을 처음 시작하는 분들에게 도움이 되는 가이드입니다.</p>
            <div class="services-grid">
                <div class="service1">
                    <i class="xi-book"></i>
                    <h4>초보자를 위한 드론 용어 정리</h4>
                    <p>- 드론 용어를 잘 모르면 잘 정리되있는 자료를 봐도 이해하기 어려움</p>
                    <p>- 온라인상 자료들에서 자주 등장하는 용어들을 정리</p>
                    <a href="guide_1.php" class="cta">자세히 보기 >
                        </a>
                    </div>

                    <div class="service2">
                        <i class="xi-dollar"></i>
                        <h4>첫 드론 구매 팁!</h4>
                        <p>- 드론의 이용 용도 분명히 하기!</p>
                        <p>- 가격(예산) 설정하기</p>
                        <p>- 입문은 완구용 드론부터!</p>
                        
                        <a href="guide_2.php" class="cta">자세히 보기 >
                           </a>
                        
                        </div>

                    <div class="service3">
                        <i class="xi-antenna"></i>
                        <h4>드론 기본 조종법</h4>
                        <p>- 드론이 어떻게 생겼던 "전후좌우"를 구분하는 방향이 존재</p>
                        <p>- 조종모드란 쉽게 말해 조종레버들의 위치</p>
                        <a href="guide_3.php" class="cta">자세히 보기 >
                            </a>
                    </div>
                </div>
              
                </section>

                
                <!-- footer -->
                <footer>
                    <p>COPYRIGHT ⓒ 2020 BY GO EUN-CHAN all right reserved.</p>
                </footer>
            </body>
        </html>