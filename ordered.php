<body>
    <h1>ประวัติการซื้อสินค้า</h1>
<?php

// เชื่อมต่อฐานข้อมูล
$servername="localhost";
$username="root";
$password="12345678";
$dbname="shop";
$con=mysqli_connect($servername,$username,$password,$dbname);
if(!$con) die("Connnect mysql database fail!!".mysqli_connect_error());
// echo "Connect mysql successfully!";

$sql1 = "SELECT * FROM order_product";
$allCus=mysqli_query($con,$sql1);
if(mysqli_num_rows($allCus)>0){
  
    while($row=mysqli_fetch_assoc($allCus)){
            $order = $row['id'];
            echo "<p>Name : ".$row['fname']." ".$row['lname']."</p>";
            echo "<p> Address : ".$row['address']."</p>";
            echo "<p>Mobile : ".$row['moblie']."</p>";
            echo "<p>Order : ".$row['id']."</p>";
            echo "<p>Date : ".$row['order_date']."</p>";
            echo "<br>";

             $sql2="SELECT  * FROM  order_detail INNER JOIN product ON product.id = order_detail.product_id
                    INNER JOIN order_product ON order_detail.order_id = order_product.id WHERE order_product.id = $order";
            $productList=mysqli_query($con,$sql2);
          
            if(mysqli_num_rows($productList)>0){
                $total = 0;
                   echo "<table border=1>
                    <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>description</th>
                    <th>price</th>
                    </tr>";
                while($row=mysqli_fetch_assoc($productList)){
                    echo "<tr>
                    <td>".$row["product_id"]."</td>
                    <td>".$row["name"]."</td>
                    <td>".$row["description"]."</td>
                    <td>".$row["price"]."</td>
                    <tr>";
                    $total += $row["price"];
                }
                 echo "</table>";
                 echo "<h3>ราคาสินค้า $total บาท</h3>";
            }else{
                echo "0 results";
            }
    }
   
}else{
    echo "0 results";
}
echo "<h2><a href='show_product.php'>สั่งสินค้าอีกครั้ง</a></h2>";
?>
</body>