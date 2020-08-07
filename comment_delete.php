<?php 
$conn = mysqli_connect("localhost:3306","root","9159348","user");
$no = $_GET['no'];
$bbs1_no = $_GET['bbs1_no'];
// var_dump($no);
// var_dump($bbs1_no);
$query = "DELETE FROM comments WHERE no = $no ";
// $query1 = "UPDATE main_board SET comments = comments-1 WHERE idx = $bbs1_no";

$result = mysqli_query($conn,$query);
$result1 = mysqli_query($conn,$query1);

if($result){
    $query2 = "DELETE FROM comments WHERE replys = $no";
    $result2 = mysqli_query($conn,$query2);
echo "<script>
    alert('삭제가 완료되었습니다.');
    location.href='read.php?idx=$bbs1_no';
        </script>";
    }
?>