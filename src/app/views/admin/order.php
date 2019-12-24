
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
    <div class="page-wrapper">
        <!-- BEGIN HEADER -->
        <?php include 'asset/includes/navbar.php';?>
        <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <?php include 'asset/includes/sidebar.php';?>
        
        <div class="page-content-wrapper">
            <div class="page-content">
              <div class="row">
                <div class="col-xs-4">
                 
                    <?php
                    $dress = $data['dress']['dressFields'];
                    $order = $data['order']['measurementInfo'];
                    $dressName = array();
                    /*echo "<pre>";
                    print_r($dress);
                    echo "</pre>";
                    echo "<pre>";
                    print_r($order);
                    echo "</pre>";*/
                    $i = 0;
                      foreach($dress as $d){
                        echo "<div class=m".($i+1).">";
                        echo  '<table class="table table-bordered table-condensed table-print">';
                        echo "<tr>";
                        echo "<th>Dress Name: </th>";
                        echo "<th>".$d['name']."</th>";
                        echo "</tr>";
                        $j = 0;
                        array_push($dressName, $d['name']);
                        foreach($d['fields'] as $dp){
                          echo "<tr>";
                          echo "<td>".$dp."</td>";
                          echo "<td>".$order[$i][$j]." inch</td>";
                          echo "</tr>";
                          $j++;
                        }
                        $i++;
                        echo "</table>";
                        echo "</div>";
                      }
                      $bid = 1;
                      foreach ($dressName as $dName) {
                        echo '<button type="button" class="btn btn-primary btn-xs" id="b'.$bid.'">'.$dName.'</button>';
                        $bid++;
                      }
                    ?>
                </div>

                <div class="col-xs-8">
                  <div  class="row">
                <div class="col-xs-6">
                                <h3 align="center" style="padding: 0px 0px 0px 0px; margin:0px 0px 0px 0px;">Invoice ID: <b><?php echo $data['order']['orderInfo']['invoiceID']; ?></b></h3>
                                
                  <?php
                  echo "<p class='print-tagline'><strong>Features:</strong> (".$data['feature']['featureData'].")</p>";
                  if($data['feature']['featureType'] == "image"){
                    echo '<image src="'.BASE_URL.'/asset/features/'.$data['feature']['featureSL'].'.png">';
                  }
                  ?><br>
                  <u><strong >Remarks</strong></u>
                  <p class="print-tagline"><?php echo $data['order']['orderInfo']['orderRemarks']; ?></p>
                  <u><strong>Measurement Person</strong></u>
                  <p class="print-tagline"><?php echo $data['employee'][0]['employeeName']; ?></p>
                  <u><strong>Cutting Person</strong></u>
                  <p class="print-tagline"><?php echo $data['employee'][1]['employeeName']; ?></p>

                </div>
                <div class="col-xs-6">
                  <h4 style="padding: 0px 0px 0px 0px; margin:0px 0px 0px 0px;">Customer Name: <b><?php echo $data['order']['orderInfo']['customerName']; ?></b></h4>
                  <table class="table table-bordered table-condensed table-print">
                    <tr>
                      <td>Order ID</td>
                      <td><?php echo $data['order']['orderInfo']['orderID']; ?></td>
                    </tr>
                    <tr>
                      <td>Issue</td>
                      <td><?php echo $data['order']['orderInfo']['orderIssue']; ?></td>
                    </tr>
                    <tr>
                      <td>Delivery</td>
                      <td><?php echo $data['order']['orderInfo']['orderDelivery']; ?></td>
                    </tr>
                    <tr>
                      <td>Quantity</td>
                      <td><?php echo $data['order']['orderInfo']['orderQuantity']; ?></td>
                    </tr>
                    <tr>
                      <td>Price</td>
                      <td>BDT <?php echo $data['order']['orderInfo']['price']; ?></td>
                    </tr>
                    <tr>
                      <td>Status</td>
                      <td><?php echo $data['order']['orderInfo']['orderStatus']; ?></td>
                    </tr>
                  </table>
                                <table border="1px">
                <tr>
                <td style="padding:5%">Sample Cloth</td>
                  <td style="padding:5%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>
              </table>
                </div>
              </div>
                            
              </div>
              </div>
            
            </div>
        </div>