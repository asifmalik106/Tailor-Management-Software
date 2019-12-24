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
            <!-- Start Content -->
            <form method="POST" action="<?php echo BASE_URL; ?>admin/order/confirm/">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box blue">
                    <div class="portlet-title">
                      <div class="caption">
                        <i class="icon-info"></i>Dress & Customer
                      </div>
                    </div>
                        <div class="portlet-body">
                        	<table class="table">
                            <tr>
                              <td>Dress Name</td>
                              <input type="hidden" name="dressID" value="<?php echo $data['dress']['dressID']; ?>">
                              <td><?php echo $data['dress']['dressName']; ?></td>
                            </tr>
                            <tr>
                              <td>Customer Name</td>
                              <input type="hidden" name="customerID" value="<?php echo $data['customer']['customerID']; ?>">
                              <td><?php echo $data['customer']['customerName']." (".$data['customer']['customerPhone'].")"; ?></td>
                            </tr>
                        	</table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-info"></i>Measurements
                            </div>
                        </div>
                        <div class="portlet-body">
                    	    <div class="form-body">
                                
                                    <?php 
                                        $count = 1;
                                        foreach($data['dress']['dressFields'] as $row){
                                            echo '<div class="mt-element-ribbon bg-grey-steel">';
                                            echo '<div class="ribbon ribbon-border-hor ribbon-clip ribbon-color-primary uppercase">';
                                            echo '<div class="ribbon-sub ribbon-clip"></div>';
                                            echo $row['name'];
                                            echo '</div><br><br><br>';
                                            
                                            foreach($row['fields'] as $inRow){
                                                echo '<div class="form-group form-md-line-input form-md-floating-label">';
                                                echo '<div class="input-icon">';
                                                echo '<input name="dress'.$count.'[]" type="text" class="form-control">';
                                                echo '<label for="form_control_1">'.$inRow.'</label>';
                                                echo '<i class="icon-direction"></i>';
                                                echo '</div>';
                                                echo '</div>';
                                            }
                                            echo '</div>';
                                            $count++;
                                        }   
                                        
                                    ?>
                                    

                                </div>
        				    </div>
                        </div>
                    </div>
                
                <div class="col-md-4">
                  <div class="portlet box blue">
                    <div class="portlet-title">
                      <div class="caption">
                        <i class="icon-info"></i>Order Information
                      </div>
                    </div>
                    <div class="portlet-body">
                    	<div class="form-body">
                      <div class="form-group form-md-line-input form-md-floating-label">
                        <div class="input-icon">
                          <input type="number" step="0.01" class="form-control" name="quantity">
                          <label for="form_control_1">Quantity</label>
                          <i class="icon-exclamation"></i>
                        </div>
                      </div>
                      <div class="form-group form-md-line-input">
                        <div class="input-icon">
                          <input type="number"class="form-control" value="<?php echo $data['dress']['dressPrice']; ?>" name="price">
                          <label for="form_control_1">Price</label>
                          <i class="icon-tag"></i>
                        </div>
                      </div>
                      <?php
                        $tz = 'Asia/Dhaka';
                        $timestamp = time();
                        $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
                        $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
                        $dt = $dt->format('d/m/Y');
                      ?>
                      <div class="form-group form-md-line-input">
                        <div class="input-icon">
                          <input type="text" class="form-control date" value="<?php echo $dt; ?>" name="issue">
                          <label for="form_control_1">Issue Date</label>
                          <i class="icon-calendar"></i>
                        </div>
                      </div>
                      <div class="form-group form-md-line-input form-md-floating-label">
                        <div class="input-icon">
                          <input type="text" class="form-control date" name="delivery">
                          <label for="form_control_1">Delivery Date</label>
                          <i class="icon-calendar"></i>
                        </div>
                      </div>
        
        				</div>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-4">
                  <div class="portlet box blue">
                    <div class="portlet-title">
                      <div class="caption">
                        <i class="icon-info"></i>Tailoring Information
                      </div>
                    </div>
                    <div class="portlet-body">
                    	<div class="form-body">
                        <div class="form-group">
                          <label>Dress Feature</label>
                          <select class="form-control" name="featureSL">
                            <option value="0">No Feature</option>
                            <?php
                              while($r123 = $data['feature']->fetch_assoc()){
                                echo '<option value="'.$r123['featureSL'].'">'.$r123['featureData'].'</option>';
                              }
                            ?>
                          </select>
                        </div>
                      <div class="form-group form-md-line-input form-md-floating-label">
                          <textarea  class="form-control" rows="8" name="remarks"></textarea>
                          <label for="form_control_1">Remarks</label>
                      </div>
                      <div class="form-group form-md-line-input form-md-floating-label">
                        <div class="input-icon">
                          <input type="number" step="0.01" class="form-control" name="length">
                          <label for="form_control_1">Cloth Length</label>
                          <i class="icon-info"></i>
                        </div>
                      </div>
                      <div class="form-group form-md-line-input">
                            <div class="input-icon">
                              <select class="form-control" name="cutting">
                                <option selected value="0">Not Assigned</option>
                                <?php
                                    while($row = $data['employeeCutting']->fetch_assoc()){
                                        if($row['department']=='Cutting'){
                                            echo '<option value="'.$row['employeeID'].'">'.$row['employeeName'].'</option>';
                                        }
                                    }
                                ?>
                              </select>
                              <label for="form_control_1">Measurement Person</label>
                              <i class="icon-user"></i>
                            </div>
                          </div>
                          <div class="form-group form-md-line-input">
                            <div class="input-icon">
                              <select class="form-control" name="stitching">
                                <option selected value="0">Not Assigned</option>
                                <?php
                                    while($row = $data['employeeStitching']->fetch_assoc()){
                                        if($row['department']=='Stitching'){
                                            echo '<option value="'.$row['employeeID'].'">'.$row['employeeName'].'</option>';
                                        }
                                    }
                                ?>
                              </select>
                              <label for="form_control_1">Cutting Person</label>
                              <i class="icon-user"></i>
                            </div>
                          </div>
                          <div class="form-group form-md-line-input">
                            <div class="input-icon">
                              <select class="form-control" name="status">
                                <option>Pending</option>
                                <option>Ready</option>
                                <option>Delivered</option>
                              </select>
                              <label for="form_control_1">Status</label>
                              <i class="icon-energy"></i>
                            </div>
                          </div>
        
        				</div>
                    </div>
                  </div>
                </div>
                
            </div>
            <div class="text-right"><button class="btn btn-lg btn-primary" style="width:100%"><i class="icon-plus"></i> Add New Order</button></div>
            
            </form>
            <!-- End Content -->
            </div>
        </div>