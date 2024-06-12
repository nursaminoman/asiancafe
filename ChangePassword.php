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
                                <h3>Change Password</h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="dashboard_breadcam text-right">
                                <p><a href="index.php">ASIAN CAFE Billing Software</a> <i class="fas fa-caret-right"></i>Change Password</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-lg-12">
                    <div class="white_box mb_30">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <!-- sign_in  -->
                                <div class="modal-content">
                                  
                                    <div class="modal-body">
                                              


                                        <form action="backend/ChangePasswordPost.php" method="POST">
                                            <div class="form-group">
                                                <input type="password" name="password"  class="form-control password" placeholder="Enter your Current Password" required>


                                                   <?php 
                                        
                                                if (isset($_SESSION['password'])) {

                                                      ?>
                                                    <style type="text/css" media="screen">
                                                    .password{
                                                        border:1px Solid Red;
                                                        }
                                                    </style>
                                                    <?php

                                                    echo $_SESSION['password'];
                                                    
                                                    unset($_SESSION['password']);
                                                  }
                                              
                                                  ?>

                                            </div>
                                             <div class="form-group">
                                                <input type="password" name="new_password"  class="form-control password2" placeholder="Enter your New Password" required>
                                               <?php 
                                        
                                                if (isset($_SESSION['password2'])) {

                                                      ?>
                                                    <style type="text/css" media="screen">
                                                    .password2{
                                                        border:1px Solid Red;
                                                        }
                                                    </style>
                                                    <?php

                                                    echo $_SESSION['password2'];
                                                    
                                                    unset($_SESSION['password2']);
                                                  }
                                              
                                                  ?>
                                            </div>
                                             <div class="form-group">
                                                <input type="password" name="confirm_password"  class="form-control" placeholder="Enter Confirm Password" required>
                                            </div>
                                            <div class="text-center">
                                            	<button type="submit" class="btn_1 full_width">Save Change</button>
                                            </div>
                                            
                                        
                                        </form>
                                    </div>
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