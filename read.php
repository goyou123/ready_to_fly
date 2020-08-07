<?php
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
        <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous">
        </script>
         <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

        <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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
                background: url("/images/droneback5.jpg") no-repeat center center /100% auto;
            }
            .visual1 h2 {
                font-size: 50px;
                color: #fff;
                line-height: 450px;
                text-align: center;
            }
        </style>
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
                <h2>게시글 보기</h2>
            </div>
        </section>

        <!-- 게시글 상세화면 -->
        <?php
        $conn = mysqli_connect("localhost:3306","root","9159348","user");
        $idx = $_GET['idx'];
        // var_dump($idx);
        $query ="SELECT * FROM main_board WHERE idx = $idx"; 
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_array($result);
        
        //조회수 
        $see = "UPDATE main_board SET see =see+1 WHERE idx = $idx";
        $plus_see = mysqli_query($conn,$see);

        $count = "SELECT COUNT(*) bbs1_no FROM comments WHERE bbs1_no = $idx" ;
        $counts = mysqli_query($conn,$count);
        $count_result = mysqli_fetch_array($counts);
        // var_dump($count_result);
        // echo $count_result[0];

        ?>

        <section class="visual2_read">
            <h2 hidden="hidden">
                게시글 상세화면</h2>
            <div class="read_all">
                <div class="read_info">
                    <!-- <p>후에 게시판분류 추가</p> -->
                    <p><?php echo $row["title"]?></p>
                    <ul>
                        <li><?php echo $row["writer"]?></li>
                        <li><?php echo $row["date"]?></li>
                        <li><?php echo $row["see"]?></li>
                        <!--조회수-->
                    </ul>
                    <?php
                    if($_SESSION['name'] == $row["writer"]){?>
                    <div class="edit_delete">
                        <a href="edit.php?idx=<?php echo $idx; ?>">수정</a>
                        <a href="delete.php?idx=<?php echo $idx; ?>">삭제</a>
                        <a href="community.php">리스트</a>
                    </div>

                <?php } else {?>
                    <div class="edit_delete">
                        <a href="community.php">리스트</a>
                    </div>
                    <?php  } ?>
                </div>
                <div class="read_contents">
                    <p><?php echo $row["content"]?></p>
                </div>
            </div>
        </section>

        <!-- 댓글 -->

        <section class="visual3_comment">
            <div class="comment_all">

                <p>전체 댓글 수 :
                    <?php echo $count_result[0]; ?>
                </p>
                <?php

                
                    $query="SELECT * FROM comments WHERE bbs1_no = $idx and replys ='0' ORDER BY regdate asc, no asc";
                    $result = mysqli_query($conn,$query);

                    // while($row1 = mysqli_fetch_array($result)){
                ?>

                <!-- 메인 댓글 -->
                <div class="first">
                    <?php while($row1 = mysqli_fetch_array($result)){ ?>
                    <div class="firsts">
                        <?php 
                        if(($_SESSION['name']) == $row1['name']) {
                   
                        ?>
                        <div class="right">
                            <span class="wirte_replys">답글달기</span>
                                <script>
                                    $(document).ready(function() {
                                        
                                        $('.wirte_replys').click(function() {
                                        // var index = $(this).parent('.right').parent('.firsts').parent('.first').index();
                                        
                                        var index = $(this).parent().parent().index(".firsts");
                                            console.log(index);
        
                                        $('.third').eq(index).show();
                                        // $(this).parent().parent().parent().children('.third').show();
                                        });

                                        
                                    });
                                </script>
                          

                                <script>
                                    // $(document).ready(function() {
                                        
                                    //     $('.wirte_replys').click(function() {
                                    //     // var index = $(this).parent('.right').parent('.firsts').parent('.first').index();
                                        
                                    //     var index = $(this).parent().parent().index(".firsts");
                                    //         console.log(index);
        
                                    //     $('.third').eq(index).show();
                                    //     // $(this).parent().parent().parent().children('.third').show();
                                    //     });

                                        
                                    // });
                                </script>

                                <!-- 댓글수정스크립트-다이얼로그  -->
                                <script>
                                $(function(){
                                            //$("#dialog").dialog();
                                            $(".dialog11<?php echo $row1['no']?>").dialog({
                                                autoOpen:false, //자동으로 열리지않게
                                                // position:['center',20], //x,y  값을 지정
                                                position : {
                                                    my: 'center', at: 'bottom', of: '.first_ul'

                                                },
                                                //"center", "left", "right", "top", "bottom"
                                                modal:true, //모달대화상자
                                                resizable:false, //크기 조절 못하게
                                                width : 500,
                                                height: 170,
                                                buttons:{
                                                    "닫기":function(){
                                                        $(this).dialog("close");
                                                    }
                                                }
                                            });

                                            //창 열기 버튼을 클릭했을경우
                                            $(".comment_edit<?php echo $row1['no']?>").on("click",function(){
                                                $(".dialog11<?php echo $row1['no']?>").dialog("open"); //다이얼로그창 오픈                
                                            });
                                        });
                                </script>


                            <span>&nbsp;&nbsp;&nbsp;</span>
                            <style>
                            .comment_edit {padding: 0 10px 0 0; display: inline-block;}
                            .dialog11 {display: none;}
                            .dialog11 form input { background: red;}
                            </style>
                            <!-- <button><a href="comment_edit.php?no=<?php //echo $row1['no']?>&bbs1_no=<?php //echo $row1['bbs1_no']?>" class="comment_edit">[수정]</a></button> -->
                            <span class="comment_edit<?php echo $row1['no']?>">[수정]</span>
                            <span><a href="comment_delete.php?no=<?php echo $row1['no']?>&bbs1_no=<?php echo $row1['bbs1_no']?>">[DEL]</a></span>
                        </div>
                            <?php } ?>
                               
                        <ul class="first_ul">
                            <li><?php echo $row1["name"]?></li>
                            <li><?php echo $row1["memo"]?></li>
                            <li><?php echo $row1["regdate"]?></li>
                        </ul>
                    </div>
                    
                    <!--출력될 다이얼로그-->
                    <div class="dialog11<?php echo $row1['no']?>" title="댓글수정" style="display:none">
                    <form action="comment_edit.php?no=<?php echo $row1['no']?>&bbs1_no=<?php echo $row1['bbs1_no']?>" method="POST">
                        <input type="text" name="editcomment" id="editcomment" style="width: 400px; ">
                        <input type="submit" name="editsubmit" id="editsubmit" class="editsubmit" value ="완료" style="padding: 10px; background:#fbb036; color:#fff; ">
                    </form>
                    </div>


                    <!--대댓글 출력-->
                        <?php
                        $num = $row1['no'];
                        $query1="SELECT * FROM comments WHERE bbs1_no = $idx and replys = $num ORDER BY regdate asc, no asc";
                        $result1 = mysqli_query($conn,$query1);
                        while($row2 = mysqli_fetch_array($result1)){
                        ?>

                        
                        
                        <div class="second">
                            <ul class="second_ul">
                                <li><?php echo $row2["name"]?> / <?php echo $row2["regdate"]?></li>
                                <li><?php echo $row2["memo"]?>
                                <?php
                                if(($_SESSION['name']) == $row1['name']) {?>
                                    <div class="right1">
                                        <span class="del_button"><a href="comment_delete.php?no=<?php echo $row2['no']?>&bbs1_no=<?php echo $row2['bbs1_no']?>">[del]</a></span>
                                        
                                        <span class="edit_button"><a href="comment_delete.php?no=<?php echo $row2['no']?>&bbs1_no=<?php echo $row2['bbs1_no']?>">[수정]</a></span>
                                    </div>
                                    <?php } ?> <!--if종료 -->
                                </li>
                            </ul>
                            <!-- <ul class="second_ul">
                                <li>이름 / 날짜</li>
                                <li>내용qqqqq
                                    <div class="right1">
                                        <span class="del_button">[del]</span>
                                    </div>
                                </li>
                            </ul> -->
                        </div>
                         
                        <?php } ?> <!--while종료 -->
                    <!-- 대댓글 입력-->

                    <div class="third" id="replyss">
                        <span>└</span>
                        <form action="comment_write.php" name="replys" method="POST">
                            <!-- 추가적으로 보낼꺼 더 있을수도 -->
                            <input
                                type="hidden"
                                name="bbs1_no"
                                value="<?php echo $row['idx'] ?>"
                                title="게시판글 번호">
                            <input type="hidden" name="replys" value="<?php echo $row1['no'] ?>">
                            <textarea name="memo" id="memo" cols="80" rows="5"></textarea>
                            <input type="submit" id="re_memo_submits" value="작성하기" >
                        </form>
                    </div>
                    

                    <!-- 댓글수정수정 -->
   
                    <?php } ?>
                    <!--while문종료-->

                    <?php
               if(isset ($_SESSION['name'])) {
                   //로그인 되어있을때만 댓글작성칸 보임
            ?>
                    <!-- 댓글작성칸 -->

                    <table>
                        <caption>댓글</caption>
                        <colgroup>
                            <col style="width:10%">
                            <col style="width:10%">
                        </colgroup>
                        <tbody>
                            <tr>
                                <form action="comment_write.php" name="replys" method="POST">
                                    <input
                                        type="hidden"
                                        name="bbs1_no"
                                        value="<?php echo $row['idx'] ?>"
                                        title="게시판글 번호">
                                    <input type="hidden" name="replys" value="0">
                                    <!--일반댓글입력이라 값 0 -->
                                    <!-- <input type="hidden" name="" value="" > -->
                                    <td><?php echo $_SESSION['name'] ?></td>
                                    <td>Comments</td>
                                    <td>
                                        <textarea name="memo" id="memo" cols="80" rows="5"></textarea>
                                    </td>
                                    <td><input type="submit" id="comment_submits" value="O K"></td>
                                </form>
                            </tr>
                        </tbody>
                    </table>
                    <?php } ?>
                    <!--if문종료-->
                </div>
            </section>

        </body>
    </html>