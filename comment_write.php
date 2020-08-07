<?php
session_start();
$conn = mysqli_connect("localhost:3306","root","9159348","user");
if(mysqli_connect_errno($conn)){
    echo "데이터베이스 연결 실패";
    
}else{
    // echo "데이터베이스 연결 성공";
    // echo "<br/>";
    // echo $_SESSION['name'];
}

$ses_name = $_SESSION['name'];
$ses_id = $_SESSION['id'];
// POST_ID?
$bbs1_no = $_POST['bbs1_no']; //게시글번호
$replys =$_POST['replys']; // 커멘트 답글 번호
$memo = $_POST['memo']; //작성 댓글
// $regdate = date("Y-m-d i:s",time()); //시간
$regdate = date("Y.m.d H:i:s",time()); //시간

// var_dump($ses_name);
// var_dump($ses_id);
// var_dump($bbs1_no);
// var_dump($replys);
// var_dump($memo);
// var_dump($regdate);
if(!$memo){
    echo "<script>
    alert('내용을 입력하세요');
    location.href=history.back();
        </script>";
}

if(!empty($memo)){

    $query = "INSERT INTO comments (bbs1_no,user_id,name,replys,memo,regdate) VALUES ('$bbs1_no','$ses_id','$ses_name','$replys','$memo','$regdate')";

    $result = mysqli_query($conn,$query);
    // var_dump($result);



    if($result){
    echo "<script>
    alert('댓글이 등록되었습니다.');
    location.href='read.php?idx=$bbs1_no';
        </script>";
    }

}




?>
