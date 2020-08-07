<?php
//세션 실행 이 위치가 이상하다.
session_start();

$conn = mysqli_connect("localhost:3306","root","9159348","user");


//POST로 받아온 데이터
$idx = $_GET['idx'];
$title = $_POST['title'];
$content = $_POST['content'];
// $writer = $_POST['writer']; //애초에 넘기지 않았음
$writer = $_SESSION['name'];
$date = date('Y-m-d');

// var_dump($writer);

$query = "UPDATE main_board SET title ='$title', content ='$content', date = '$date' WHERE idx = $idx" ;

$result = mysqli_query($conn,$query);



mysqli_close($conn);
?>

<script>
    alert('수정이 완료되었습니다.');
    location.href='read.php?idx=<?php echo $idx ?>';
</script>