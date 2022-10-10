<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


<?php
session_start();
$fname= $_POST["fname"];
$lname= $_POST["lname"];
$address= $_POST["address"];
$mobile= $_POST["mobile"];

$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "shop";
$con=mysqli_connect($servername,$username,$password,$dbname);
if(!$con) die("Connnect mysql database fail!!".mysqli_connect_error());
echo "Connect mysql successfully!";

// $result=mysqli_query($con,$sql);
// $numrow=mysqli_num_rows($result);
echo $numrow;
$sql="INSERT INTO order_product (fname, lname,address,moblie)";
$sql.="VALUES ('$fname', '$lname', '$address','$mobile');";

if (mysqli_query($con, $sql)) {
    $last_id = mysqli_insert_id($con);
    $sql1="INSERT INTO order_detail (order_id,product_id) VALUES ";
    for($i=0;$i<count($_SESSION["cart"]);$i++){
        $item_id=$_SESSION["cart"][$i]['id'];
        $sql1.="('$last_id','$item_id')";
        if($i<count($_SESSION["cart"])-1)
         $sql1.=",";
        else
         $sql.=";";
    }
    if(mysqli_query($con,$sql1)) echo "บันทึกข้อมูลการสั่งซื้อเรียบร้อยแล้ว";
    else "เกิดข้อผิดพลาดในการสั่งซื้อ";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
  }
  
  mysqli_close($con);
?>
<script>
    window.alert("สั่งซื้อเรียบร้อย");
    window.location.replace('ordered.php');
</script>

</body>
</html>