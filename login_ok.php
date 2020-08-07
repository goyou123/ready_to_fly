<?php
//세션 실행 이 위치가 이상하다.
session_start();

//디비연동
$conn = mysqli_connect("localhost:3306","root","9159348","user");
// DB연동 체크완료
// if(mysqli_connect_errno($conn)){
//     echo "데이터베이스 연결 실패";

// }else{
//     echo "데이터베이스 연결 성공";
//     echo "<br/>";
// }




//POST받기
$id = $_POST['id'];
$password = $_POST['password'];

//DB에서 아이디 비번 빼오기
//user DB에 아이디가 POSTid와 POSTpw에 일치하는 값을 가져와라
$query = "SELECT * FROM user_info WHERE id = '$id'" ;


//쿼리실행함수
$result = mysqli_query($conn,$query);

//정보를 배열로 나타내는 함수
$row = mysqli_fetch_array($result);


//var_dump를 활용해 변수안의 값을 확인할 수 있다.
// var_dump($row);
// var_dump($row["user_password"]);
// var_dump($row['id']);
// var_dump($result);
// echo "<br>POST ID : $id<br>";
// echo "POST pw : $password<br>";
// var_dump(isset($_POST['auto_login'])); //true 반환




// id와 pw가 DB의 값과 일치하면
// 변수명 잘 확인하기!!

if($id==$row["id"] && $password==$row["user_password"] && isset($_POST['auto_login'])){
     //자동로그인체크시
    // $_SESSION['id']=$row['id'];
    // $_SESSION['name']=$row['user_name'];
    // $_SESSION['password']=$row['user_password'];

    // if(headers_sent($_FILES,$line)){
    //     //이미 http헤더가 전송되었다면 TRUE반환
    //     echo "쿠키를 생성할 수 없습니다.";
    // }else{
        $_SESSION['id']=$row['id'];
        $_SESSION['name']=$row['user_name'];
        $_SESSION['password']=$row['user_password'];
        setcookie("user_id_cookie",$id,time()+3600*24);
        setcookie("user_password_cookie",$password,time()+3600*24);
        // echo "쿠키결과값";
        // var_dump($_COOKIE['user_id_cookie']);
        // var_dump($_COOKIE['user_password_cookie']);

        echo "<script>
        alert('로그인 되었습니다.2');
        location.href='index.php';
        </script>";
    // }
   
}else if($id==$row["id"] && $password==$row["user_password"] && !isset($_POST['auto_login'])){
     //일반 로그인
     $_SESSION['id']=$row['id'];
     $_SESSION['name']=$row['user_name'];
     $_SESSION['password']=$row['user_password'];
     echo "<script>
     alert('로그인 되었습니다.1');
     location.href='index.php';
     </script>";
     // echo "<script>location.href='example/exlogin.php';</script>";
    // echo "<script>location.href='index.php';</script>";  location.href='index.php';
}else{
    echo "<script>window.alert('아이디나 비밀번호를 확인해주세요1.');</script>";

    echo "<script>location.href='login.php';</script>";
}

// echo "<br>POST ID : $id<br>";
// echo "<br>POST PW :$password<br>";



// echo로는 아래 변수들이 출력되지 않는다.
// 그래서 변수값을 확인하는 함수인 var_dump을 활용한다.
// echo "$result<br>";
// echo $row['id'];
// echo "$row<br>"."dd";
// print_r($row);


?>