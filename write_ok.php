<?php
//세션 실행 이 위치가 이상하다.
session_start();

//디비연동
$conn = mysqli_connect("localhost:3306","root","9159348","user");
// DB연동 체크완료
if(mysqli_connect_errno($conn)){
    // echo "데이터베이스 연결 실패";
    
}else{
    // echo "데이터베이스 연결 성공";
    // echo "<br/>";
    // echo $_SESSION['name'];
}

//POST로 받아온 데이터
$title = $_POST['title'];
$content = $_POST['content'];
$writer = $_SESSION['name'];
$date = date('Y-m-d');

// echo "$title<br>";
// echo "$content<br>";
// echo "$writer<br>";
// echo "$date<br>";

if(empty($title)){
    echo "<script>
    alert('빈 내용 입니다!');
    location.href=history.back();;
        </script>";
}
    


if(!empty($title)&&!empty($content)){
    //게시글의 idx - auto_increment 값 초기화
    $autoincre_query = "ALTER TABLE main_board AUTO_INCREMENT = 1";
    $auto = mysqli_query($conn,$autoincre_query);
   
    //추가
    $query = "INSERT INTO main_board (title,content,writer,date,see) VALUES ('$title','$content','$writer','$date','0')";
    // for($i=0; $i<100; $i++){
    $write = mysqli_query($conn,$query);
    // }

}

echo "<script>
alert('작성이 완료되었습니다.');
location.href='community.php';
    </script>";


mysqli_close($conn);
?>