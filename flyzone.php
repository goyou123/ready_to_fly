<?php
include_once 'Snoopy.class.php'; 
session_start();
if(isset ($_SESSION['name'])){
    $sslogin=TRUE;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
        <script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>

        <!-- 지도 사용을 위해 인증키 연결 -->
        <script
            language="JavaScript"
            type="text/javascript"
            src="http://map.vworld.kr/js/vworldMapInit.js.do?apiKey=D4D8BEFD-B466-32C1-8D58-98017FA896D9"></script>

        <!--탭메뉴-->

        <!-- vmap API 자바스크립트 -->
        <script type="text/javascript">
            var map = null;
            vworld.showMode = false;
            vworld.init("cont1", "map-first", function () {
                map = this.vmap;
                map.setBaseLayer(map.vworldBaseMap);
                map.setControlsType({"simpleMap": true});
                map.setCenterAndZoom(14135792.751626197, 4512051.278263237, 12);
                map.addVWORLDControl("zoomBar");
                map.addVWORLDControl("indexMap");
                map.setIndexMapPosition("right-bottom");
                map.addMapToolButton("init");
                map.addMapToolButton("zoomin");
                map.addMapToolButton("zoomout");
                map.addMapToolButton("zoominbox");
                map.addMapToolButton("zoomoutbox");
                map.addMapToolButton("pan");
                map.addMapToolButton("prev");
                map.addMapToolButton("next");
                map.addMapToolButton("info");
                map.addMapToolButton("fullext");
                map.addMapToolButton("caldist");
                map.addMapToolButton("calarea");

            }, function (obj) {
                SOPPlugin = obj;
            }, function (msg) {
                alert('oh my god');
            });
            function setModeCallback() {
                vworld.setModeCallback(modecallback);
            }

            function setPanZoomBar() {
                var pZoomBar = null;
                if (map.getControlsByClass("vworld.PanZoomBar")[0] != null) {
                    pZoomBar = map.getControlsByClass("vworld.PanZoomBar")[0];
                } else {
                    pZoomBar = new vworld.PanZoomBar();
                }
                pZoomBar.initialize({
                    zoomStopWidth: 30,
                    zoomStopHeight: 6,
                    sliderEvents: null,
                    zoombarDiv: null,
                    measureDiv: null,
                    measurebuttons: null,
                    divEvents: null,
                    isSimpleBar: false,
                    curPosition: 'right',
                    zoomWorldIcon: null,
                    forceFixedZoomLevel: false,
                    mouseDragStart: null,
                    deltaY: null,
                    zoomStart: null
                });
                pZoomBar.redraw();
            }

            //마커관련
            var markerControl;
            function addMarkingEvent() {
                var pointOptions = {
                    persist: true
                }
                if (markerControl == null) {
                    markerControl = new OpenLayers
                        .Control
                        .Measure(OpenLayers.Handler.Point, {handlerOptions: pointOptions});
                    markerControl
                        .events
                        .on({"measure": mapclick});
                    map.addControl(markerControl);
                }
                map.init();
                markerControl.activate();
            }
            function removeMarkingEvent() {
                map
                    .events
                    .unregister('click', this, mapclick);
            }
            function mapclick(event) {
                map.init();
                var temp = event.geometry;
                var pos = new OpenLayers.LonLat(temp.x, temp.y);
                document
                    .getElementById('mousex')
                    .value = pos.lon;
                document
                    .getElementById('mousey')
                    .value = pos.lat;
                addMarker(pos.lon, pos.lat, "마커 test 입니다.", null);
            }
            function addMarker(lon, lat, message, imgurl) {
                var marker = new vworld.Marker(lon, lat, message, "");
                if (typeof imgurl == 'string') {
                    marker.setIconImage(imgurl);
                }
                marker.setZindex(3);
                map.addMarker(marker);
                testMarker = marker;
            }
            function clearMarkers() {
                map.clearMarkers();
            }

            //산사태로 예시, 레이어버튼 추가 함수
            function addThemeLayer(title, layer) {
                map.showThemeLayer(title, {layers: layer});
            }
            function addTileCache() {
                map.showTileCacheLayer('산사태위험지도', 'SANSATAI', {
                    min: 9,
                    max: 15
                });

            }
            function setTestProxy() {
                alert(OpenLayers.ProxyHost);
            }
        </script>

        <!-- 비행금지/제한구역 버튼 클릭시 설명 나오는 스크립트 -->
        <script>
            //비행금지구역 버튼 클릭시 금지구역에 대한 설명
            $(document).ready(function () {
                $('.nofly_zone').click(function () {
                    $(this)
                        .parent()
                        .parent()
                        .children('.zone_info')
                        .show();
                    $(this)
                        .parent()
                        .parent()
                        .children('.zone_info2')
                        .hide();
                });
                $('.dangerfly_zone').click(function () {
                    $(this)
                        .parent()
                        .parent()
                        .children('.zone_info2')
                        .show();
                    $(this)
                        .parent()
                        .parent()
                        .children('.zone_info')
                        .hide();
                });
                // nofly_zone dangerfly_zone
            });
        </script>


        <!-- 무한스크롤 -->
        <script>
            var idx = $("#tab-1 .img_area").last().index(); //마지막 인덱스 / 사용X
            var isEND = false;
            $(function(){
                $(window).scroll(function(){
                let $window = $(this);
                let scrollTop = $window.scrollTop();
                let windowHeight = $window.height();
                let documentHeight = $(document).height();
                // append_list();
                console.log("documentHeight:" + documentHeight + " | scrollTop:" + scrollTop + " | windowHeight: " + windowHeight );
                
                // scrollbar의 thumb가 바닥 전 30px까지 도달 하면 리스트를 가져온다.
                if( scrollTop + windowHeight +50 > documentHeight ){
                    console.log("실행");
                    
                    //Ajax 코드가 있는 함수
                    append_list();

                    } //if문
                })           
            }) //끝

            var start =3; //3째까지 보여주고
            var list =2; //불러올 리스트 갯수

            function append_list(){
            $.ajax({
                // url:"infi_scroll_ok.php",
                url:"infi_scroll_ok.php?idx=" + idx ,
                type: "GET",
                data: {start:start,list:list},
                dataType: "html",
                success: function(result){
                  
                    $('#tab-1').append(result);
                    start += list; //리스트를 계속 불러옴

                    //로딩 이미지 추가 시도 - 실패
                    //https://blog.naver.com/jpwshort2/220285035856
                //     $('#loading').append("<img src ='/images/loading.gif' alt='loading'>");
                //     setTimeout(function(e){

                //     $('#tab-1').append(result);
                //     // start += list; //리스트를 계속 불러옴

                //     $('#loading').remove();
                //     },100);
                //     start += list; //리스트를 계속 불러옴
                    }       
                });
            }

        </script>

<!--맨 위로 가기 버튼 스크립트-->
        <script>
        $( document ).ready( function() {
            $( window ).scroll( function() {
            if ( $(this).scrollTop() > 1000 ) {
                $( '.top' ).fadeIn();
            } else {
                $( '.top' ).fadeOut();
            }
            } );
            $( '.top' ).click( function() {
            $( 'html, body' ).animate( { scrollTop : 0 }, 400 );
                return false;
                } );
            } );
        </script>
        <style>
            .top { position: fixed; bottom:5%; right: 5%; display: none; width: 80px; height: 80px ; background-color: #fbb036; color: #fff; text-align: center; line-height: 80px; border-radius: 100%; font-size: 18px;  z-index: 11;}
        </style>

        <link rel="stylesheet" href="css/default.css">
        <link rel="stylesheet" href="css/style.css">
        <style>
            /* 맵 API에서 기본으로 적용되는 css가 있어서 그걸 초기화해줌 */
            a:active,
            header a:visited {
                color: #fff;
            }
            a:active,
            header .loginandsignup a:visited {
                color: #444;
            }
            div#OpenLayers_Control_Attribution_24 img {
                display: none;
            }
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
                background: url("/images/droneback7.jpg") no-repeat bottom center /100% auto;
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
                    <a href="index.php" style="text-decoration: none;">Ready To Fly</a>
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
                <h2>비행금지구역</h2>
            </div>
        </section>
        <!-- 여기서부턴 style.css에 있음 -->
        <section class="visual2_map">
            <h2>지도</h2>

            <div id="cont1" class="cont1"></div>
            <!-- <button type="button" onclick="javascript:vworld.setMode(0);" name="mode0"
            >2D배경지도</button> <button type="button" onclick="javascript:vworld.setMode(1);"
            name="mode1" >2D항공사진</button> -->
            <br>
            <!-- <div class="marker"> <button type="button"
            onclick="javascript:addMarkingEvent();" name="addpin" >마커찍기</button> <button
            type="button" onclick="javascript:testMarker.hide();" name="addpin"
            >마커숨기기</button> <button type="button" onclick="javascript:testMarker.show();"
            name="addpin" >마커나타내기</button> <button type="button" onclick="clearMarkers()"
            >전체 마커 삭제</button> 마우스클릭(구글좌표): <input type="text" name='q' id='mousex'
            value="0" maxlength="20" style="ime-mode:active"/> <input type="text" name='q'
            id='mousey' value="0" maxlength="20" style="ime-mode:active"/> </div> -->
            <div class="droneflyzone">
                <!-- <button type="button"
                onclick="javascript:addThemeLayer('지적도','LP_PA_CBND_BUBUN,LP_PA_CBND_BONBUN');"
                name="addcache" >지적도On/Off </button>-->
                <!-- <button type="button" onclick="javascript:addTileCache();" name="addcache">
                산사태위험지도 On/Off </button> -->
                <button
                    type="button"
                    onclick="javascript:addThemeLayer('비행금지','LT_C_AISPRHC');"
                    name="addcache"
                    class="nofly_zone">비행금지구역 표시 On/Off</button>
                <button
                    type="button"
                    onclick="javascript:addThemeLayer('비행제한','LT_C_AISRESC');"
                    name="addcache"
                    class="dangerfly_zone">비행제한구역 표시 On/Off</button>
            </div>
            <div class="zone_info">
                <p>-
                    <strong>비행금지구역</strong>은 항공법에 의해 법적으로 비행이 금지된 구역으로, 휴전선 인근이나 서울, 원전, 관제탑 주변이 포함됩니다.<br>
                    - 이 구역에서 승인없이 비행할 경우
                    <u>
                        항공법 제161조(초경량비행장치 불법 사용 등의 죄) 6항</u>에 의거
                    <b>200만원 이하의 과태료</b>가 부과될 수 있습니다.
                </p>
            </div>
            <div class="zone_info2">
                <p>-
                    <strong>비행제한구역은
                    </strong>항공기의 비행에 관하여 위험이 발생할 염려가 있는 구역으로, 그 상공에서의 항공기 비행을 일정 조건하에 금지시킨 구역입니다.<br>
                    - 고도 150m 미만, 시계거리 내에서는 허가없이 비행 가능합니다.
                    <u>단, 서울의 비행제한구역은 무조건 비행승인이 필요합니다.</u>
                </p>
            </div>

            <div class="warning_info">
                <b class="winfo">위 구역 외에도 아래 사항에 포함되는 지역에서는 드론을 날릴 수 없습니다.</b>

                <p>- 모든지역 150m 이상의 고도</p>
                <p>- 모든지역 인구밀집지역 또는 사람이 많이 모인 곳</p>
                <p>- 모든지역 육안에서 벗어나는 비행</p>
                <p>- 야간비행 금지 (일몰 후 ~ 일출 전까지)</p>

            </div>

        </section>

        <!-- 탭 메뉴 스크립트 -->
        <script>
            $(document).ready(function () {

                $('ul.tabs li').click(function () {
                    //선택자를 통해 tabs 메뉴를 클릭 이벤트를 지정해줍니다.
                    var tab_id = $(this).attr('data-tab');

                    //선택 되있던 탭의 current css를 제거하고
                    $('ul.tabs li').removeClass('current');
                    $('.zone_li').removeClass('current');

                    $(this).addClass('current'); ////선택된 탭에 current class를 삽입해줍니다.
                    $("#" + tab_id).addClass('current');
                })

            });
        </script>


    
        <?php 
        $ses_names =$_SESSION['name'];
        //지역별 쿼리문 생성
        $conn = mysqli_connect("localhost:3306","root","9159348","user");
        $query_basic ="SELECT * FROM flyzone LEFT JOIN bookmark ON (bookmark.flyzone_idx = flyzone.idx AND bookmark.who ='$ses_names') order by idx desc;";
        $query_all ="SELECT * FROM flyzone LEFT JOIN bookmark ON (bookmark.flyzone_idx = flyzone.idx AND bookmark.who ='$ses_names') order by idx desc limit 0,3";
        $query_seoul = "SELECT * FROM flyzone LEFT JOIN bookmark ON (bookmark.flyzone_idx = flyzone.idx AND bookmark.who ='$ses_names') WHERE area = '서울/경기' order by idx desc limit 0,15";
        $query_gangwon ="SELECT * FROM flyzone LEFT JOIN bookmark ON (bookmark.flyzone_idx = flyzone.idx AND bookmark.who ='$ses_names') WHERE area = '강원' order by idx desc limit 0,15";
        $query_chungcheong = "SELECT * FROM flyzone LEFT JOIN bookmark ON (bookmark.flyzone_idx = flyzone.idx AND bookmark.who ='$ses_names') WHERE area = '충청' order by idx desc limit 0,15";
        $query_gyeongsang = "SELECT * FROM flyzone LEFT JOIN bookmark ON (bookmark.flyzone_idx = flyzone.idx AND bookmark.who ='$ses_names') WHERE area = '경상' order by idx desc limit 0,15";
        $query_jeolla ="SELECT * FROM flyzone LEFT JOIN bookmark ON (bookmark.flyzone_idx = flyzone.idx AND bookmark.who ='$ses_names') WHERE area = '전라' order by idx desc limit 0,15";
        // $query_jeju = "SELECT * FROM flyzone LEFT JOIN bookmark ON bookmark.flyzone_idx = flyzone.idx WHERE area = '제주' order by idx desc limit 0,15" ; // 고은찬이랑 김이름이랑 같이 북마크한 글이 2개가 나와버림 
        //쿼리문 ON과 WHERE 의 차이점 공부
        $query_jeju = "SELECT * FROM flyzone LEFT JOIN bookmark ON (bookmark.flyzone_idx = flyzone.idx AND bookmark.who ='$ses_names') WHERE area = '제주' order by idx desc limit 0,15"; //내 이름 + isNUll을 사용하면 상대방이 고은찬이 북마크한 글을 못가져옴!!!!!!!!! 이거임!!!!!!!!!!!!
        // SELECT * FROM flyzone LEFT JOIN bookmark ON bookmark.flyzone_idx = flyzone.idx WHERE area = '제주' order by idx desc limit 0,15;

        // "SELECT * FROM flyzone LEFT JOIN bookmark ON bookmark.flyzone_idx = flyzone.idx WHERE area = '제주' order by idx desc limit 0,15";
        // "SELECT * FROM flyzone LEFT JOIN bookmark ON bookmark.flyzone_idx = flyzone.idx WHERE bookmark.who ='$ses_name1'" ;
        // $query = "SELECT * FROM main_board WHERE writer = '$ses_name'order by idx desc limit 0,15";
        $result_basic = mysqli_query($conn,$query_all);
        $result_all = mysqli_query($conn,$query_all);
        $result_seoul = mysqli_query($conn,$query_seoul);
        $result_gangwon = mysqli_query($conn,$query_gangwon);
        $result_chungcheong = mysqli_query($conn,$query_chungcheong);
        $result_gyeongsang = mysqli_query($conn,$query_gyeongsang);
        $result_jeolla = mysqli_query($conn,$query_jeolla);
        $result_jeju = mysqli_query($conn,$query_jeju);
        
        

        // $row_all = mysqli_fetch_array($result_all);
        // $row_jeju = mysqli_fetch_array($result_jeju);
        // var_dump($row_all['images']);
        
        ?>

        <!-- 비행장소추천 -->
        <section class="visual3_recommend_flyzone">
            <!-- <img src="uploads/<?php echo $row_all['images'] ?>" alt=""> -->
            <h2 hidden="hidden">비행장소추천</h2>
            <a href="#a" class="top" style=" width: 80px; height: 80px ; background-color: #fbb036; color: #fff; text-align: center; line-height: 80px; border-radius: 100%; font-size: 18px;">맨 위로</a>
            <div class="zone_all">
                <div class="zone_intro">
                    <h3>지역별 비행추천장소</h3>
                    <p>나만의 드론비행장소를 추천해주세요!</p>
                    <a href="add_flyzone.php">추천하기→</a>
                </div>
                <div class="zone_lists">
                    <ul class="tabs">
                        <li class="tab-link current" data-tab="tab-1">전체</li>
                        <li class="tab-link" data-tab="tab-2">서울/경기</li>
                        <li class="tab-link" data-tab="tab-3">강원</li>
                        <li class="tab-link" data-tab="tab-4">충청</li>
                        <li class="tab-link" data-tab="tab-5">경상</li>
                        <li class="tab-link" data-tab="tab-6">전라</li>
                        <li class="tab-link" data-tab="tab-7">제주</li>

                    </ul>
                </div>
                <div class="zone_li current" id="tab-1">
                    <!-- 전체----------------------------------------------------- -->
                    <?php 
                    $count = "SELECT COUNT(*) area FROM flyzone" ;
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
                    <?php } ?> <!--while문 종료-->
                    <!--로딩추가-->
                    <div id="loading" class="loading"></div>
                    <style>
                        #loading { width: 100%; text-align: center; float: left;}
                        #loading img { float: none; width: 40px;}
                    </style>
                </div> <!--tab-1닫기-->
                <div class="zone_li" id="tab-2">
                    
                    <!-- 서울/경기--------------------------------------------------------------------- -->
                    <?php 
                    $count = "SELECT COUNT(*) area FROM flyzone WHERE area = '서울/경기'" ;
                    $counts = mysqli_query($conn,$count);
                    $count_result = mysqli_fetch_array($counts);
                    ?>
                    <p class="count">서울/경기의 비행장소는 총
                        <b><?php echo $count_result[0];?>
                        </b>곳입니다.</p>
                    <?php 
                    while ($row_seoul = mysqli_fetch_array($result_seoul)){
                    ?>
                    <div class="img_area">
                        <div class="img_areas">
                            <img src="uploads/<?php echo $row_seoul['images'] ?>" alt="섬네일이미지들어갈공간">
                        </div>
                        <div class="text_area">
                            <div class="text_areas">
                            <script>
                                    $(document).ready(function () {

                                        //북마크 추가 클래스뒤에 idxx값 추가했음
                                        $('.bookmark<?php echo $row_seoul['idx']?>').click(function () {
                                            //북마크에 추가하기 alert("테스트클릭");
                                            $(this).hide();
                                            $(this)
                                                .parent()
                                                .children('.bookmarkon<?php echo $row_seoul['idx']?>')
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

                                                url: 'addbookmark.php?idx=<?php echo $row_seoul['idx']?>', //통신원하는 주소 = 서버로 보낼 주소
                                                type: 'GET', //기본 GET
                                                dataType: 'html',
                                                data: {
                                                    "idx1": <?php echo $row_seoul['idx'] ?>
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
                                        $('.bookmarkon<?php echo $row_seoul['idx']?>').click(function () {
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
                                                .children('.bookmark<?php echo $row_seoul['idx']?>')
                                                .show();
                                            // var array = new Array(array_index); console.log(array_index);
                                            $.ajax({

                                                url: 'bookmark_delete.php?idx=<?php echo $row_seoul['idx']?>', //통신원하는 주소 = 서버로 보낼 주소
                                                type: 'GET', //기본 GET
                                                dataType: 'html',
                                                data: {
                                                    "idx1": <?php echo $row_seoul['idx'] ?>
                                                },
                                                success: function (data) {
                                                    // $('.ex').eq(idx).html(data);
                                                    console.log("ajax test"); // 성공
                                                }

                                            });

                                        });

                                    });
                                </script>
                                <div class="title"><?php echo $row_seoul['zone_name'] ?>
                                <?php 
                                    if(isset($_SESSION['name'])){
                                        $idx = $row_seoul['idx'];  

                                        if($row_seoul['flyzone_idx']== $row_seoul['idx']&&$_SESSION['name']==$row_seoul['who']) { ?>
                                        <span class="bookmarkon<?php echo $row_seoul['idx']; ?>" id="fav"></span>
                                        <span
                                            class="bookmark<?php echo $row_seoul['idx'] ;?>"
                                            id="no_fav"
                                            hidden="hidden"></span>
                                        <?php } else { ?>
                                        <span
                                            class="bookmarkon<?php echo $row_seoul['idx']; ?>"
                                            id="fav"
                                            hidden="hidden"></span>
                                        <span class="bookmark<?php echo $row_seoul['idx'] ;?>" id="no_fav"></span>

                                        <?php } ?>
                                    <?php } else { ?>
                                        <!--로그인 안됬을때는 별 안보이게-->
                                        <?php } ?>
                                </div>
                                <p class="address">주소 :
                                    <?php echo $row_seoul['address'] ?></p>
                                <p class="tip">한줄 팁 :
                                    <?php echo $row_seoul['tip'] ?></p>
                                <p class="date"><?php echo $row_seoul['time'] ?></p>
                                <div class="info_box">
                                    <div class="links">
                                        <a
                                            href="https://map.kakao.com/?map_type=TYPE_MAP&q=<?php echo $row_seoul['address'] ?>">지도보기</a>
                                        <!-- <a href="">길찾기</a> -->
                                    </div>
                                   
                                    <?php 
                                    //글쓴이만 수정삭제 버튼 보이도록
                                    $ses_name = $_SESSION['name'];                                    
                                    if($ses_name==$row_seoul['writer']){ 
                                    ?>
                                    <div class="del_edit">
                                        <a href="flyzone_edit.php?idx=<?php echo $row_seoul['idx'];?>">수정</a>
                                        <a href="flyzone_delete.php?idx=<?php echo $row_seoul['idx'];?>">삭제</a>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                                  
                    <?php } ?> <!--while문 종료-->
                    <!--while문종료 , 서울경기끝-->
                </div>
                <div class="zone_li" id="tab-3">
                    <!-- 강원--------------------------------------------------------------------- -->
                    <?php 
                    $count = "SELECT COUNT(*) area FROM flyzone WHERE area = '강원'" ;
                    $counts = mysqli_query($conn,$count);
                    $count_result = mysqli_fetch_array($counts);
                    ?>
                    <p class="count">강원도의 비행장소는 총
                        <b><?php echo $count_result[0];?>
                        </b>곳입니다.</p>
                    <?php 
                    while ($row_gangwon = mysqli_fetch_array($result_gangwon)){
                    ?>
                    <div class="img_area">
                        <div class="img_areas">
                            <img src="uploads/<?php echo $row_gangwon['images'] ?>" alt="섬네일이미지들어갈공간">
                        </div>
                        <div class="text_area">
                            <div class="text_areas">
                            <script>
                                    $(document).ready(function () {

                                        //북마크 추가 클래스뒤에 idxx값 추가했음
                                        $('.bookmark<?php echo $row_gangwon['idx']?>').click(function () {
                                            //북마크에 추가하기 alert("테스트클릭");
                                            $(this).hide();
                                            $(this)
                                                .parent()
                                                .children('.bookmarkon<?php echo $row_gangwon['idx']?>')
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

                                                url: 'addbookmark.php?idx=<?php echo $row_gangwon['idx']?>', //통신원하는 주소 = 서버로 보낼 주소
                                                type: 'GET', //기본 GET
                                                dataType: 'html',
                                                data: {
                                                    "idx1": <?php echo $row_gangwon['idx'] ?>
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
                                        $('.bookmarkon<?php echo $row_gangwon['idx']?>').click(function () {
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
                                                .children('.bookmark<?php echo $row_gangwon['idx']?>')
                                                .show();
                                            // var array = new Array(array_index); console.log(array_index);
                                            $.ajax({

                                                url: 'bookmark_delete.php?idx=<?php echo $row_gangwon['idx']?>', //통신원하는 주소 = 서버로 보낼 주소
                                                type: 'GET', //기본 GET
                                                dataType: 'html',
                                                data: {
                                                    "idx1": <?php echo $row_gangwon['idx'] ?>
                                                },
                                                success: function (data) {
                                                    // $('.ex').eq(idx).html(data);
                                                    console.log("ajax test"); // 성공
                                                }

                                            });

                                        });

                                    });
                                </script>
                                <div class="title"><?php echo $row_gangwon['zone_name'] ?>
                                <?php
                                    if(isset($_SESSION['name'])){
                                        $idx = $row_gangwon['idx'];  

                                        if($row_gangwon['flyzone_idx']== $row_gangwon['idx']&&$_SESSION['name']==$row_gangwon['who']) { ?>
                                        <span class="bookmarkon<?php echo $row_gangwon['idx']; ?>" id="fav"></span>
                                        <span
                                            class="bookmark<?php echo $row_gangwon['idx'] ;?>"
                                            id="no_fav"
                                            hidden="hidden"></span>
                                        <?php } else { ?>
                                        <span
                                            class="bookmarkon<?php echo $row_gangwon['idx']; ?>"
                                            id="fav"
                                            hidden="hidden"></span>
                                        <span class="bookmark<?php echo $row_gangwon['idx'] ;?>" id="no_fav"></span>

                                        <?php } ?>

                                    <?php } else { ?>
                                        <!--로그인 안됬을때는 별 안보이게-->
                                        <?php } ?>
                                </div>
                                <p class="address">주소 :
                                    <?php echo $row_gangwon['address'] ?></p>
                                <p class="tip">한줄 팁 :
                                    <?php echo $row_gangwon['tip'] ?></p>
                                <p class="date"><?php echo $row_gangwon['time'] ?></p>
                                <div class="info_box">
                                    <div class="links">
                                        <a
                                            href="https://map.kakao.com/?map_type=TYPE_MAP&q=<?php echo $row_gangwon['address'] ?>">지도보기</a>
                                        <!-- <a href="">길찾기</a> -->
                                    </div>
                                   
                                    <?php 
                                    //글쓴이만 수정삭제 버튼 보이도록
                                    $ses_name = $_SESSION['name'];                                    
                                    if($ses_name==$row_gangwon['writer']){ 
                                    ?>
                                    <div class="del_edit">
                                        <a href="flyzone_edit.php?idx=<?php echo $row_gangwon['idx'];?>">수정</a>
                                        <a href="flyzone_delete.php?idx=<?php echo $row_gangwon['idx'];?>">삭제</a>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                                  
                    <?php } ?> <!--while문 종료-->
                    <!--while문종료 , 강원끝-->
                </div>
                <div class="zone_li" id="tab-4">
                    <!-- 충청--------------------------------------------------------------------- -->
                    <?php 
                    $count = "SELECT COUNT(*) area FROM flyzone WHERE area = '충청'" ;
                    $counts = mysqli_query($conn,$count);
                    $count_result = mysqli_fetch_array($counts);
                    ?>
                    <p class="count">충청도의 비행장소는 총
                        <b><?php echo $count_result[0];?>
                        </b>곳입니다.</p>
                    <?php 
                    while ($row_chungcheong = mysqli_fetch_array($result_chungcheong)){
                    ?>
                    <div class="img_area">
                        <div class="img_areas">
                            <img src="uploads/<?php echo $row_chungcheong['images'] ?>" alt="섬네일이미지들어갈공간">
                        </div>
                        <div class="text_area">
                            <div class="text_areas">
                            <script>
                                    $(document).ready(function () {

                                        //북마크 추가 클래스뒤에 idxx값 추가했음
                                        $('.bookmark<?php echo $row_chungcheong['idx']?>').click(function () {
                                            //북마크에 추가하기 alert("테스트클릭");
                                            $(this).hide();
                                            $(this)
                                                .parent()
                                                .children('.bookmarkon<?php echo $row_chungcheong['idx']?>')
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

                                                url: 'addbookmark.php?idx=<?php echo $row_chungcheong['idx']?>', //통신원하는 주소 = 서버로 보낼 주소
                                                type: 'GET', //기본 GET
                                                dataType: 'html',
                                                data: {
                                                    "idx1": <?php echo $row_chungcheong['idx'] ?>
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
                                        $('.bookmarkon<?php echo $row_chungcheong['idx']?>').click(function () {
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
                                                .children('.bookmark<?php echo $row_chungcheong['idx']?>')
                                                .show();
                                            // var array = new Array(array_index); console.log(array_index);
                                            $.ajax({

                                                url: 'bookmark_delete.php?idx=<?php echo $row_chungcheong['idx']?>', //통신원하는 주소 = 서버로 보낼 주소
                                                type: 'GET', //기본 GET
                                                dataType: 'html',
                                                data: {
                                                    "idx1": <?php echo $row_chungcheong['idx'] ?>
                                                },
                                                success: function (data) {
                                                    // $('.ex').eq(idx).html(data);
                                                    console.log("ajax test"); // 성공
                                                }

                                            });

                                        });

                                    });
                                </script>
                                <div class="title"><?php echo $row_chungcheong['zone_name'] ?>
                                <?php
                                    if(isset($_SESSION['name'])){ 
                                        $idx = $row_chungcheong['idx'];  
                                       
                                        if($row_chungcheong['flyzone_idx']== $row_chungcheong['idx']&&$_SESSION['name']==$row_chungcheong['who']) { ?>
                                        <span class="bookmarkon<?php echo $row_chungcheong['idx']; ?>" id="fav"></span>
                                        <span
                                            class="bookmark<?php echo $row_chungcheong['idx'] ;?>"
                                            id="no_fav"
                                            hidden="hidden"></span>
                                        <?php } else { ?>
                                        <span
                                            class="bookmarkon<?php echo $row_chungcheong['idx']; ?>"
                                            id="fav"
                                            hidden="hidden"></span>
                                        <span class="bookmark<?php echo $row_chungcheong['idx'] ;?>" id="no_fav"></span>

                                        <?php } ?>
                                    <?php } else { ?>
                                        <!--로그인 안됬을때는 별 안보이게-->
                                    <?php } ?>
                                </div>
                                <p class="address">주소 :
                                    <?php echo $row_chungcheong['address'] ?></p>
                                <p class="tip">한줄 팁 :
                                    <?php echo $row_chungcheong['tip'] ?></p>
                                <p class="date"><?php echo $row_chungcheong['time'] ?></p>
                                <div class="info_box">
                                    <div class="links">
                                        <a
                                            href="https://map.kakao.com/?map_type=TYPE_MAP&q=<?php echo $row_chungcheong['address'] ?>">지도보기</a>
                                        <!-- <a href="">길찾기</a> -->
                                    </div>
                                   
                                    <?php 
                                    //글쓴이만 수정삭제 버튼 보이도록
                                    $ses_name = $_SESSION['name'];                                    
                                    if($ses_name==$row_chungcheong['writer']){ 
                                    ?>
                                    <div class="del_edit">
                                        <a href="flyzone_edit.php?idx=<?php echo $row_chungcheong['idx'];?>">수정</a>
                                        <a href="flyzone_delete.php?idx=<?php echo $row_chungcheong['idx'];?>">삭제</a>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                                  
                    <?php } ?> <!--while문 종료-->
                     <!--while문종료 , 충청끝-->
                </div>
                <div class="zone_li" id="tab-5">
                    <!-- 경상--------------------------------------------------------------------- -->
                    <?php 
                    $count = "SELECT COUNT(*) area FROM flyzone WHERE area = '경상'" ;
                    $counts = mysqli_query($conn,$count);
                    $count_result = mysqli_fetch_array($counts);
                    ?>
                    <p class="count">경상도의 비행장소는 총
                        <b><?php echo $count_result[0];?>
                        </b>곳입니다.</p>
                    <?php 
                    while ($row_gyeongsang = mysqli_fetch_array($result_gyeongsang)){
                    ?>
                    <div class="img_area">
                        <div class="img_areas">
                            <img src="uploads/<?php echo $row_gyeongsang['images'] ?>" alt="섬네일이미지들어갈공간">
                        </div>
                        <div class="text_area">
                            <div class="text_areas">
                            <script>
                                    $(document).ready(function () {

                                        //북마크 추가 클래스뒤에 idxx값 추가했음
                                        $('.bookmark<?php echo $row_gyeongsang['idx']?>').click(function () {
                                            //북마크에 추가하기 alert("테스트클릭");
                                            $(this).hide();
                                            $(this)
                                                .parent()
                                                .children('.bookmarkon<?php echo $row_gyeongsang['idx']?>')
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

                                                url: 'addbookmark.php?idx=<?php echo $row_gyeongsang['idx']?>', //통신원하는 주소 = 서버로 보낼 주소
                                                type: 'GET', //기본 GET
                                                dataType: 'html',
                                                data: {
                                                    "idx1": <?php echo $row_gyeongsang['idx'] ?>
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
                                        $('.bookmarkon<?php echo $row_gyeongsang['idx']?>').click(function () {
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
                                                .children('.bookmark<?php echo $row_gyeongsang['idx']?>')
                                                .show();
                                            // var array = new Array(array_index); console.log(array_index);
                                            $.ajax({

                                                url: 'bookmark_delete.php?idx=<?php echo $row_gyeongsang['idx']?>', //통신원하는 주소 = 서버로 보낼 주소
                                                type: 'GET', //기본 GET
                                                dataType: 'html',
                                                data: {
                                                    "idx1": <?php echo $row_gyeongsang['idx'] ?>
                                                },
                                                success: function (data) {
                                                    // $('.ex').eq(idx).html(data);
                                                    console.log("ajax test"); // 성공
                                                }

                                            });

                                        });

                                    });
                                </script>
                                <div class="title"><?php echo $row_gyeongsang['zone_name'] ?>
                                <?php
                                    if(isset($_SESSION['name'])){  
                                        $idx = $row_gyeongsang['idx'];  
                                       
                                        if($row_gyeongsang['flyzone_idx']== $row_gyeongsang['idx']&&$_SESSION['name']==$row_gyeongsang['who']) { ?>
                                        <span class="bookmarkon<?php echo $row_gyeongsang['idx']; ?>" id="fav"></span>
                                        <span
                                            class="bookmark<?php echo $row_gyeongsang['idx'] ;?>"
                                            id="no_fav"
                                            hidden="hidden"></span>
                                        <?php } else { ?>
                                        <span
                                            class="bookmarkon<?php echo $row_gyeongsang['idx']; ?>"
                                            id="fav"
                                            hidden="hidden"></span>
                                        <span class="bookmark<?php echo $row_gyeongsang['idx'] ;?>" id="no_fav"></span>

                                        <?php } ?>
                                    <?php } else { ?>
                                        <!--로그인 안됬을때는 별 안보이게-->
                                    <?php } ?>
                                </div>
                                <p class="address">주소 :
                                    <?php echo $row_gyeongsang['address'] ?></p>
                                <p class="tip">한줄 팁 :
                                    <?php echo $row_gyeongsang['tip'] ?></p>
                                <p class="date"><?php echo $row_gyeongsang['time'] ?></p>
                                <div class="info_box">
                                    <div class="links">
                                        <a
                                            href="https://map.kakao.com/?map_type=TYPE_MAP&q=<?php echo $row_gyeongsang['address'] ?>">지도보기</a>
                                        <!-- <a href="">길찾기</a> -->
                                    </div>
                                   
                                    <?php 
                                    //글쓴이만 수정삭제 버튼 보이도록
                                    $ses_name = $_SESSION['name'];                                    
                                    if($ses_name==$row_gyeongsang['writer']){ 
                                    ?>
                                    <div class="del_edit">
                                        <a href="flyzone_edit.php?idx=<?php echo $row_gyeongsang['idx'];?>">수정</a>
                                        <a href="flyzone_delete.php?idx=<?php echo $row_gyeongsang['idx'];?>">삭제</a>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                                  
                    <?php } ?> <!--while문 종료-->
                     <!--while문종료 , 경상끝-->
                </div>
                <div class="zone_li" id="tab-6">
                    <!-- 전라--------------------------------------------------------------------- -->
                    <?php 
                    $count = "SELECT COUNT(*) area FROM flyzone WHERE area = '전라'" ;
                    $counts = mysqli_query($conn,$count);
                    $count_result = mysqli_fetch_array($counts);
                    ?>
                    <p class="count">전라도의 비행장소는 총
                        <b><?php echo $count_result[0];?>
                        </b>곳입니다.</p>
                    <?php 
                    while ($row_jeolla = mysqli_fetch_array($result_jeolla)){
                    ?>
                    <div class="img_area">
                        <div class="img_areas">
                            <img src="uploads/<?php echo $row_jeolla['images'] ?>" alt="섬네일이미지들어갈공간">
                        </div>
                        <div class="text_area">
                            <div class="text_areas">
                            <!--스크립트 들어감-->
                                
                                <div class="title"><?php echo $row_jeolla['zone_name'] ?>
                                <?php
                                    if(isset($_SESSION['name'])){   
                                        $idx = $row_jeolla['idx'];  
                                       
                                        if($row_jeolla['flyzone_idx']== $row_jeolla['idx']&&$_SESSION['name']==$row_jeolla['who']) { ?>
                                        <span class="bookmarkon<?php echo $row_jeolla['idx']; ?>" id="fav"></span>
                                        <span
                                            class="bookmark<?php echo $row_jeolla['idx'] ;?>"
                                            id="no_fav"
                                            hidden="hidden"></span>
                                        <?php } else { ?>
                                        <span
                                            class="bookmarkon<?php echo $row_jeolla['idx']; ?>"
                                            id="fav"
                                            hidden="hidden"></span>
                                        <span class="bookmark<?php echo $row_jeolla['idx'] ;?>" id="no_fav"></span>

                                        <?php } ?>
                                    <?php } else { ?>
                                        <!--로그인 안됬을때는 별 안보이게-->
                                    <?php } ?>
                                </div>
                                <p class="address">주소 :
                                    <?php echo $row_jeolla['address'] ?></p>
                                <p class="tip">한줄 팁 :
                                    <?php echo $row_jeolla['tip'] ?></p>
                                <p class="date"><?php echo $row_jeolla['time'] ?></p>
                                <div class="info_box">
                                    <div class="links">
                                        <a
                                            href="https://map.kakao.com/?map_type=TYPE_MAP&q=<?php echo $row_jeolla['address'] ?>">지도보기</a>
                                        <!-- <a href="">길찾기</a> -->
                                    </div>
                                   
                                    <?php 
                                    //글쓴이만 수정삭제 버튼 보이도록
                                    $ses_name = $_SESSION['name'];                                    
                                    if($ses_name==$row_jeolla['writer']){ 
                                    ?>
                                    <div class="del_edit">
                                        <a href="flyzone_edit.php?idx=<?php echo $row_jeolla['idx'];?>">수정</a>
                                        <a href="flyzone_delete.php?idx=<?php echo $row_jeolla['idx'];?>">삭제</a>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                                  
                    <?php } ?> <!--while문 종료-->
                     <!--while문종료 , 전라끝-->
                </div>
                <div class="zone_li" id="tab-7">
                    <!-- 제주--------------------------------------------------------------------- -->
                    <?php 
                    $count = "SELECT COUNT(*) area FROM flyzone WHERE area = '제주'" ;
                    $counts = mysqli_query($conn,$count);
                    $count_result = mysqli_fetch_array($counts);
                    ?>
                    <p class="count">제주도의 추천 비행장소는 총
                        <b><?php echo $count_result[0];?>
                        </b>곳입니다.</p>
                    <?php 
                        
                    while ($row_jeju = mysqli_fetch_array($result_jeju)){
                    
                    ?>
                    <div class="img_area" id="img_area">
                        <div class="img_areas">
                            <img src="uploads/<?php echo $row_jeju['images'] ?>" alt="섬네일이미지들어갈공간">
                        </div>
                        <div class="text_area">
                            <div class="text_areas">
                            <script>
                                    $(document).ready(function () {

                                        //북마크 추가 클래스뒤에 idxx값 추가했음
                                        $('.bookmark<?php echo $row_jeju['idx']?>').click(function () {
                                            //북마크에 추가하기 alert("테스트클릭");
                                            $(this).hide();
                                            $(this)
                                                .parent()
                                                .children('.bookmarkon<?php echo $row_jeju['idx']?>')
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

                                                url: 'addbookmark.php?idx=<?php echo $row_jeju['idx']?>', //통신원하는 주소 = 서버로 보낼 주소
                                                type: 'GET', //기본 GET
                                                dataType: 'html',
                                                data: {
                                                    "idx1": <?php echo $row_jeju['idx'] ?>
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
                                        $('.bookmarkon<?php echo $row_jeju['idx']?>').click(function () {
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
                                                .children('.bookmark<?php echo $row_jeju['idx']?>')
                                                .show();
                                            // var array = new Array(array_index); console.log(array_index);
                                            $.ajax({

                                                url: 'bookmark_delete.php?idx=<?php echo $row_jeju['idx']?>', //통신원하는 주소 = 서버로 보낼 주소
                                                type: 'GET', //기본 GET
                                                dataType: 'html',
                                                data: {
                                                    "idx1": <?php echo $row_jeju['idx'] ?>
                                                },
                                                success: function (data) {
                                                    // $('.ex').eq(idx).html(data);
                                                    console.log("ajax test"); // 성공
                                                }

                                            });

                                        });

                                    });
                                </script>

                                <div class="title"><?php echo $row_jeju['zone_name'] ?>
                                    <!-- <p id="ex" class="ex">변경</p> -->
                                    <!-- <a href="addbookmark.php"><?php //echo $row_jeju['idx'] ;?></a> -->
                                    <?php 
                                        $ses_name1=$_SESSION['name'];
                                        
                                        $idx = $row_jeju['idx'];
                                        // 색깔 보라색이여도 상관없따..
                                        $query = "SELECT * FROM flyzone LEFT JOIN bookmark ON bookmark.flyzone_idx = flyzone.idx WHERE bookmark.who ='$ses_name1'" ;
                                        // $query = "SELECT * FROM bookmark LEFT JOIN flyzone ON bookmark.flyzone_idx = flyzone.idx AND bookmark.flyzone_idx = '$idx' WHERE bookmark.flyzone_idx = '$idx' "  ;
                                        // AND bookmark.flyzone_idx = '$idx' 
                                        // $query2 = "SELECT * FROM bookmark LEFT JOIN flyzone ON bookmark.flyzone_idx = flyzone.idx WHERE bookmark.who ='$ses_name1'" ;


                                        // $result2= mysqli_query($conn,$query2);
                                        $result1 = mysqli_query($conn,$query);
                                        // $query_jeju = "SELECT * FROM bookmark LEFT JOIN flyzone ON bookmark.flyzone_idx = flyzone.idx WHERE area = '제주' order by idx desc limit 0,15";
                                       
                                        // while ($star_test = mysqli_fetch_array($result1)){ 
                                            
                                        $star_test = mysqli_fetch_array($result1);
                                        $bookmark_whs = $row_jeju['who'];                                  
                                        $bookmark_who = $star_test['who'];   
                                        $bookmark_num = $star_test['flyzone_idx']; //이 값을 각 게시물에 맞는 값으로 바꿔줘야 함

                                     
                                        // var_dump($star_test); 
                                        // echo $star_test[0];
                                         
                                        // var_dump($bookmark_whs);                          
                                        // var_dump($bookmark_num); 
                                        // var_dump($idx);
                                        //로그인 되있을때
                                        // } //새로운 while
                                        if(isset($ses_name1)){ ?>
                                         
                                
                                          <?php if($row_jeju['flyzone_idx'] == $row_jeju['idx'] && $ses_name1==$bookmark_whs) { ?>
                                            <!-- 각 idx가 맞고 로그인한유저가 즐겨찾기를 누른 유저일때 색칠된 별 보여줌 -->
                                                <span class="bookmarkon<?php echo $row_jeju['idx']; ?>" id="fav" ></span>
                                                <span
                                                    class="bookmark<?php echo $row_jeju['idx'] ;?>"
                                                    id="no_fav"
                                                    hidden="hidden"></span>

                                            <?php } else { ?>
                                                <!-- 아닐때 색칠안된 별 보여줌 -->
                                                <span
                                                class="bookmarkon<?php echo $row_jeju['idx']; ?>"
                                                id="fav"
                                                hidden="hidden"></span>
                                                <span class="bookmark<?php echo $row_jeju['idx'] ;?>" id="no_fav"></span>

                                            <?php } ?> <!--else-->
                                            

                                        <?php } else { ?>
                                                <!-- 로그인 안되있을때는 별이 아예 안보이게 -->
                                        <?php } ?>   <!--else-->
                                        
               
                                         

                                </div>
                                <p class="address">주소 :
                                    <?php echo $row_jeju['address'] ?></p>
                                <p class="tip">한줄 팁 :
                                    <?php echo $row_jeju['tip'] ?></p>
                                <p class="date"><?php echo $row_jeju['time'] ?></p>
                                <div class="info_box">
                                    <div class="links">
                                        <a
                                            href="https://map.kakao.com/?map_type=TYPE_MAP&q=<?php echo $row_jeju['address'] ?>">지도보기
                                        </a>
                                        <!-- <a href="">길찾기</a> -->
                                    </div>
                                   
                                    <?php 
                                    //글쓴이만 수정삭제 버튼 보이도록
                                    $ses_name = $_SESSION['name'];                                    
                                    if($ses_name==$row_jeju['writer']){ 
                                    ?>
                                    <div class="del_edit">
                                        <a href="flyzone_edit.php?idx=<?php echo $row_jeju['idx'];?>">수정</a>
                                        <a href="flyzone_delete.php?idx=<?php echo $row_jeju['idx'];?>" class="btn_flyzone_delete">삭제</a>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <!--while문 종료-->
                </div>
            </div>
        </section>
        <footer>
            <p>COPYRIGHT ⓒ 2020 BY GO EUN-CHAN all right reserved.</p>
        </footer>
    </body>
</html>