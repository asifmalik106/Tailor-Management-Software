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
            <form method="POST" action="<?php echo BASE_URL; ?>admin/order/change/">
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
                              <input type="hidden" name="orderID" value="<?php echo $data['order']['orderInfo']['orderID']; ?>">
                              <input type="hidden" name="dressID" value="<?php echo $data['dress']['dressID']; ?>">
                              <input type="hidden" name="dressName" value="<?php echo $data['dress']['dressName']; ?>">
                              <input type="hidden" name="invID" value="<?php echo $data['order']['orderInfo']['invID']; ?>">
                              <td><?php echo $data['dress']['dressName']; ?></td>
                            </tr>
                            <tr>
                              <td>Customer Name</td>
                              <input type="hidden" name="customerID" value="<?php echo $data['customer']['customerID']; ?>">
                              <td><?php echo $data['customer']['customerName']." (".$data['customer']['customerPhone'].")"; ?></td>
                            </tr>
                            <input type="hidden" value="<?php echo $data['customer']['customerPhone']; ?>" name="mobile">
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
                                        $orderArray = $data['order']['measurementInfo'];
                                        $i = 0;
                                        foreach($data['dress']['dressFields'] as $row){
                                            echo '<div class="mt-element-ribbon bg-grey-steel">';
                                            echo '<div class="ribbon ribbon-border-hor ribbon-clip ribbon-color-primary uppercase">';
                                            echo '<div class="ribbon-sub ribbon-clip"></div>';
                                            echo $row['name'];
                                            echo '</div><br><br><br>';
                                            $j = 0;
                                            foreach($row['fields'] as $inRow){
                                                echo '<div class="form-group form-md-line-input form-md-floating-label">';
                                                echo '<div class="input-icon">';
                                                echo '<input name="dress'.$count.'[]"  class="form-control" value="'.$orderArray[$i][$j].'">';
                                                echo '<label for="form_control_1">'.$inRow.'</label>';
                                                echo '<i class="icon-direction"></i>';
                                                echo '</div>';
                                                echo '</div>';
                                              $j++;
                                            }
                                          $i++;
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
                          <input type="number" class="form-control" name="quantity" value="<?php echo $data['order']['orderInfo']['orderQuantity']; ?>">
                          <label for="form_control_1">Quantity</label>
                          <i class="icon-exclamation"></i>
                        </div>
                      </div>
                      <div class="form-group form-md-line-input">
                        <div class="input-icon">
                          <input type="number"class="form-control" value="<?php echo $data['order']['orderInfo']['price']; ?>" name="price">
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
                          <input type="text" class="form-control date" name="issue" value="<?php echo date("d/m/Y", strtotime($data['order']['orderInfo']['orderIssue'])); ?>" name="issue">
                          <label for="form_control_1">Issue Date</label>
                          <i class="icon-calendar"></i>
                        </div>
                      </div>
                      <div class="form-group form-md-line-input form-md-floating-label">
                        <div class="input-icon">
                          <input type="text" class="form-control date" name="delivery" value="<?php echo date("d/m/Y", strtotime($data['order']['orderInfo']['orderDelivery'])); ?>">
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
                            <option value="<?php echo $data['order']['orderInfo']['featureSL']; ?>" selected><?php echo $data['features']['featureData']; ?> (Selected)</option>
                            <option value="0">No Feature</option>
                            <?php
                              while($r123 = $data['feature']->fetch_assoc()){
                                echo '<option value="'.$r123['featureSL'].'">'.$r123['featureData'].'</option>';
                              }
                            ?>
                          </select>
                        </div>
                      <div class="form-group form-md-line-input form-md-floating-label">
                          <textarea  class="form-control" rows="8" name="remarks"><?php echo $data['order']['orderInfo']['orderRemarks']; ?></textarea>
                          <label for="form_control_1">Remarks</label>
                      </div>
                      <div class="form-group form-md-line-input form-md-floating-label">
                        <div class="input-icon">
                          <input type="number" step="0.05" class="form-control" name="length" value="<?php echo $data['order']['orderInfo']['orderClothLength']; ?>">
                          <label for="form_control_1">Cloth Length</label>
                          <i class="icon-info"></i>
                        </div>
                      </div>
                      <div class="form-group form-md-line-input">
                            <div class="input-icon">
                              <select class="form-control" name="cutting">
                                
                                <?php
                                    if($data['selectedEmployee'][0]['employeeID']==0){
                                      echo '<option selected value="0">Not Assigned</option>';
                                    }else{
                                      echo '<option selected value="'.$data['selectedEmployee'][0]['employeeID'].'">'.$data['selectedEmployee'][0]['employeeName'].'(Selected)</option>';
                                    }
                                    while($row = $data['employeeCutting']->fetch_assoc()){
                                        if($row['department']=='Cutting' && $row['employeeID']!=$data['selectedEmployee'][0]['employeeID']){
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
                              <select class="form-control" name="stitching">
                                <option selected value="0">Not Assigned</option>
                                <?php
                                    if($data['selectedEmployee'][1]['employeeID']==0){
                                      echo '<option selected value="0">Not Assigned</option>';
                                    }else{
                                      echo '<option selected value="'.$data['selectedEmployee'][1]['employeeID'].'">'.$data['selectedEmployee'][1]['employeeName'].'(Selected)</option>';
                                    }
                                    while($row = $data['employeeStitching']->fetch_assoc()){
                                        if($row['department']=='Stitching' && $row['employeeID']!=$data['selectedEmployee'][1]['employeeID']){
                                            echo '<option value="'.$row['employeeID'].'">'.$row['employeeName'].'</option>';
                                        }
                                    }
                                ?>
                              </select>
                              <label for="form_control_1">Stitching Person</label>
                              <i class="icon-user"></i>
                            </div>
                          </div>
                          <div class="form-group form-md-line-input">
                            <div class="input-icon">
                              <select class="form-control" name="status">
                                <?php
                                  echo '<option value="'.$data['order']['orderInfo']['orderStatus'].'">'.$data['order']['orderInfo']['orderStatus'].'(Selected)</option>';
                                ?>
                                <option value="Pending">Pending</option>
                                <option value="Ready">Ready</option>
                                <option value="Delivered">Delivered</option>
                                <option value="Cancelled">Cancelled</option>
                                
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