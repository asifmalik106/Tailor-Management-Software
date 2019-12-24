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
            <h1 class="page-title">Create New Invoice</h1>
            <hr>
            <!-- END PAGE TITLE-->
            
            <div class="row">
                <div class="col-md-6">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-info"></i>Select A Customer To Create a Invoice
                            </div>
                        </div>
                        <div class="portlet-body">
                            <form method="POST" action="<?php echo BASE_URL; ?>admin/invoice/create/">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Select Customer</label>
                                        <select class="form-control" id="selectCustomer" name="customerID" required>
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
                                <button class="btn btn-primary" type="submit">Create New Invoice</button>
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