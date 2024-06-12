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
                                <h3>Sales List</h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="dashboard_breadcam text-right">
                                <p><a href="index.php">ASIAN CAFE Billing Software</a> <i class="fas fa-caret-right"></i>Sales List</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
               
               
                 </div>
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <button type="button" class="btn btn-primary">
                            Total Sales <span class="badge badge-light">
                           <?php
                            $select="SELECT COUNT(*) as total FROM sales";
                            $query=mysqli_query($db,$select);
                            $assoc=mysqli_fetch_assoc($query);
                            echo $assoc['total'];
                            ?>
                                
                            </span>
                          </button>
                        </div>

                        <div class="mb_30">
                                           
                                             <!-- Notification Start -->
                                          <?php
                                          if(isset($_SESSION['success'])){
                                              ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong><?= $_SESSION['success']; ?></strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                              <?php
                                              unset($_SESSION['success']);
                                          }

                                          ?>

                                           
                                               <?php
                                          if(isset($_SESSION['fail'])){
                                              ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong><?= $_SESSION['fail']; ?></strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                              <?php
                                              unset($_SESSION['fail']);
                                          }

                                          ?>
                                         <!-- Notification End -->

                            <!-- table-responsive -->
                            <!-- <table id="example" class="display" style="width:100%"> -->
                            <table id="example" class="table table-bordered">
 

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
                                   <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     $sl=1;
                                     $total= 0;
                                     $select="SELECT * FROM sales";
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
                                     <td>
                                     <button type="button" data-toggle="modal" data-target="#exampleModal<?= $value['id'] ?>" class="btn btn-success">Edit </button>
                                     <a href="backend/SalesDelete.php?id=<?= $value['id'] ?>"><button class="btn btn-danger">Delete </button></a> 
                                     </td>
                                 </tr>
                                 <?php
                                 $total = $total + ($value["quantity"] * $value["price"]); 

                                     }
                                     
                                    ?>

                                </tbody>
                            </table>
                            

                        </div>
                    </div>
                </div>
            </div>
              


            </div>
        </div>
    </div>
     

     <!--Edit Modal -->
                                
                                 <?php
                                     $select="SELECT * FROM sales";
                                     $query=mysqli_query($db,$select);
                                  foreach($query as $evalue){
                                   ?>
                                   
                                <div class="modal fade" id="exampleModal<?= $evalue['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <form action="backend/SalesEdit.php" method="POST">
                                <input type="hidden" name="id" value="<?= $evalue['id'] ?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Sales</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                         <div class="modal-content cs_modal">
                                    <div class="modal-body">
                                        
                                            <div  class="form-group">
                                                 <label for="date"><span class="text-danger">*</span> Sales Date :</label>
                                                 <input class="form-control" type="date" name="date" id="date" value="<?= $evalue['date'] ?>" required >
                                            </div>
                                            <div class="form-group">
                                                <label for="SalesQuantity"><span class="text-danger">*</span> Sales Quantity :</label>
                                                <input name="quantity" value="<?= $evalue['quantity'] ?>" id="SalesQuantity" type="number" class="form-control" placeholder="Enter Quantity" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Customer"><span class="text-danger">*</span> Customer ID/Name :</label>
                                                <input name="id_name" value="<?= $evalue['id_name'] ?>" id="Customer" type="text" class="form-control" placeholder="Customer ID/Name" required>
                                            </div>

                                    </div>
                                </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                      </div>
                                    </div>
                                  </div>
                                  </form>
                                </div>

                                   <?php
                                  }
                                 ?>  
                                <!--Edit Modal -->


<?php
require 'frontend/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#js-example-basic-single').select2();
});
</script>
<?php

?>

