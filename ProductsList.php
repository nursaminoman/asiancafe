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
                                <h3>Products List</h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="dashboard_breadcam text-right">
                                <p><a href="index.php">ASIAN CAFE Billing Software</a> <i class="fas fa-caret-right"></i>Products List</p>
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
                            Total Products <span class="badge badge-light">
                           <?php
                            $select="SELECT COUNT(*) as total FROM products";
                            $query=mysqli_query($db,$select);
                            $assoc=mysqli_fetch_assoc($query);
                            echo $assoc['total'];
                            ?>
                                
                            </span>
                          </button>
                            <div class="box_right d-flex lms_block">
                                <div class="serach_field_2">

                                </div>
                                <div class="add_button ml-10">
                                    <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn_1">Add New Products</button>

                                    <!-- Modal -->
                                    
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <form action="backend/ProductsCreate.php" method="POST">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create New Products</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                         <div class="modal-content cs_modal">
                                    <div class="modal-body">
                                        
                                            <div class="form-group">
                                                <label for="ProductsName"><span class="text-danger">*</span> Products Name :</label>
                                                <input name="name" id="ProductsName" type="text" class="form-control" placeholder="Enter Products Name" required>
                                            </div>
                                            <div  class="form-group">
                                                <label for="ProductsPrice"><span class="text-danger">*</span> Products Price :</label>
                                                <input name="price" id="ProductsPrice" type="number" class="form-control" placeholder="Enter Products Price" required>
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
                                 
                                <!-- Modal -->
                                </div>
                            </div>
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
                                        <th scope="col">SL</th>
                                        <th scope="col">Products  Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     $sl=1;
                                     $select="SELECT * FROM products";
                                     $query=mysqli_query($db,$select);
                                     foreach($query as $value){
                                      ?>
                                      <tr>
                                        <td><?= $sl++ ?></td>
                                        <td><?= $value['name'] ?></td>
                                        <td>৳ <?= $value['price'] ?></td>
                                        <td>
                                        <?php
                                         if($value['status']=='1'){

                                              ?>
                                            <span class="badge badge-pill badge-success">Active</span>
                                            <?php 
                                         }
                                         else{

                                            ?>
                                            <span class="badge badge-pill badge-danger">Inactive</span>
                                            <?php
                                         }
                                        ?>
                                        </td>
                                        <td>
                                        <button type="button" data-toggle="modal" data-target="#exampleModal<?= $value['id'] ?>" class="btn btn-success">Edit </button>
                                        <a href="backend/ProductsDelete.php?id=<?= $value['id'] ?>"><button class="btn btn-danger">Delete </button></a> 
                                        </td>
                                    </tr>
                                      <?php

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
                                     $select="SELECT * FROM products";
                                     $query=mysqli_query($db,$select);
                                  foreach($query as $evalue){
                                   ?>
                                   
                                <div class="modal fade" id="exampleModal<?= $evalue['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <form action="backend/ProductsEdit.php" method="POST">
                                <input type="hidden" name="id" value="<?= $evalue['id'] ?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Products</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                         <div class="modal-content cs_modal">
                                    <div class="modal-body">
                                        
                                            <div class="form-group">
                                                <label for="ProductsName"><span class="text-danger">*</span> Products Name :</label>
                                                <input name="name" value="<?= $evalue['name'] ?>" id="ProductsName" type="text" class="form-control" placeholder="Enter Products Name" required>
                                            </div>
                                            <div  class="form-group">
                                                <label for="ProductsPrice"><span class="text-danger">*</span> Products Price :</label>
                                                <input name="price" value="<?= $evalue['price'] ?>" id="ProductsPrice" type="number" class="form-control" placeholder="Enter Products Price" required>
                                            </div>

                                              <div class="form-group">
                                                <label for="status"><span class="text-danger">*</span> Status :</label>
                                                <select style="width:100%;" class="form-control" name="status" id="status" required>
                                                    <option value="">Select One</option>
                                                    <option value="1">Active</option>
                                                    <option value="2">Inactive</option>
                                                 
                                                </select>
                                           
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

