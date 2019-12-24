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
                            <div class="form-body">
                                <div class="form-group form-md-line-input">
                                    <div class="input-icon">
                                        <select class="form-control">
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
                                <div class="text-center">
                                    <div class="btn-group pull-center" data-toggle="buttons" >
                                        <label class="btn btn-primary active" id="existingCustomerToggle">
                                            <input type="radio" name="options" autocomplete="off" checked>Existing Customer
                                        </label>
                                        <label class="btn btn-primary" id="newCustomerToggle">
                                            <input type="radio" name="options" autocomplete="off"> New Customer
                                        </label>
                                    </div>
                                </div>
                                <div id="existingCustomerDiv" style="display:none">
                                    <div class="form-group form-md-line-input">
                                        <div class="input-icon">
                                            <select class="form-control">
                                                <option selected disabled>Select a Customer</option>
                                                <?php
                                                    while($row = $data['customer']->fetch_assoc())
                                                    {
                                                        echo '<option value="'.$row['customerID'].'">'.$row['customerName']."</option>";
                                                    }
                                                ?>
                                            </select>
                                            <label for="form_control_1">Select Dress</label>
                                            <i class="icon-basket"></i>
                                        </div>
                                    </div>
                                </div>
                                <div id="newCustomerDiv" style="display:none">
                                    <div class="form-group form-md-line-input has-info form-md-floating-label">
                                        <div class="input-group left-addon">
                                            <span class="input-group-addon">
                                                <i class="icon-user icon-18"></i>
                                            </span>
                                            <input type="text" class="form-control" id="name">
                                            <label for="form_control_1">Customer Name</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input has-info form-md-floating-label">
                                        <div class="input-group left-addon">
                                            <span class="input-group-addon">
                                                <i class="icon-phone icon-18"></i>
                                            </span> 
                                            <input type="text" class="form-control" id="mobile" type="tel">
                                            <label for="form_control_1">Mobile No.</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input has-info form-md-floating-label">
                                        <div class="input-group left-addon">
                                            <span class="input-group-addon">
                                                <i class="icon-location-pin icon-18"></i>
                                            </span>
                                            <textarea class="form-control" rows="4" id="address"></textarea>
                                            <label for="form_control_1">Address</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    
                </div>
            </div>
            
            </div>
        </div>