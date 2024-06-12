<?php
 require 'backend/session.php'; 
 require 'backend/db.php'; 
//REQUEST_METHOD
if($_SERVER['REQUEST_METHOD']=='GET'){
//all data
$date=date('Y-m-d');
$dt=new DateTime('now', new DateTimezone('Asia/Dhaka'));
$today=$dt->format('h:i:sa');
$sl = $_GET['sl'];

$selectN="SELECT id_name FROM sales WHERE sl='$sl' GROUP BY id_name";
$queryN=mysqli_query($db,$selectN);
$resultN=mysqli_fetch_assoc($queryN);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css">
           <!-- Bootstrap CSS -->
        <title>ASIAN CAFE Billing Software - Asian University of Bangladesh</title>
         <link rel="shortcut icon" href="logo.jpg">
            <style>
        .b1 {
          background-color: #2bba35;
          border: none;
          color: white;
          padding: 7px 20px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          margin: 4px 2px;
          cursor: pointer;
        }
        .b2 {
          background-color: #e7333c;
          border: none;
          color: white;
          padding: 7px 20px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          margin: 4px 2px;
          cursor: pointer;
        }        
        .img {
            width:100px;
            height:100px;
            
        }
        .center{
            text-align: center;
        }
        </style>
    </head>
    <body>
        <div class="ticket">
            <div class="center">
            <img class="img" src="./logo.jpg" alt="Logo">
            </div>
            <p class="centered"><b>ASIAN CAFE</b>
                <br>Phone: 01678860338
                <br>Date: <?= $date ?> <?= $today ?>
                <br>SL : <?=$sl?>
                <br>Customer : <?= $resultN['id_name'] ?? " " ?>
            </p>
                 
            <table>
                <thead>
                    <tr>
                        <th class="quantity">QTY.</th>
                        <th class="description">Description</th>
                        <th class="price">৳</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total= 0;
                    $select="SELECT name,quantity,price FROM sales WHERE sl='$sl'";
                    $query=mysqli_query($db,$select);
                    foreach($query as $value){       

                    ?>
                
                    <tr>
                        <td class="centered"><?= $value['quantity']; ?></td>
                        <td class="description"><?= $value['name'];?></td>
                        <td class="centered">৳ <?= $value['price']; ?></td>
                    </tr>
                    <?php
                    $total = $total + ($value["quantity"] * $value["price"]);            
                    }
                    ?>
                    
                   
                    <tr>

                        <td class="description">TOTAL</td>
                        <td class="centered">৳ <?php echo number_format($total,2); ?></td>
                    </tr>


                </tbody>
            </table>
            
            <p class="centered">Thanks for your purchase !</p>
        </div>
        <a id="btnPrint" class="hidden-print b1">Print<a/>
        <a href="Return.php" class="hidden-print b2">Back<a/></a><br> <br>
        <script src="script.js"></script>
    </body>
</html>
<?php
}
else{
    header("location:../error.php"); 
}
//End REQUEST_METHOD
  
?>