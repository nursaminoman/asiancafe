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
                                <h3>User Management</h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="dashboard_breadcam text-right">
                                <p><a href="index.php">ASIAN CAFE Billing Software</a> <i class="fas fa-caret-right"></i>User Management</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <button type="button" class="btn btn-primary">
                            Total Users <span class="badge badge-light">
                           <?php
                            $select="SELECT COUNT(*) as total FROM users";
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
                                    <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn_1">Add New User</button>

                                    <!-- Modal -->
                                    
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <form action="backend/UserCreate.php" method="POST">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create New User Account</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                         <div class="modal-content cs_modal">
                                    <div class="modal-body">
                                        
                                            <div class="form-group">
                                                <label for="user_name"><span class="text-danger">*</span> Name :</label>
                                                <input name="user_name" id="user_name" type="text" class="form-control" placeholder="Enter Name" required>
                                            </div>
                                            <div  class="form-group">
                                                <label for="user_id"><span class="text-danger">*</span> AUB ID :</label>
                                                <input name="user_id" id="user_id" type="text" class="form-control" placeholder="Enter AUB ID" required>
                                            </div>
                                             <div class="form-group">
                                                <label for="user_role"><span class="text-danger">*</span> User Role :</label>
                                                <select style="width:100%;" class="form-control" id="js-example-basic-single" name="user_role" required>
                                                    <option value="">Select One</option>
                                                    <option value="1">Sales Man</option>
                                                    <option value="2">Admin</option>
                                                    <option value="3">Super Admin</option>
                                                 
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
                                        <th scope="col">User Photo</th>
                                        <th scope="col">AUB ID</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">User Role</th>
                                        <th scope="col">User Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                     $sl=1;
                                     $select="SELECT * FROM users";
                                     $query=mysqli_query($db,$select);
                                     foreach($query as $value){
                                      ?>
                                      <tr>
                                        <td><?= $sl++ ?></td>
                                        <td><img width="50" width="50" src="logo.jpg" alt="#"></td>
                                        <td><?= $value['user_id'] ?></td>
                                        <td><?= $value['user_name'] ?></td>
                                        <td>
                                         <?php
                                         if($value['user_role']=='1'){

                                            ?>
                                            <span class="badge badge-success">Sales Man</span></td>
                                            <?php 
                                         }
                                       
                                         elseif($value['user_role']=='2'){
                                             ?>
                                            <span class="badge badge-success">Admin</span></td>
                                            <?php 
                                         }
                                         else{

                                            ?>
                                            <span class="badge badge-success">Super Admin</span></td>
                                            <?php
                                         }
                                        ?>
                                            
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
                                        <a href="backend/UserPasswordReset.php?id=<?= $value['id'] ?>" ><button class="btn btn-warning">Password Reset </button></a>
                                        <a href="backend/UserDelete.php?id=<?= $value['id'] ?>"><button class="btn btn-danger">Delete </button></a> 
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


                                 <!--Edit Modal -->
                                
                                 <?php
                                     $select="SELECT * FROM users";
                                     $query=mysqli_query($db,$select);
                                  foreach($query as $evalue){
                                   ?>
                                   
                                <div class="modal fade" id="exampleModal<?= $evalue['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <form action="backend/UserEdit.php" method="POST">
                                <input type="hidden" name="id" value="<?= $evalue['id'] ?>">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit User Account</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                         <div class="modal-content cs_modal">
                                    <div class="modal-body">
                                        
                                            <div class="form-group">
                                                <label for="user_name"><span class="text-danger">*</span> Name :</label>
                                                <input value="<?= $evalue['user_name'] ?>" name="user_name" id="user_name" type="text" class="form-control" placeholder="Enter Name" required>
                                            </div>
                                            <div  class="form-group">
                                                <label for="user_id"><span class="text-danger">*</span> AUB ID :</label>
                                                <input value="<?= $evalue['user_id'] ?>" name="user_id" id="user_id" type="text" class="form-control" placeholder="Enter AUB ID" required>
                                            </div>
                                             <div class="form-group">
                                                <label for="user_role"><span class="text-danger">*</span> User Role :</label>
                                                <select style="width:100%;" class="form-control" name="user_role" required>
                                                    <option value="">Select One</option>
                                                    <option value="1">Sales Man</option>
                                                    <option value="2">Admin</option>
                                                    <option value="3">Super Admin</option>
                                                 
                                                </select>
                                           
                                            </div>

                                              <div class="form-group">
                                                <label for="user_status"><span class="text-danger">*</span> User Status :</label>
                                                <select style="width:100%;" class="form-control" name="user_status" required>
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
