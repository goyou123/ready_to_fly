<?php
$conn = mysqli_connect("localhost:3306","root","9159348","user");
$idx = $_GET['idx'];
// var_dump($idx);

$query = "DELETE FROM main_board WHERE idx = $idx"; //글 삭제
$result = mysqli_query($conn,$query);
$query1 = "DELETE FROM comments WHERE bbs1_no = $idx"; //모든댓글 삭제
$result1 = mysqli_query($conn,$query1);
// $row = mysqli_fetch_array($result);

$autoincre_query = "ALTER TABLE main_board auto_increment = 1";
$auto = mysqli_query($conn,$autoincre_query);

?>

<script>
    alert('게시글이 삭제되었습니다.');
    location.href='community.php';
</script>