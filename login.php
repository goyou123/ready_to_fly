<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Parisienne&family=Special+Elite&display=swap" rel="stylesheet">
    <style>
         header{background: none;}
        header .loginandsignup{background: none;}
        .visual1  { position:relative; width: 100%; height: 100px; background: url(/images/droneback4.jpg) no-repeat center center /100% auto; }
        .visual1 h2 {font-size: 50px; color: #fff; line-height: 100px; text-align: center;}




        /* 메뉴바에서 회원가입,로그인 버튼제외 */
        body { background: #fff;}
        .loginandsignup {display: none;}
        .center {background: #dbdbdb;}
        .center a{color: #fff;}

        /*로그인화면 css*/        
        .login { position:absolute; left:50%; top:55%; width:650px; height:500px; background:#f5f5f5; transform:translate(-50%, -50%); border-radius: 15px; padding:0 80px; text-align:center; box-sizing:border-box; } /*자기크기의 반만큼 이동해서 가운데로 오게 해줌=공식*/
        .login h2 { padding:82px 0 54px; font-size:31px; color:#333; line-height:100%; /*line-hei줄간격초기화*/}
       
        .login li { padding: 0 0 44px; text-align:left;  }
        .login li label { display:inline-block; width:120px; font-size:15px;}
        .login li input { padding:0 0 0 21px; width:370px; height:54px; box-sizing:border-box;}

        .login li:nth-child(3){ padding: 0;}
        .login li:nth-child(3) label { display:inline-block; width:120px; font-size:15px;}
        .login li:nth-child(3) input { padding: 0; width: 25px; height: 25px;}
        input#submits{ width:100%; height:58px; background:#fbb036; border-radius:58px; color:#fff;
        margin: 20px 0 0 0 ; font-size: 17px;} /* border-radius값은 높이값만큼 주기*/
        .login a { font-size:15px; color:#777; }
        .login span { display:inline-block; margin:0 0 0 20px; padding: 0 20px 0 0; height: 16px; border-left: 1px solid #dbdbdb; vertical-align:-3px; } /*선, span은 인라인요소, 선 기준으로 안쪽,바깥쪽 여백 vertical은 선 맞추기 */

        
    </style>
</head>
<body>



<header>
    <div class="navAll">
        <div class="loginandsignup">
            <a href="signup.php">회원가입</a>
            <a href="login.php">로그인</a>  
        </div> 
        <div class="center">
        <h1><a href="index.php">Ready To Fly</a></h1>
        <h2 class="hide">대메뉴</h2>
            <nav>  
                <ul>
                    <li><a href="news.php" class="one">드론뉴스</a></li>
                    <!-- <li><a href="#a" class="three">드론영상</a></li> -->
                    <li><a href="community.php" class="four">커뮤니티</a></li>
                    <li><a href="flyzone.php" class="five">비행금지구역</a></li>
                    <li><a href="guide.php" class="one">초보 가이드</a></li>
                    <!-- <li><a href="#a" class="two">자격증</a></li> -->
                </ul>
                    <!-- <a href="#a" class="menu"><i class="xi-bars"></i></a> -->
            </nav>
        </div>
    </div>
</header>
<section class="visual1">

    
</section>



<div class="login">
	<h2>로그인</h2>
    <form method="post" action="login_ok.php">
	<ul> <!--label:text클릭해도 -->
		<li><label>아이디</label><input type="text" placeholder="아이디를 입력해주세요" name="id"></li>
		<li><label>비밀번호</label><input type="password" placeholder="비밀번호를 입력해주세요" name="password" ></li>
        <li><label>자동로그인</label><input type="checkbox" name="auto_login" value="2"></li>
		<li><input type="submit" value="로그인" id="submits"></li>
    </ul>
    </form>
	<!-- <a href="">아이디 찾기</a><span></span><a href="">비밀번호 찾기</a><span></span><a href="">가입하기</a> -->
</div>



</body>


</html>