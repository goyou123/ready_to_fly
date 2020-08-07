<?php 

$conn = mysqli_connect("localhost:3306","root","9159348","user");
session_start();
if(isset ($_SESSION['name'])){
    $sslogin=TRUE;
}

//Ajax로 받은 변수
$last_idx = $_GET['idx'];
$start = $_GET['start'];
$list = $_GET['list'];
//  echo "start: "+$start;
//  echo "list: "+$list;
$last_idx1 = $last_idx;
$ses_names =$_SESSION['name'];
$query_all ="SELECT * FROM flyzone LEFT JOIN bookmark ON (bookmark.flyzone_idx = flyzone.idx AND bookmark.who ='$ses_names') order by idx desc limit $start,$list"; //인덱스값 뒤부터 시작, 3개불러왔으니 그 뒤부터 3개 불러오기
$result_all = mysqli_query($conn,$query_all);
// $row_all = mysqli_fetch_array($result_all);
// var_dump($row_all['idx']);
$output .='<h4>search Result</h4>';

while($row_all = mysqli_fetch_array($result_all)){ ?>

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
                                            $(this).hide();
                                            $(this)
                                                .parent()
                                                .children('.bookmark<?php echo $row_all['idx']?>')
                                                .show();
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
                                        if(isset($_SESSION['name'])){
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
                                        <?php } else { ?>
                                        <!--로그인 안됬을때는 별 안보이게-->
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



    
   

<?php } ?>


