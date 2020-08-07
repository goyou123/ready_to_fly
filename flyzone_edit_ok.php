<?php
//세션 실행 이 위치가 이상하다.
session_start();

$conn = mysqli_connect("localhost:3306","root","9159348","user");


//POST로 받아온 데이터
$ses_name = $_SESSION['name'];
$idx = $_GET['idx'];
$title = $_POST['title'];
$address = $_POST['address'];
$tips = $_POST['tips'];
$area_value = $_POST['area'];
$heart =$_GET['heart'];
//사진 업로드$_SERVER('DOCUMENT_ROOT')
$uploads_dir = './uploads/'; //  ./ = 현재경로(.php)
$allowed_ext = array('jpg','jpeg','png','gif'); //확장자

// 변수 정리
$error = $_FILES['fileupload']['error'];
$name = $_FILES['fileupload']['name'];
$ext = array_pop(explode('.', $name));
$uploadfile = $uploads_dir . basename($name);
// 확장자 확인
if( !in_array($ext, $allowed_ext) ) {
	echo "허용되지 않는 확장자입니다.";
	exit;
}

// 파일 이동
if(move_uploaded_file($_FILES['fileupload']['tmp_name'],$uploadfile)){
    // echo "파일 uploads디렉토리에 올리기성공";

}

// 파일 정보 출력
// echo "<h2>이미지 정보</h2>
// <ul>
// 	<li>파일명: $name</li>
// 	<li>확장자: $ext</li>
// 	<li>파일형식: {$_FILES['fileupload']['type']}</li>
// 	<li>파일크기: {$_FILES['fileupload']['size']} 바이트</li>
// </ul>
// ";

if(!empty($title) && !empty($address) && !empty($tips) && !empty($area_value)){
    //빈칸이 없을때
    if($area_value==1){
        $area_value="서울/경기";
    }else if($area_value==2){
        $area_value="강원";
    }else if($area_value==3){
        $area_value="충청";
    }else if($area_value==4){
        $area_value="경상";
    }else if($area_value==5){
        $area_value="전라";
    }else if($area_value==6){
        $area_value="제주";
    }
    
    $query="UPDATE flyzone SET zone_name ='$title', address ='$address', images = '$name',tip = '$tips', heart='$heart',area ='$area_value',writer='$ses_name' WHERE idx = $idx" ;
    $result = mysqli_query($conn,$query);
    // echo "DB에 올라갔음!!!!!!!!!!!!!!!!!";
    echo "<script>
    alert('수정이 완료되었습니다.');
    location.href='flyzone.php';
        </script>";
}else{
    echo "<script>
    alert('빈 내용 입니다!');
    location.href=history.back();;
        </script>";
}


mysqli_close($conn);
?>

