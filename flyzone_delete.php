<?php 
$conn = mysqli_connect("localhost:3306","root","9159348","user");
$idx = $_GET['idx'];
//글 삭제
$query = "DELETE FROM flyzone WHERE idx = $idx"; //글 삭제
$result = mysqli_query($conn,$query);

//북마크 삭제
$query1 = "DELETE FROM bookmark WHERE flyzone_idx = $idx";
$result1 = mysqli_query($conn,$query1);
?>

<script>
    alert('추천한 비행지역이 삭제되었습니다.');
    location.href='flyzone.php';
</script>