<?php  
session_start();
if(isset ($_SESSION['name'])){
    $sslogin=TRUE;
}
$conn = mysqli_connect("localhost:3306","root","9159348","user");


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
                background: url("/images/droneback6.jpg") no-repeat center center /100% auto;
            }
            .visual1 h2 {
                font-size: 50px;
                color: #fff;
                line-height: 450px;
                text-align: center;
            }
            h3 { font-size: 30px;}


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
            <div class="h2news">
                <h2>커뮤니티</h2>
            </div>
        </section>
        <section class="visual2_community">
        <div class="table_all">
            
        <div id="board_area"> 
        <?php 
        $catagory = $_GET['catgo'];
        
        $search_con = $_GET['search'];
        //url로 확인

        ?>
        <h3>"<?php echo $search_con; ?>" 검색결과 입니다.</h3>


        </div>
        <div class="headlist">
                    <form action="search_result.php" method="$_GET">
                        <select name="catgo" id="search_menu">
                            <option value="title">제목</option>
                            <option value="writer">작성자</option>
                            <option value="content"">내용</option>
                        </select>
                        <div class="searchbox">
                            <input type="text" placeholder="검색" name="search" required="required">
                            <button class="search_button">검색</button>
                        </div>
                    </form>
                </div>
                <div class="go_writepage">
                    <!-- <a href = "writepage.php" class = "move_button">글쓰기</a> -->
                    <a href="writepage.php" class="move_button">글쓰기</a>
                </div>
            <div class="table">
                <table class="main_table">
                <caption>메인게시판</caption>
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
                        //페이징 변수
                        if(isset($_GET['page'])){
                            $page = $_GET['page'];
                        }else{
                            $page = 1;
                        }
                
                        $sql= "SELECT * FROM main_board WHERE $catagory LIKE '%$search_con%' order by idx ";
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




                        $query = "SELECT * FROM main_board WHERE $catagory LIKE '%$search_con%' order by idx desc limit $start_num,$list"; 
                        $result1 = mysqli_query($conn,$query);
                        while($board = mysqli_fetch_array($result1)){
                            $title = $board['title'];

                            $idx = $board["idx"];
                            $count = "SELECT COUNT(*) bbs1_no FROM comments WHERE bbs1_no = $idx" ;
                            $counts = mysqli_query($conn,$count);
                            $count_result = mysqli_fetch_array($counts);

                            // var_dump($board);
                        ?>
                        <tr>
                            <td><?php echo $board["idx"]?></td>
                            <td><a href="read.php?idx=<?php echo $board["idx"];?>"><?php echo $title ?> &nbsp;[<?php echo $count_result[0];?>]</a></td>
                            <td><?php echo $board["writer"]?></td>
                            <td><?php echo $board["date"]?></td>
                            <td><?php echo $board["see"]?></td>
                        </tr>



                        <?php } ?> <!--while문 종료-->
                    </tbody>
                </table>
            </div>




            <div class="page_num" id="page_num">
                            
                            <ul>
                                <?php
                                 
                                if($page <= 1)
                                { //만약 page가 1보다 크거나 같다면
                                echo "<li class='fo_re'>처음</li>"; //처음이라는 글자에 빨간색 표시 
                                }else{
                                echo "<li><a href='$_SERVER[PHP_SELF]?page=1&search=$search_con&catgo=$catagory'>처음</a></li>"; //알니라면 처음글자에 1번페이지로 갈 수있게 링크
                                }
                                if($page <= 1)
                                { //만약 page가 1보다 크거나 같다면 빈값
                                
                                }else{
                                $pre = $page-1; //pre변수에 page-1을 해준다 만약 현재 페이지가 3인데 이전버튼을 누르면 2번페이지로 갈 수 있게 함
                                echo "<li><a href='$_SERVER[PHP_SELF]?page=$pre&search=$search_con&catgo=$catagory'>이전</a></li>"; //이전글자에 pre변수를 링크한다. 이러면 이전버튼을 누를때마다 현재 페이지에서 -1하게 된다.
                                }
                                    for($i=$block_start; $i<=$block_end; $i++){ 
                                    //for문 반복문을 사용하여, 초기값을 블록의 시작번호를 조건으로 블록시작번호가 마지박블록보다 작거나 같을 때까지 $i를 반복시킨다
                                    if($page == $i){ //만약 page가 $i와 같다면 
                                        echo "<li class='fo_re'>[$i]</li>"; //현재 페이지에 해당하는 번호에 굵은 빨간색을 적용한다
                                    }else{
                                        echo "<li><a href='$_SERVER[PHP_SELF]?page=$i&search=$search_con&catgo=$catagory'>[$i]</a></li>"; //아니라면 $i
                                    }
                                    }
                                if($block_num >= $total_block){ //만약 현재 블록이 블록 총개수보다 크거나 같다면 빈 값
                                }else{
                                $next = $page + 1; //next변수에 page + 1을 해준다.
                                echo "<li><a href='$_SERVER[PHP_SELF]?page=$next&search=$search_con&catgo=$catagory'>다음</a></li>"; //다음글자에 next변수를 링크한다. 현재 4페이지에 있다면 +1하여 5페이지로 이동하게 된다.
                                }
                                if($page >= $total_page){ //만약 page가 페이지수보다 크거나 같다면
                                echo "<li class='fo_re'>마지막</li>"; //마지막 글자에 긁은 빨간색을 적용한다.
                                }else{
                                echo "<li><a href='$_SERVER[PHP_SELF]?page=$total_page&search=$search_con&catgo=$catagory'>마지막</a></li>"; //아니라면 마지막글자에 total_page를 링크한다.
                                }
                                
                              ?>
                                
                            </ul>
        
                        </div>



        </div>
        </section>            








    
</body>
</html>