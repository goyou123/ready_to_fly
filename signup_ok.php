<?php
$conn = mysqli_connect("localhost:3306","root","9159348","user");
// DB연동 체크완료
if(mysqli_connect_errno($conn)){
    echo "데이터베이스 연결 실패";

}else{
    echo "데이터베이스 연결 성공";
    echo "<br/>";
}
$id = $_POST['id']; //노란색 글씨는 포스트로 보낸 input의 neme
$email = $_POST['email'];
$name = $_POST['name'];
$password = $_POST['password'];
$pwcheck = $_POST['pwcheck'];

//비밀번호, 비밀번호 확인 체크
// if($password!=$pwcheck){
//     echo "비밀번호와 비밀번호 확인이 서로 다릅니다.";
//     echo "<a href = signup.php>뒤로~</a>";
//     exit();
// }else{
//     echo "비밀번호 체크";
//      exit();
// }


//빈칸 공백 체크
if($id==NULL || $password==NULL || $name==NULL || $email==NULL || $pwcheck==NULL) //
{
    echo
    "<script>
    alert('빈칸은 입력하실 수 없습니다.');
    location.href='signup.php';
    </script>";
}


// 아이디 중복 검사 체크
//근데 보통 아이디 중복 검사는 회원가입하는 곳 에 있음
$check="SELECT *from user_info WHERE id='$id'";
$result = mysqli_query($conn,$check);
$count = mysqli_num_rows($result);
if($count ==0){
    echo " 사용 가능 ID </br>" ;
}else{
    echo
    "<script>
    alert('아이디가 중복됩니다.');
    location.href='signup.php';
    </script>";
}


//DB에 회원가입 정보 저장
$signup=mysqli_query($conn,"INSERT INTO user_info (id,user_email,user_name,user_password,pwcheck) 
VALUES ('$id','$email','$name','$password','$pwcheck')");
// if($signup){
//     echo "sign up success </br>";
//     echo "$name </br>";
//     echo "$password </br>";
//     echo "$email </br>";
// }


// 다이얼로그 간략하게 띄우고 로그인창으로 이동하게
echo "<script>
    alert('회원가입이 완료되었습니다.');
    location.href='login.php';
        </script>";

        mysqli_close($conn);

?>
