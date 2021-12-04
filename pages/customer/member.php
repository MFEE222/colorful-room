<?php
if(!isset($_GET["id"])){
    echo "您不是從正常程序進入此頁";
    exit();
}
if(isset($_GET["id"])){
    $id=$_GET["id"];
}else{
    $id=0;
}
require_once ("../../components/pdo-connect.php");
$sqlMember="SELECT member. *,tag.name AS tag_name FROM member
JOIN tag ON member.tag_id = tag.id
WHERE  member.id=? AND member.valid=1";

//$sqlMember="SELECT * FROM member WHERE valid=1";
$stmt=$db_host->prepare($sqlMember);
try{
    $stmt->execute([$id]);
    $rowsMember=$stmt->fetch();
//    $rowsCountMember=$stmt->rowCount();
//    var_dump($rows);
}catch(PDOException $e){
    echo $e->getMessage();
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Member Detail</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-lg-12">
            <div class="py-2 my-3">
                <a href="user-list.php" class="btn btn-primary">回列表</a>
            </div>
          <table class="table table-bordered table-hover table-sm">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Account</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Phone</th>
              <th scope="col">生日</th>
              <th scope="col">性別</th>
              <th scope="col">訂閱方案</th>
              <th scope="col">標籤</th>
              <th scope="col">建立時間</th>
              <th scope="col">修改時間</th>

            </tr>
          </thead>
            <tbody>
            <tr>
              <td><?=$rowsMember["id"]?></td>
              <td><?=$rowsMember["account"]?></td>
              <td><?=$rowsMember["name"]?></td>
              <td><?=$rowsMember["email"]?></td>
              <td><?=$rowsMember["phone"]?></td>
              <td><?=$rowsMember["birthday"]?></td>
                <td><?=$rowsMember["gender"]?></td>
              <td><?=$rowsMember["subscribe"]?></td>
              <td><?=$rowsMember["tag_name"]?></td>
                <td><?=$rowsMember["created_at"]?></td>
                <td><?=$rowsMember["edit_at"]?></td>
            </tr>
            </tbody>
        </table>
        </div>
    </div>
</div>

<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
