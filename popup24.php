<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body{background: url(/images/drone_zoneno.png) no-repeat center top / 150%; height: 480px; width: auto;
      ;}
      body .all {background: rgba(0, 0, 0, 0.5);height: 405px;}
      .all .center { width: 70% ; margin: 0 auto; color: #fff; text-align: center;}
      .all .center b {font-size: 50px; padding-top: 80px; display: block;}
      .all .center p {font-size: 40px;}
      .button { text-align: center; margin: 12px 0  ;}
      .button a { padding: 10px 30px ; background: #fbb036; color: #fff; display: inline-block;}
    </style>
</head>
<body>
    <!-- 세부 팝업창 내용 -->
    <div class="all">
        <div class="center">
        <b>드론,</b>
        <p>어디서 날려야 되나 궁금하셨죠?</p>
        </div>
    </div>
    


    <div class="button">
        <a href="flyzone.php" target="_blank">지역별 비행장소추천 바로가기</a>
    </div>
    <div class="bottom">
        <form>
        <input type="checkbox" name="popup_check"" value="2" onclick="location.href='popcookie.php'">
        <span>하루동안 이 창을 열지 않음</span>
        <a href="javascript:self.close()">닫기</a>
        </form>
    </div>
    
</body>
</html>