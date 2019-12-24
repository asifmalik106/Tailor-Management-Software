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
            <p align="center" class="print-brand">A-1 Marin Tailors</p>
              <p align="center" class="print-tagline">21-22, M.H. Bhaban, N.S. Road(Roxi Lane Moor), Kushtia.</p>
              <p align="center" class="print-tagline"><b>Phone:</b> 071-73466(Shop), <b>Mobile:</b> 01741-998664, 0186-7201886</p>
              <?php
                /*echo "<pre>";
                print_r($data);
                echo "</pre>";*/
                $date = date("d/m/Y", strtotime($data['info']['invoice']['invDate']));
                $time = date("h:i:s A", strtotime($data['info']['invoice']['invTime']));
                
              ?>
              <table class="table table-print">
                <tr>
              <td width="33%"><b>Customer Name: </b><?php echo $data['info']['order'][0]['orderInfo']['customerName']." (".$data['info']['order'][0]['orderInfo']['customerPhone'].")"; ?></b></td>
              <td width="33%"><h3 class="print-tagline" align="center"><b>Invoice# </b><?php echo $data['id']; ?></b></h3></td>
              <td width="33%"><p class="print-tagline" align="right"><?php echo $date." (".$time.")"; ?></p></td>
                </tr>
              </table>
            <div class="row">
              
              <div class="col-xs-8">
              
              <div class="table-responsive">
              <table class="table table-print">
                <caption><strong align="center">Order Information</strong></caption>
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
              <table border="1px">
                <tr>
                <td style="padding:5%">Sample Cloth</td>
                  <td style="padding:5%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>
              </table>
              </div>
              </div>
              <div class="col-xs-4">
                    <table  class="table table-print"><caption><strong align="center">Payment Information</strong></caption>
                  <tr>
                    <td>Total</td>
                    <td>৳ <?php echo $gt; ?>.0</td>
                  </tr>
                  <tr>
                    <td>Nagori (+)</td>
                    <td>৳ <?php echo $data['info']['invoice']['invNagori']; ?></td>
                  </tr>
                  <tr>
                    <td>Discount (-)</td>
                    <td>৳ <?php echo $data['info']['invoice']['invDiscount']; ?></td>
                  </tr>
                  <tr>
                    <td>Total</td>
                    <td>৳ <span id="grandTotal"><?php echo $gt+ $data['info']['invoice']['invNagori']- $data['info']['invoice']['invDiscount']; ?></span>.0</td>
                  </tr>
                  <tr>
                    <td>Paid</td>
                    <td>৳ <span id="paid"><?php echo (int)$data['info']['payment']; ?></span>.0</td>
                  </tr>
                  <tr>
                    <td>Due</td>
                    <td>৳ <span id="due"><?php echo $gt+ $data['info']['invoice']['invNagori']- $data['info']['invoice']['invDiscount'] - (int)$data['info']['payment']; ?></span>.0</td>
                  </tr>
                </table>
              </div>
            </div>  
            </div>
        </div>