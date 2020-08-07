<?php
session_start();
$conn = mysqli_connect("localhost:3306","root","9159348","user");
$no = $_GET['no'];
$idx = $_GET['bbs1_no'];
$content = $_POST['editcomment'];
// var_dump($no);
// var_dump($content);
// var_dump($idx);
$query = "UPDATE comments SET memo ='$content' WHERE no = $no " ;
    
$result = mysqli_query($conn,$query);  
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
?>
<script>
    alert('수정이 완료되었습니다.');
    location.href='read.php?idx=<?php echo $idx ?>';
</script>