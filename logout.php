<?php

session_start(); // 세션

if($_SESSION['id']!=null){
   //세션을 파괴하고 쿠키의 지속시간을 현재시간으로 만들어서 종료한다.
   session_destroy();
   setcookie("user_id_cookie",$_SESSION['id'],time());
   setcookie("user_password_cookie",$_SESSION['password'],time());

}

echo "<script>
alert('로그아웃 되었습니다.')
location.href='index.php';</script>";

?>