<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
    <div class="page-wrapper">
        <!-- BEGIN HEADER -->
        <?php include 'asset/includes/navbar.php';?>
        <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <?php include 'asset/includes/sidebar.php';?>
        
        <div class="page-content-wrapper">
            <div class="page-content">
            <!-- BEGIN PAGE TITLE-->
            <h1 class="page-title">Add New Order</h1>
            <hr>
            <!-- END PAGE TITLE-->
            
            <div class="row">
                <div class="col-md-6">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-info"></i>Dress & Customer
                            </div>
                        </div>
                        <div class="portlet-body">
                            <form method="POST" action="<?php echo BASE_URL; ?>admin/order/next/">
                            <div class="form-body">
                                <div class="form-group form-md-line-input">
                                    <div class="input-icon">
                                        <select class="form-control" name="dress" required>
                                            <option selected disabled>Select a Dress</option>
                                            <?php
                                                while($row = $data['dress']->fetch_assoc())
                                                {
                                                    echo '<option value="'.$row['dressID'].'">'.$row['dressName']."</option>";
                                                }
                                            ?>
                                        </select>
                                        <label for="form_control_1">Select Dress</label>
                                        <i class="icon-basket"></i>
                                    </div>
                                </div> 
                                
                                <div class="form-group">
                                    <label>Select Customer</label>
                                        <select class="form-control" id="selectCustomer" name="customer" required>
                                            <option selected disabled>Select a Customer</option>
                                            <?php
                                                while($row = $data['customer']->fetch_assoc())
                                                {
                                                    echo '<option value="'.$row['customerID'].'">'.$row['customerName'].' ('.$row['customerPhone'].')</option>';
                                                }
                                            ?>
                                        </select>
                                </div>
                             
                            </div>
                              
                            <div class="form-action">
                              
                               <a href="<?php echo BASE_URL; ?>/admin/customer/new/">Customer Not Listed? Click Here to Add New Customer</a><hr>
                                <button class="btn btn-primary" type="submit">Start New Order</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    
                </div>
            </div>
            
            </div>
        </div>