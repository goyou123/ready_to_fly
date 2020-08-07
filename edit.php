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
        <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Parisienne&family=Special+Elite&display=swap" rel="stylesheet">
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
        </style>
        <!-- 네이버스마트에디터 공홈 -->
        <!-- <script type="text/javascript" src="../naversmarteditor/js/service/HuskyEZCreator.js" charset="utf-8"></script> -->
        <!-- 네이버스마트에디터 https://wonpaper.tistory.com/68-->
        <script type="text/javascript" src="/smarteditor2/js/HuskyEZCreator.js"></script>


      

        
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
                <h2>글 작성하기</h2>
            </div>
        </section>




        <!-- 글작성 -->
        <?php
        $conn = mysqli_connect("localhost:3306","root","9159348","user");
        $idx = $_GET['idx'];
        // var_dump($idx);
        $query ="SELECT * FROM main_board WHERE idx = $idx"; 
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_array($result);
        
        ?>



        <section class="visual2_writepage">
            <h2 hidden="hidden">글 작성하는 공간</h2>
            <div class="wirte_all">
                <div class="write_area">
                    <form action="edit_ok.php?idx=<?php echo $idx; ?>" method="POST">

                        <table class="table2">
                        <colgroup>
                            <col style = "width:10%">
                        </colgroup>
                            <tbody>
                            <tr>
                                <td>작성자</td>
                                <td><?php echo $_SESSION['name']?></td>
                            </tr>

                            <tr>
                                <td>제목</td>
                                <td><input type="text" name="title" value="<?php echo $row["title"]?>"></td>
                            </tr>

                            <tr>
                                <td>내용</td>
                                <td>
                                    
                                    <textarea name="content" id="content" rows="15" >
                                        <?php echo $row["content"]?>
                                    </textarea>
                                    <!--시작-->
                                    <script language="javascript">
                                    var oEditors = [];

                                    var sLang = "ko_KR"; // 언어 (ko_KR/ en_US/ ja_JP/ zh_CN/ zh_TW), default = ko_KR
                                    // 추가 글꼴 목록
                                    //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];


                                    nhn.husky.EZCreator.createInIFrame({
                                    oAppRef: oEditors,
                                    elPlaceHolder: "content",
                                    sSkinURI: "/smarteditor2/SmartEditor2Skin.html", 
                                    htParams : {
                                    bUseToolbar : true,    // 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                                    bUseVerticalResizer : true,  // 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                                    bUseModeChanger : true,   // 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                                    //bSkipXssFilter : true,  // client-side xss filter 무시 여부 (true:사용하지 않음 / 그외:사용)
                                    //aAdditionalFontList : aAdditionalFontSet,  // 추가 글꼴 목록
                                    fOnBeforeUnload : function(){
                                    //alert("완료!");
                                    },
                                    I18N_LOCALE : sLang
                                    }, //boolean
                                    fOnAppLoad : function(){
                                    //예제 코드
                                    //oEditors.getById["content"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                    },
                                    fCreator: "createSEditor2"
                                    });



                                    function pasteHTML(filepath) {

                                    // var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
                                    var sHTML = '<span style="color:#FF0000;"><img src="'+filepath+'"></span>';
                                    oEditors.getById["content"].exec("PASTE_HTML", [sHTML]);



                                    }



                                    function showHTML() {
                                    var sHTML = oEditors.getById["content"].getIR();
                                    alert(sHTML);
                                    }
                                    
                                    function submitContents(elClickedObj) {
                                
                                    oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용됩니다.

                                    
                                    // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("content").value를 이용해서 처리하면 됩니다.

                                    // try {

                                    // var form2 = document.f;
                                    // if (!form2.name.value) {
                                    // alert("작성자 이름을 입력해 주십시오");
                                    // form2.name.focus();
                                    // return;
                                    // }



                                    // if (!form2.subject.value) {
                                    // alert("글제목을 입력해 주십시오.");
                                    // form2.subject.focus();
                                    // return;
                                    // }



                                    // if (document.getElementById("content").value=="<p><br></p>") {
                                    // alert("내용을 입력해 주세요.");
                                    // oEditors.getById["content"].exec("FOCUS",[]);
                                    // return;
                                    // }



                                    // form2.action="notice_write_ok.php";
                                    // //elClickedObj.form.submit();
                                    // form2.submit();
                                    // } catch(e) {alert(e);}

                                     } //function 닫는거.
                                    


                                    // function setDefaultFont() {
                                    // var sDefaultFont = '궁서';
                                    // var nFontSize = 24;
                                    // oEditors.getById["content"].setDefaultFont(sDefaultFont, nFontSize);
                                    // }


                                    // function writeReset() {
                                    // document.f.reset();
                                    // oEditors.getById["content"].exec("SET_IR", [""]);

                                    // }
                                </script>
                                    <!--끝-->
                                </td>
                            
                            </tr>
                            </tbody>
                        </table>

                        <input type="submit" value="작성" id="submits" onclick="submitContents(this);">

                        <!-- 출처: https://chamggae.tistory.com/81 [silqia 공부 블로그] -->

                    </form>
                </div>

            </div>
        </section>

    </body>
</html>