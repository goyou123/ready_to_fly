
<?php
session_start();
if(isset ($_SESSION['name'])){ 
    // location.replace("login.php");
    $sslogin=TRUE;
    } else if(!isset ($_SESSION['name'])) {
    echo '<script>
        alert("로그인이 필요합니다");
        
    </script>';
    }
$conn = mysqli_connect("localhost:3306","root","9159348","user");


// $count = $_GET['del_count'];
$idx = $_GET['idx1']; //받아온값, 주소에서 받아와도 됨
$ses_name = $_SESSION['name'];
var_dump($idx); 
// var_dump($index);

$query = "DELETE FROM bookmark WHERE flyzone_idx = $idx";
$result = mysqli_query($conn,$query);





mysqli_close($conn);
?>