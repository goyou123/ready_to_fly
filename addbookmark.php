
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



$idx = $_GET['idx']; //받아온값, 주소에서 받아와도 됨
$ses_name = $_SESSION['name'];
var_dump($idx); 
// var_dump($index);

$query = "INSERT INTO bookmark (who,flyzone_idx) VALUES ('$ses_name','$idx')";
$result = mysqli_query($conn,$query);





mysqli_close($conn);
?>