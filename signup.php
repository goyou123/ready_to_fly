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
        .visual1  { position:relative; width: 100%; height: 250px; background: url(/images/droneback4.jpg) no-repeat center center /100% auto; }
        .visual1 h2 {font-size: 50px; color: #fff; line-height: 300px; text-align: center;}



        .signup_main_outside { width: 500px; margin: 50px auto;background: #f5f5f5; border-radius: 15px;}
        .signup_main_inside { width: 400px; padding: 50px;}
        .signup_main_inside li {padding: 0 0 20px; text-align:left; }
        .signup_main_inside li label { display:inline-block; width:130px; font-size:15px;}
        .signup_main_inside input {  width: 250px; height: 40px; box-sizing: border-box; padding-left: 12px;}

        input#submits{display: inline-block; height: 60px; width: 60%; margin: 30px 80px; background:#fbb036; border-radius:58px; color:#fff; font-size: 18px;}
    </style>
</head>
<body>
<header>
    <!-- <div class="loginandsignup">
        <a href="#a">회원가입</a>
        <a href="login.php">로그인</a> 
    </div>  -->
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
	    </nav>
	</div>
</header>
<section class="visual1">
    
    <h2>회원가입</h2>
    
</section>
<section class="signup_main">
    <div class="signup_main_outside">
        <div class="signup_main_inside">
                <form method='POST' action='signup_ok.php'>
                <ul>
                    <li><label>아이디</label><input type="text" name="id" placeholder="새로운 아이디를 입력해주세요."></li>
                    <li><label>이메일</label><input type="email" name="email" placeholder="이메일을 입력해주세요."></li>
                    <li><label>이름</label><input type=""" name="name" placeholder="이름을 입력해주세요."></li>
                    <li><label>비밀번호</label><input type="password" name="password" placeholder="비밀번호는 20자 이내로 입력 가능합니다."></li>
                    <li><label>비밀번호확인</label><input type="password" name="pwcheck" placeholder="비밀번호를 재입력해주세요."></li>
                </ul>

                    <input type="submit" value="회원가입" id="submits">
                </form>
        </div>
    </div>
</section>