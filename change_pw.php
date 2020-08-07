<?php 
session_start();

$conn = mysqli_connect("localhost:3306","root","9159348","user");



$current_pw = $_POST['current_pw'];
$change_pw = $_POST['change_pw'];
$check_change_pw = $_POST['check_change_pw'];
$ses_name=$_SESSION['name'];
$ses_id=$_SESSION['id'];
// echo $current_pw;

$query = "SELECT * FROM user_info WHERE user_name = '$ses_name' AND id = '$ses_id'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
// var_dump($row['user_password']);

if(empty($current_pw)||empty($change_pw)||empty($check_change_pw)){
    echo "<script>
    alert('내용을 모두 입력해주세요');
    location.href='mypage.php';
        </script>";
}



if($row['user_password']==$current_pw){
    if($change_pw==$check_change_pw){
        $query1 = "UPDATE user_info SET user_password ='$change_pw', pwcheck ='$check_change_pw' WHERE user_name = '$ses_name' AND id = '$ses_id'" ; 
        $result1 = mysqli_query($conn,$query1);
        echo "<script>
        alert('비밀번호가 성공적으로 변경되었습니다.');
        location.href='mypage.php';
            </script>";

    }else{
        echo "<script>
        alert('수정된 비밀번호와 비밀번호 확인이 일치하지 않습니다.');
        location.href='mypage.php';
            </script>";
    }





}else{
    echo "<script>
    alert('비밀번호를 확인해 주세요.');
    location.href='mypage.php';
        </script>";
}

mysqli_close($conn);
?>