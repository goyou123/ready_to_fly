<!--세션으로 로그인 여부를 판별하고 로그인이안되있으면 로그인 페이지로 이동-->
<?php
session_start();
if(isset ($_SESSION['name'])){ 
    $sslogin=TRUE;
    } else if(!isset ($_SESSION['name'])) {?>
    <script>
        alert("로그인이 필요합니다");
        location.replace("login.php");
    </script>
<?php } ?>
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
        </style>


        <!-- 주소 API -->
        <!-- 키 : devU01TX0FVVEgyMDIwMDcyNzEyNTk1MjEwOTk5NDI= -->
        
        <!--다음 주소 API-->
        <script type="text/JavaScript" src="http://code.jquery.com/jquery-1.7.min.js"></script>

        <script type="text/JavaScript" src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>

        <script type="text/javascript">

            function openDaumZipAddress() {

                new daum.Postcode({

                    oncomplete:function(data) {

                        jQuery("#postcode1").val(data.postcode1);

                        jQuery("#postcode2").val(data.postcode2);

                        jQuery("#zonecode").val(data.zonecode);

                        jQuery("#address").val(data.address);

                        jQuery("#address_etc").focus();

                        console.log(data);

                    }

                }).open();

            }

        </script>




<body > 
    
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
                <h2>비행장소 추천</h2>
            </div>
        </section>



        <section class="visual2_add_flyzone">
            <h2 hidden>비행장소 추천글작성</h2>
            <div class="addzone_all">
     
                <div class="add_area">
                    <form action="add_flyzone_ok.php" method="post" enctype="multipart/form-data">
                    <table class="table2">
                        <colgroup>
                            <col style = "width:15%">
                        </colgroup>
                            <tbody>
                            <tr>
                                <td>작성자</td>
                                <td>&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['name']?></td>
                            </tr>
                            <tr>
                                <td>제목</td>
                                <td><input type="text" name="title" style="width:240px;" ></td>
                            </tr>
                            <tr>
                                <td>주소</td>
                                <!-- <td><input type="text" name="address"></td> -->
                                <!-- 다음주소API -->
                                <td>
                                    <input type="text" id="address" value="" name="address" style="width:240px;" readonly onClick="openDaumZipAddress();"/>
                                    <input type="button" class="juso" onClick="openDaumZipAddress();" value = "주소 찾기" />
                                </td>
                                <!-- <td><input type="button" class="juso" onClick="openDaumZipAddress();" value = "주소 찾기" /></td> -->
                            </tr>
                            <tr>
                                <td>사진</td>
                                <td>
                                        <!--
                                        만약 업로드 할 파일의 크기가 300kb를 넘는다면 업로드 에러가 발생한다.
                                        MAX_FILE_SIZE 태그는 반드시 input type='file' 태그 위에 선언해야 한다.
                                        -->
                                    <input type="hidden" name="MAX_FILE_SIZE" value="900000" />
                                    <input type="file" name="fileupload" style="width:240px;">
                                </td>
                            </tr>
                            <tr>
                                <td>한줄 팁</td>
                                <td><input type="text" name="tips" style="width:240px;" ></td>
                            </tr>
                            <tr>
                                <td>지역</td>
                                <td class="radio">
                                    <input type="radio" name="area" value="1">서울/경기
                                    <input type="radio" name="area" value="2">강원
                                    <input type="radio" name="area" value="3">충청
                                    <input type="radio" name="area" value="4">경상
                                    <input type="radio" name="area" value="5">전라
                                    <input type="radio" name="area" value="6">제주
                                </td>
                            </tr>
                        </table>
                        <input type="submit" value="장소추천" id="submits">        
                    </form>
                </div>

            </div>

        </section>


</body>
</html>