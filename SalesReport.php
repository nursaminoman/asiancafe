<?php
require 'frontend/head.php';

?>

 <div class="main_content_iner ">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
              <div class="col-12">
                <div class="dashboard_header mb_50">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="dashboard_header_title">
                                <h3>Sales Report</h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="dashboard_breadcam text-right">
                                <p><a href="index.php">ASIAN CAFE Billing Software</a> <i class="fas fa-caret-right"></i>Sales Report</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
       


       <?php
       
       if(isset($_SESSION['start_date'])){
        ?>
         <div class="row" id='printMe'>
                    <div class="col-12" >
                        <div class="card-box table-responsive">
                            <h3 class="m-t-0  text-center">ASIAN CAFE Sales Report</h3>
                            <h4 class="m-t-0  text-center"><?= $_SESSION['time'] ?></h4>
                            <div class="row text-center">
                                  <div class="col-6">
                                 <h4 class="m-t-0  text-center"> Start Date : <?= $_SESSION['start_date'] ?> </h4>
                             </div>

                             <div class="col-6">
                                <h4 class="m-t-0  text-center"> End Date :  <?= $_SESSION['end_date'] ?> </h4>
                             </div>
                              

                          </div>

                    <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                   <th>SL</th>
                                   <th>Customer ID/Name</th>
                                   <th>Products Name</th>
                                   <th>Quantity</th>
                                   <th>Price</th>
                                   <th>Sub Total</th>
                                   <th>Date</th>
                                   <th>Sales By</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sl=1;
                                $total= 0;
                                $start_date=$_SESSION['start_date'] ?? '';
                                $end_date=$_SESSION['end_date'] ?? '';
                                $select="SELECT * FROM sales WHERE date between '$start_date' and '$end_date' order by date";
                                $query=mysqli_query($db,$select);
                                foreach($query as $value){
                                 ?>
                                 <tr>
                                     <td><?= $sl++ ?></td>
                                     <td><?= $value['id_name'] ?></td>
                                     <td><?= $value['name'] ?></td>
                                     <td><?= $value['quantity'] ?></td>
                                     <td><?= $value['price'] ?></td>
                                     <td>
                                     <?php
                                     $sub_total=$value['quantity']*$value['price'];
                                     echo $sub_total; 
                                     ?>
                                         
                                     </td>
                                     <td><?= $value['date'] ?></td>
                                     <td><?= $value['sales_by'] ?></td>
                                 </tr>
                                 <?php
                                 $total = $total + ($value["quantity"] * $value["price"]);  
                                }

                                ?>

                                 <tr>
                                    <td colspan="5" class="text-right">Total Amount</td>
                                    <td colspan="3" class="text-left">৳ : <?php echo number_format($total); ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>     
                                                              
                        </div>
                    </div>
                </div>
                           <div class="text-center mt-4 mb-4">   
                           <button  onclick="printDiv('printMe')" class="btn btn-success hidden-print">Print</button>
                          <a href="SalesReport.php" class="btn btn-danger hidden-print">Back<a/>             
                           </div> <br>

         
        <?php
        unset($_SESSION['start_date']);
       }
       else{
        ?>
               <div class="card">
      <div class="card-header text-center">
        <b>Search Sales Report<b>
      </div>
      
      <div class="card-body text-center">
       <form action="backend/SalesReportResult.php" method="POST">
        <div class="row">
        <div class="col-4">
         <label for="start_date"><span class="text-danger">*</span> Start Date : </label>
         <input type="date" name="start_date" value="<?= date("Y-m-d")?>" required>
        </div>
        <div class="col-4">
         <label for="end_date"><span class="text-danger">*</span> End Date : </label>
        <input  type="date" name="end_date" value="<?= date("Y-m-d")?>" required>
        </div>
        <div class="col-4">
        <button class="btn btn-primary" type="submit">Search</button>
        </div>
        </div>
        </form>

        <hr><div class="row">
        <div class="col-8">
         <div class="white_box mb_30">
                        <div class="box_header">
                            <div class="main-title">
                                <h3 class="mb_25" >Sales Report</h3>
                            </div>
                           
                        </div>

                         <canvas id="myChart" width="100"></canvas>

                    </div>
                </div>
                <div class="col-4">
                  <div class="list_counter_wrapper white_box mb_30 p-0 card_height_100">
                                <div class="single_list_counter">
                                    <p>Today Sales Amount</p><br>
                                    <?php
                                    $total2= 0;
                                    $Today=date('Y-m-d');
                                    $SelectTodaySales="SELECT * FROM sales WHERE date='$Today'";
                                    $QueryTodaySales=mysqli_query($db,$SelectTodaySales);
                                    foreach($QueryTodaySales as $SingleValue){
                                     $total2 = $total2 + ($SingleValue["quantity"] * $SingleValue["price"]);  
                                    }
                     
                                    ?>
                                    <h3 class="deep_blue_2" >৳ <?= number_format($total2) ;?></h3>
                                </div>
                                <div class="single_list_counter">
                                    <?php
                                    $total= 0;
                                    $select="SELECT * FROM sales";
                                    $query=mysqli_query($db,$select);
                                    foreach($query as $value){
                                     $total = $total + ($value["quantity"] * $value["price"]);  
                                    }
                     
                                    ?>
                                    <p>Total Sales Amount</p><br>
                                    <h3 class="deep_blue_2">৳ <?= number_format($total) ;?></h3>
                                </div>
                               
                            </div>
                      </div><br>
     
        </div>

      </div>
        <?php
       }

       ?>





</div>
</div><br>

<?php
require 'frontend/footer.php';
?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function printDiv(divName){
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

        }
    </script>
     <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Today Sales Amount ', 'Total Sales Amount '],
                datasets: [{
                    data: ['<?= ($total2) ;?>','<?= ($total) ;?>'],
                    backgroundColor: [
                        'rgba(255, 0, 0)',
                        'rgba(60, 179, 113)',
                      
                    ],
                    borderColor: [
                        'rgba(255, 0, 0)',
                        'rgba(60, 179, 113)',
                    
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        </script>

<?php
?>
