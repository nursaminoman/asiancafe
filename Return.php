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
                                <h3>Return</h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="dashboard_breadcam text-right">
                                <p><a href="index.php">ASIAN CAFE Billing Software</a> <i class="fas fa-caret-right"></i>Return</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
               
               
                 </div>
                <div class="col-12">
                    <div class="QA_section">

                        <form>
                        <div class="white_box_tittle list_header">
                            <input autofocus class="form-control" type="text" name="sl" required placeholder="Enter SL">
                          </button>
                            <div class="box_right d-flex lms_block">
                          <div class="serach_field_2">
                           <button class="btn btn-primary" type="submit"> Search</button>
                          </div>
                          </form>
                               
                        <?php
                        if(isset($_GET['sl'])){
                          ?>
                            <div class="add_button ml-10">
                                <a href="money-receipt-print.php?sl=<?= $_GET['sl'] ?>" class="btn_1">Print</a>
                            </div>
                        <?php
                            }
                           ?>

                            </div>
                        </div>

                        <div class="mb_30">

                        <?php
                        if(isset($_GET['sl'])){
                          ?>
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
                                        <th scope="col">SL</th>
                                        <th scope="col">Item</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getsl=$_GET['sl'];
                                    $sl=1;
                                    $select="SELECT id,name,quantity,price FROM sales WHERE sl='$getsl'";
                                    $query=mysqli_query($db,$select);
                                     foreach($query as $value){
                                      ?>
                                      <tr>
                                        <td><?= $sl++ ?></td>
                                        <td><?= $value['name'] ?></td>
                                        <td><?= $value['quantity'] ?></td>
                                        <td>৳ <?= $value['price'] ?></td>
                                        <td>৳ <?= $value['price']*$value['quantity'] ?></td>
                                        <td>
                                        <button type="button" data-toggle="modal" data-target="#exampleModal<?= $value['id'] ?>" class="btn btn-success">Edit </button>
                                        <a href="backend/SalesDelete.php?sl=<?= $getsl ?>&id=<?= $value['id'] ?>&page=return"><button class="btn btn-danger">Delete </button></a> 
                                        </td>
                                    </tr>

                                     
                             <!--Edit Modal -->
                                <div class="modal fade" id="exampleModal<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <form action="backend/SalesQuantityEdit.php" method="POST">
                                <input type="hidden" name="id" value="<?= $value['id'] ?>">
                                <input type="hidden" name="sl" value="<?= $getsl ?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Quantity</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                         <div class="modal-content cs_modal">
                                        <div class="modal-body">
                                                <div  class="form-group">
                                                    <label for="quantity"><span class="text-danger">*</span> Quantity :</label>
                                                    <input name="quantity" value="<?= $value['quantity'] ?>" id="quantity" type="number" class="form-control" placeholder="Enter Quantity" required>
                                                </div>
                                        </div>
                                    </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                      </div>
                                    </div>
                                  </div>
                                  </form>
                                </div> 
                                <!--Edit Modal -->

                                      <?php

                                     }
                                     
                                    ?>

                                </tbody>
                            </table>
                          <?php
                        }
                        
                        ?>
                     

                        </div>
                    </div>
                </div>
            </div>
              


            </div>
        </div>
    </div>
<?php
require 'frontend/footer.php';
?>

