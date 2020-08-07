<?php
//테스트용으로 이렇게 작성
// mysql연결하기 (서버의 IP주소, 이름, 비밀번호, 데이터베이스 이름) ! 실제로비밀번호 저따위로 하면 안됨

$conn = mysqli_connect("localhost:3306","root","9159348","example_db");
$res1 = mysqli_query($conn, "
    INSERT INTO topic (
        title ,
        description ,
        phone 
    ) VALUES (
        '고은찬',
        'eid',
        '01050282074'
    )");
$res = mysqli_query($conn,'select * from topic');

    if(mysqli_connect_errno($conn)){
        echo "데이터베이스 연결 실패";

    }else{
        echo "데이터베이스 연결 성공";
        echo "<br/>";
    }


    while($row = mysqli_fetch_assoc($res)){
        echo "  번호: ".$row["_id"];
        echo "  이름: ".$row["title"];
        echo "  폰번호: ".$row["phone"];
        echo "<br/>";
    }

    

    mysqli_close($conn);
?>



