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
            <h1 class="page-title">Invoices</h1>
            <hr>
            <!-- END PAGE TITLE-->

            <table id="table_id" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>InvoiceID</th>
            <th>Customer Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Total</th>
            <th>Paid</th>
            <th>Due</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($data['invoice'] as $row){
                $due = $row['invTotal'] - $row['invPayment'];
                echo "<tr>";
                echo "<td>".$row['invID']."</td>";
                echo '<td>'.$row['customerName'].'<p style="display: none">'.$row['customerPhone'].'</p> </td>';
                echo "<td>".date("d/m/Y", strtotime($row['invDate']))."</td>";
                echo "<td>".date("h:i:s A", strtotime($row['invTime']))."</td>";
                echo "<td>".$row['invTotal']."</td>";
                echo "<td>".$row['invPayment']."</td>";
                echo "<td>".$due."</td>";
                if($due<=0){
                  echo '<td><span class="label label-success" style="background-color: #4CAF50; font-size:12px"><i class="glyphicon glyphicon-ok"></i> Paid</span><a class="btn btn-success btn-xs" href="'.BASE_URL.'admin/invoice/view/'.$row['invID'].'"><i class="icon-printer"></i> Print</a></td>';
                }else{
                  echo '<td>';
                  echo '<a class="btn btn-primary btn-xs" href="'.BASE_URL.'admin/invoice/payment/'.$row['invID'].'"><i class="icon-credit-card"></i> Payment</a>';
                  echo '<a class="btn btn-success btn-xs" href="'.BASE_URL.'admin/invoice/view/'.$row['invID'].'"><i class="icon-printer"></i> Print</a>';
                  echo '</td>';
                }
                echo "</tr>";
            }
        ?>

        
    </tbody>
</table>
            
            </div>
        </div>