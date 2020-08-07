<?php 
// ini_set("display_errors", "1"); //오류메세지가 보임
session_start();
$conn = mysqli_connect("localhost:3306","root","9159348","user");

$writer = $_SESSION['name'];
$title = $_POST['title'];
$address = $_POST['address'];
// $image = $_POST['fileupload'];
$tips = $_POST['tips'];
$area_value = $_POST['area']; //라디오 버튼은 이렇게 추가해야 됨

// echo $area_value; //라디오 버튼 값 출력



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
	echo " alert('사진은 필수로 등록해야 합니다!!');
    location.href=history.back();";
	
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

// $images = addslashes(file_get_contents($_FILES(['fileupload']['tmp_name']))); //이미지에서 데이터 가져오기 
// $img = $_FILES(['fileupload']['tmp_name']);
// $images = base64_encode(file_get_contents(addslashes($img)));
// var_dump($images);
// $handle = fopen($name,"rb");
// $contents= addslashes(fread($handle,filesize($name)));
// fclose($handle);
// var_dump($name);


// $title = $_POST['title'];
// $address = $_POST['address'];
// // $image = $_POST['fileupload'];
// $tips = $_POST['tips'];
// $area_value = $_POST['area'];
 //라디오 버튼은 이렇게 추가해야 됨
if(!empty($title) && !empty($address) && !empty($tips) && !empty($area_value) && !empty($name) ){
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
    $query = "INSERT INTO flyzone (zone_name,address,images,tip,heart,area,writer) VALUES ('$title','$address','$name','$tips','0','$area_value','$writer')";
    $result = mysqli_query($conn,$query);
    
    echo "<script>
    alert('글이 저장되었습니다.');
    location.href='flyzone.php';
        </script>";
}else{
    echo "<script>
    alert('내용을 모두 입력해 주세요!!');
    location.href=history.back();;
        </script>";
}


mysqli_close($conn);
?>


<!-- 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<img src="uploads/<?//=$_FILES['fileupload']['name']?>" />
</body>
</html> -->