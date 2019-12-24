<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
    <div class="page-wrapper">
        <!-- BEGIN HEADER -->
        <?php include 'asset/includes/navbar.php';?>
        <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <?php include 'asset/includes/sidebar.php';?>
        
        <div class="page-content-wrapper">
            <div class="page-content"  style="background-image: url('http://localhost/tailor/asset/img/ship.jpg');">
            <!-- BEGIN PAGE TITLE-->
            <h1 class="page-title" align="center" style="color:#fff">Add New Customer</h1>
            <hr>
            <!-- END PAGE TITLE-->
            <div class="row">
                <div class="col-md-5">
                    
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <h4 align="center">
                                <i class="icon-user-follow"></i> 
                                <span class="caption-subject bold uppercase"> Enter Customer information Here</span>
                            </h4>
                        </div>
                        <div class="portlet-body form">
                    
                            <form role="form">
                                <div class="form-body">
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
                                
                            
                            </form>
                            <div class="form-actions">
                                    <button class="btn btn-primary" id="addCustomer">Add New Customer</button>
                                    <span id="loading" style="display:none;"><img  height="48px" src="<?php echo BASE_URL; ?>asset/spinner.gif"> Please Wait</span>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            </div>
        </div>