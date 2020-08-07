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
        <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Parisienne&family=Special+Elite&display=swap" rel="stylesheet">
        <!-- J-Query -->
        <script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous">
        </script>

        <!-- 탭 메뉴 스크립트 -->
         <script>
            $(document).ready(function(){
                
                $('ul.tabs li').click(function(){
                    //선택자를 통해 tabs 메뉴를 클릭 이벤트를 지정해줍니다.
                    var tab_id = $(this).attr('data-tab');
                    
                    //선택 되있던 탭의 current css를 제거하고 
                    $('ul.tabs li').removeClass('current');	
                    $('.tab-content').removeClass('current');		

                    $(this).addClass('current');								////선택된 탭에 current class를 삽입해줍니다.
                    $("#" + tab_id).addClass('current');
                })

            });
        </script>

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

            /* 페이징 */
            #page_num {
                font-size: 14px;
                width: 350px;
                margin-top:30px;
                margin: 30px auto;
            }
            #page_num ul li {
                float: left;
                margin-left: 10px; 
                text-align: center;
            }
            .fo_re {
                font-weight: bold;
                color:#fbb036;
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
            <div class="h2mypage">
                <h2>마이 페이지</h2>
            </div>
        </section>
        <section class="visual2_mypage">
            <h2 hidden>내 정보</h2>
            <div class="mypage_all">
                <p class="hello_user">"<b><?php echo $_SESSION['name']?></b> 회원님 반갑습니다."</p>
                <div class="container">
                <!-- 탭 메뉴 상단 시작 -->
                    <ul class="tabs">
                        <li class="tab-link current" data-tab="tab-1">회원정보</li>
                        <li class="tab-link" data-tab="tab-2">내가 쓴 글</li>
                        <li class="tab-link" data-tab="tab-3">내가 북마크한 비행지역</li>
                    </ul>
                <!-- 탭 메뉴 상단 끝 -->
                <!-- 탭 메뉴 내용 시작 -->
                    <div id="tab-1" class="tab-content current">
                        <h3>- 기본 정보</h3>
                        <form action="change_pw.php" method="post">
                            <?php 
                            $conn = mysqli_connect("localhost:3306","root","9159348","user");
                            // $query ="SELECT * FROM main_board order by idx desc limit 0,15";
                            $ses_name = $_SESSION['name'];
                            // var_dump($ses_name);
                            $query = "SELECT * FROM user_info WHERE user_name = '$ses_name'";
                            $result = mysqli_query($conn,$query);
                            $row = mysqli_fetch_array($result);
                            // var_dump($row);
                            ?>
                        <table>
                            <caption>기본 정보</caption>
                            <colgroup>
                                <col style = " width:13%">
                            </colgroup>
                            <tbody>
                                <tr>
                                    <td>아이디</td>
                                    <td><?php echo $row['id'] ?></td>
                                </tr>
                                <tr>
                                    <td>이름</td>
                                    <td><?php echo $row['user_name'] ?></td>
                                </tr>
                                <tr>
                                    <td>이메일</td>
                                    <td><?php echo $row['user_email'] ?></td>
                                </tr>
                                <tr>
                                    <td>현재 비밀번호</td>
                                    <td><input type="password" name="current_pw"></td>
                                </tr>
                                <tr>
                                    <td>비밀번호 수정</td>
                                    <td><input type="password" name="change_pw"></td>
                                </tr>
                                <tr>
                                    <td>비밀번호 확인</td>
                                    <td><input type="password" name="check_change_pw"></td>
                                </tr>
                                </form>
                            </tbody>
                        </table>
                        <input type="submit" value="비밀번호수정" id="submit_change_pw">
                        </form>
                    </div>



                    <div id="tab-2" class="tab-content">
                    <?php
                    $conn = mysqli_connect("localhost:3306","root","9159348","user");

                    // $query ="SELECT * FROM main_board order by idx desc limit 0,15";
                    $ses_name = $_SESSION['name'];
                   
                    $query = "SELECT * FROM main_board WHERE writer = '$ses_name' order by idx desc "; 
                    $result = mysqli_query($conn,$query);
                    // var_dump($result);
                    ?>
                        <h3>- 내가 쓴 글 </h3>
                        <table>
                        <caption>내가 쓴 글 리스트</caption>
                        <colgroup>
                            <col style="width:10%">
                            <col style="width:50%">
                            <col style="width:10%">
                            <col style="width:20%">
                            <col style="width:10%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>번호</th>
                                <th>제목</th>
                                <th>작성자</th>
                                <th>작성일</th>
                                <th>조회수</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             $conn = mysqli_connect("localhost:3306","root","9159348","user");
       

                             //페이징 변수
                             if(isset($_GET['page'])){
                                 $page = $_GET['page'];
                             }else{
                                 $page = 1;
                             }
                     
                             $sql= "SELECT * FROM main_board WHERE writer ='$ses_name' order by idx";
                             $result_paging = mysqli_query($conn,$sql);
                             $row_num = mysqli_num_rows($result_paging);//게시판 총 레코드 수
                             $list = 5; //한 페이지에 보여줄 개수
                             $block_ct = 5; //블록당 보여줄 페이지 개수 [1],[2],[3]...
                     
                             $block_num = ceil($page/$block_ct); // 현재 페이지 블록 구하기 1 나누기 6 = 1.2 = 올림해서 2
                             $block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
                             $block_end = $block_start + $block_ct - 1; //블록 마지막 번호
                             $total_page = ceil($row_num / $list); // 페이징한 페이지 수 구하기
                             // var_dump($row_num);
                             //블록 마지막 번호가 페이지 수보다 많을 경우 블록 마지막 번호에는 페이지 수를 설정
                             if($block_end > $total_page) {
                                 $block_end = $total_page;
                             }
                             $total_block = ceil($total_page/$block_ct); //블럭 총 개수
                             $start_num = ($page-1) * $list; //시작번호 (page-1)에서 $list(한페이지에 보여줄 갯수)를 곱한다.
                     
                     
                             //메인_보드안에있는 모든 항목들 중 idx번호에 따라 내림차순으로 15개 출력
                             $query1 ="SELECT * FROM main_board WHERE writer = '$ses_name' order by idx desc limit $start_num,$list"; 
                             $result1 = mysqli_query($conn,$query1);
                            while($total = mysqli_fetch_array($result1)){
                                $idx = $total["idx"];
                                $count = "SELECT COUNT(*) bbs1_no FROM comments WHERE bbs1_no = $idx" ;
                                $counts = mysqli_query($conn,$count);
                                $count_result = mysqli_fetch_array($counts);
                            ?>
                            <tr>
                                <td><?php echo $total["idx"]?></td>
                                <td><a href="read.php?idx=<?php echo $total["idx"];?>"><?php echo $total["title"]?> &nbsp;[<?php echo $count_result[0];?>]</a></td>
                                <td><?php echo $total["writer"]?></td>
                                <td><?php echo $total["date"]?></td>
                                <td><?php echo $total["see"]?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        </table>
                    <!--페이징-->
                <div class="page_num" id="page_num">
                            
                            <ul>
                                <?php
                                 
                                if($page <= 1)
                                { //만약 page가 1보다 크거나 같다면
                                echo "<li class='fo_re'>처음</li>"; //처음이라는 글자에 빨간색 표시 
                                }else{
                                echo "<li><a href='$_SERVER[PHP_SELF]?page=1'>처음</a></li>"; //알니라면 처음글자에 1번페이지로 갈 수있게 링크
                                }
                                if($page <= 1)
                                { //만약 page가 1보다 크거나 같다면 빈값
                                
                                }else{
                                $pre = $page-1; //pre변수에 page-1을 해준다 만약 현재 페이지가 3인데 이전버튼을 누르면 2번페이지로 갈 수 있게 함
                                echo "<li><a href='$_SERVER[PHP_SELF]?page=$pre'>이전</a></li>"; //이전글자에 pre변수를 링크한다. 이러면 이전버튼을 누를때마다 현재 페이지에서 -1하게 된다.
                                }
                                    for($i=$block_start; $i<=$block_end; $i++){ 
                                    //for문 반복문을 사용하여, 초기값을 블록의 시작번호를 조건으로 블록시작번호가 마지박블록보다 작거나 같을 때까지 $i를 반복시킨다
                                    if($page == $i){ //만약 page가 $i와 같다면 
                                        echo "<li class='fo_re'>[$i]</li>"; //현재 페이지에 해당하는 번호에 굵은 빨간색을 적용한다
                                    }else{
                                        echo "<li><a href='$_SERVER[PHP_SELF]?page=$i'>[$i]</a></li>"; //아니라면 $i
                                    }
                                    }
                                if($block_num >= $total_block){ //만약 현재 블록이 블록 총개수보다 크거나 같다면 빈 값
                                }else{
                                $next = $page + 1; //next변수에 page + 1을 해준다.
                                echo "<li><a href='$_SERVER[PHP_SELF]?page=$next'>다음</a></li>"; //다음글자에 next변수를 링크한다. 현재 4페이지에 있다면 +1하여 5페이지로 이동하게 된다.
                                }
                                if($page >= $total_page){ //만약 page가 페이지수보다 크거나 같다면
                                echo "<li class='fo_re'>마지막</li>"; //마지막 글자에 긁은 빨간색을 적용한다.
                                }else{
                                echo "<li><a href='$_SERVER[PHP_SELF]?page=$total_page'>마지막</a></li>"; //아니라면 마지막글자에 total_page를 링크한다.
                                }
                                
                              ?>
                                
                            </ul>
        
                        </div>               
                    </div> <!--탭메뉴 2 내가 작성한 글 끝-->



                    <!--탭메뉴 3 내가 북마크한 비행장소 시작-->
                    <div id="tab-3" class="tab-content">
                        <h3>내가 북마크한 추천 비행지역입니다. </h3>
                    <?php 
                    $ses_names =$_SESSION['name'];
                    $conn = mysqli_connect("localhost:3306","root","9159348","user");
                    $query_all ="SELECT * FROM flyzone LEFT JOIN bookmark ON (bookmark.flyzone_idx = flyzone.idx AND bookmark.who ='$ses_names') WHERE bookmark.who ='$ses_names' order by idx desc limit 0,15";
                    $result_all = mysqli_query($conn,$query_all);
                    ?>                

                    <?php 
                    $ses_names =$_SESSION['name'];
                    $count = "SELECT COUNT(*) FROM bookmark WHERE who ='$ses_names'" ;
                    $counts = mysqli_query($conn,$count);
                    $count_result = mysqli_fetch_array($counts);
                    ?>
                    <p class="count">전체추천 비행장소는 총
                        <b><?php echo $count_result[0];?>
                        </b>곳입니다.</p>
                    <?php 
                    while ($row_all = mysqli_fetch_array($result_all)){
                    ?>
                    <div class="img_area">
                        <div class="img_areas">
                            <img src="uploads/<?php echo $row_all['images'] ?>" alt="섬네일이미지들어갈공간">
                        </div>
                        <div class="text_area">
                            <div class="text_areas">
                            <script>
                                    $(document).ready(function () {

                                        //북마크 추가 클래스뒤에 idxx값 추가했음
                                        $('.bookmark<?php echo $row_all['idx']?>').click(function () {
                                            //북마크에 추가하기 alert("테스트클릭");
                                            $(this).hide();
                                            $(this)
                                                .parent()
                                                .children('.bookmarkon<?php echo $row_all['idx']?>')
                                                .show();
                                            //별 위치를 파악하기 위해
                                            var index = $(this)
                                                .parent()
                                                .parent()
                                                .parent()
                                                .parent()
                                                .index();
                                            var idx = Number(index - 1);
                                            
                                            // var array = new Array(array_index); console.log(array_index);
                                            $.ajax({

                                                url: 'addbookmark.php?idx=<?php echo $row_all['idx']?>', //통신원하는 주소 = 서버로 보낼 주소
                                                type: 'GET', //기본 GET
                                                dataType: 'html',
                                                data: {
                                                    "idx1": <?php echo $row_all['idx'] ?>
                                                },
                                                success: function (data) {
                                                    $('.ex')
                                                        .eq(idx)
                                                        .html(data);
                                                    console.log("ajax test"); // 성공
                                                }

                                            });

                                        });

                                        //북마크 삭제
                                        $('.bookmarkon<?php echo $row_all['idx']?>').click(function () {
                                            //북마크에 추가하기 alert("테스트클릭"); 별 위치를 파악하기 위해
                                            var index = $(this)
                                                .parent()
                                                .parent()
                                                .parent()
                                                .parent()
                                                .index();
                                            var idx = Number(index - 1);
                                            // $(this).hide();
                                            // $(this)
                                            //     .parent()
                                                // .children('.bookmark<?php //echo $row_all['idx']?>')
                                            //     .show();
                                            

                                            //내 페이지에서 별 클릭시 아예 li자체를 지워버리기
                                            $(this).parent().parent().parent().parent().hide();
                                                
                                            // var array = new Array(array_index); console.log(array_index);
                                            $.ajax({

                                                url: 'bookmark_delete.php?idx=<?php echo $row_all['idx']?>', //통신원하는 주소 = 서버로 보낼 주소
                                                type: 'GET', //기본 GET
                                                dataType: 'html',
                                                data: {
                                                    "idx1": <?php echo $row_all['idx'] ?>
                                                },
                                                success: function (data) {
                                                    // $('.ex').eq(idx).html(data);
                                                    console.log("ajax test"); // 성공
                                                }

                                            });

                                        });

                                    });
                                </script>
                                <div class="title"><?php echo $row_all['zone_name'] ?>
                                <?php 
                                        $idx = $row_all['idx'];  
                                        $bookmark_who_all = $row_all['who'];
                                    //    if($row_jeju['flyzone_idx'] == $row_jeju['idx'] && $ses_name1==$bookmark_whs) 
                                        if($row_all['flyzone_idx']== $row_all['idx']&&$_SESSION['name']==$row_all['who']) { ?>
                                        <span class="bookmarkon<?php echo $row_all['idx']; ?>" id="fav"></span>
                                        <span
                                            class="bookmark<?php echo $row_all['idx'] ;?>"
                                            id="no_fav"
                                            hidden="hidden"></span>
                                    <?php } else { ?>
                                        <span
                                            class="bookmarkon<?php echo $row_all['idx']; ?>"
                                            id="fav"
                                            hidden="hidden"></span>
                                        <span class="bookmark<?php echo $row_all['idx'] ;?>" id="no_fav"></span>

                                    <?php } ?>
                                </div>
                                <p class="address">주소 :
                                    <?php echo $row_all['address'] ?></p>
                                <p class="tip">한줄 팁 :
                                    <?php echo $row_all['tip'] ?></p>
                                <p class="date"><?php echo $row_all['time'] ?></p>
                                <div class="info_box">
                                    <div class="links">
                                        <a
                                            href="https://map.kakao.com/?map_type=TYPE_MAP&q=<?php echo $row_all['address'] ?>">지도보기</a>
                                        <!-- <a href="">길찾기</a> -->
                                    </div>
                                   
                                    <?php 
                                    //글쓴이만 수정삭제 버튼 보이도록
                                    $ses_name = $_SESSION['name'];                                    
                                    if($ses_name==$row_all['writer']){ 
                                    ?>
                                    <div class="del_edit">
                                        <a href="flyzone_edit.php?idx=<?php echo $row_all['idx'];?>">수정</a>
                                        <a href="flyzone_delete.php?idx=<?php echo $row_all['idx'];?>">삭제</a>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?> <!--while문 종료-->
                    </div>

                <!-- 탭 메뉴 내용 끝 -->
                </div>
            </div>
        </section>
        
      
 
</body>
</html>