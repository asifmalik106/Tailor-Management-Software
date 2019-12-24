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
            <h3 align="center">A-1 Marin Tailors</h3>
            <p align="center">Roxy Goli More, NS Road, Kushtia.</p><hr>
              <?php
                /*echo "<pre>";
                print_r($_SESSION);
                echo "</pre>";*/
              ?>
            <div class="row">
              
              <div class="col-md-8">
              <p>Customer Name: <b><?php echo $data['info']['order'][0]['orderInfo']['customerName']." (".$data['info']['order'][0]['orderInfo']['customerPhone'].")"; ?></b></p>
              <div class="table-responsive">
              <table class="table table-hover table-condensed table-bordered">
              <tr>
                <th>OrderID</th>
                <th>Dress</th>
                <th>Delivery</th>
                <th>Qty</th>
                <th>Rate</th>
                <th>Total</th>
              </tr>
              <?php
              $gt = 0;
                foreach($data['info']['order'] as $o){
                  $total = ((double)$o['orderInfo']['orderQuantity']) * ((double)$o['orderInfo']['orderPrice']);
                  echo "<tr>";
                  echo "<td>".$o['orderInfo']['orderID']."</td>";
                  echo "<td>".$o['orderInfo']['dressName']."</td>";
                  echo "<td>".$o['orderInfo']['orderDelivery']."</td>";
                  echo "<td>".$o['orderInfo']['orderQuantity']."</td>";
                  echo "<td>৳ ".$o['orderInfo']['orderPrice']."</td>";
                  echo "<td>৳ ".$total."</td>";
                  echo "</tr>";
                  $gt+=$total;
                }
              echo "<tr>";
              echo "<td></td>";
              echo "<td></td>";
              echo "<td></td>";
              echo "<td></td>";
              echo "<th>Total</th>";
              echo "<td><b>৳ ".$gt."</b></td>";
              echo "</tr>";
              
              ?>
              
            </table>  
                
              </div>
              </div>
              <div class="col-md-4">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <strong align="center">Payment Information</strong>
                  </div>
                  <div class="panel-body">
                    <form method="POST" action="<?php echo BASE_URL; ?>admin/invoice/process/">
                    <input type="hidden" name="invID" value="<?php echo $data['id']; ?>">
                    <input type="hidden" name="total" value="<?php echo $gt; ?>">
                    <input type="hidden" name="paid" value="<?php echo $data['info']['payment']; ?>">
                    <table class="table table-condensed table-bordered">
                  <tr>
                    <td><h5 align="right">Total</h4></td>
                    <td><h4 align="right">৳ <span id="total"><?php echo $gt; ?></span>.0</h4></td>
                  </tr>
                  <tr>
                    <td><h5 align="right">Nagori (+)</h4></td>
                    <td><input class="form-control invoiceInput" value="<?php echo $data['info']['invoice']['invNagori']; ?>" min="0" id="nagori" type="number" autocomplete="off" oninput="invoice()" name="nagori"></td>
                  </tr>
                  <tr>
                    <td><h5 align="right">Discount (-)</h4></td>
                    <td><input class="form-control invoiceInput" value="<?php echo $data['info']['invoice']['invDiscount']; ?>" placeholder="0" min="0" id="discount" type="number" autocomplete="off" oninput="invoice()" name="discount"></td>
                  </tr>
                  <tr>
                    <td><h5 align="right">Total</h4></td>
                    <td><h4 align="right">৳ <span id="grandTotal"><?php echo $gt+ $data['info']['invoice']['invNagori']- $data['info']['invoice']['invDiscount']; ?></span>.0</h4></td>
                  </tr>
                  <tr>
                    <td><h5 align="right">Paid</h4></td>
                    <td><h4 align="right">৳ <span id="paid"><?php echo (int)$data['info']['payment']; ?></span>.0</h4></td>
                  </tr>
                  <tr>
                    <td><h5 align="right">Account</h4></td>
                    <td>
                      <select class="form-control" name="account">
                        <?php
                          while($row = $data['info']['accounts']->fetch_assoc()){
                            echo '<option value="'.$row['accountID'].'">'.$row['accountName'].'</option>';
                          }
                        ?>
                        
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td><h5 align="right">Payment</h4></td>
                    <td><input class="form-control invoiceInput" placeholder="0" min="0" id="payment" type="number" autocomplete="off" oninput="invoice()"  name="payment"></td>
                  </tr>
                  <tr>
                    <td><h5 align="right">Due</h4></td>
                    <td><h4 align="right" class="font-red-mint">৳ <span id="due"><?php echo $gt+ $data['info']['invoice']['invNagori']- $data['info']['invoice']['invDiscount'] - (int)$data['info']['payment']; ?></span>.0</h4></td>
                  </tr>
                  <tr>
                    <td><h5 align="right">Return</h4></td>
                    <td><h4 align="right" style="color:#388E3C">৳ <span id="advance">0</span>.0</h4></td>
                  </tr>
                  
                </table>
                      <button type="submit" class="btn btn-primary">Make Payment</button>
                  </div>
                </div>
                
              </div>
            </div>  
            </div>
        </div>