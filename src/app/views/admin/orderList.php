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
            <h1 class="page-title">Orders</h1>
            <hr>
            <!-- END PAGE TITLE-->
            
            <table id="table_id" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>OrderID</th>
            <th>InvoiceID</th>
            <th>Dress Name</th>
            <th>Customer Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Issue date</th>
            <th>Delivery Date</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
            while($row = $data['order']->fetch_assoc()){
              /*echo "<pre>";
              var_dump($row);
              echo "</pre>";*/
                echo "<tr>";
                echo "<td>".$row['orderID']."<p style='display:none'>o".$row['orderID']."</p></td>";
                echo "<td>".$row['invoiceID']."<p style='display:none'>i".$row['invoiceID']."</p></td>";
                echo "<td>".$row['dressName']."</td>";
                echo "<td><p style='display:none'>".$row['customerPhone']."</p>".$row['customerName']."</td>";
                echo "<td>".$row['orderQuantity']."</td>";
                echo "<td>".$row['orderPrice']."</td>";
                echo "<td>".$row['orderIssue']."</td>";
                echo "<td>".$row['orderDelivery']."</td>";
                echo "<td><a class='btn btn-sm btn-primary' href='".BASE_URL."admin/order/view/".$row['orderID']."'>View</a><a class='btn btn-sm btn-success' href='".BASE_URL."admin/order/edit/".$row['orderID']."'>Edit</a><a class='btn btn-sm btn-warning' href='".BASE_URL."admin/order/copy/".$row['orderID']."'><i class='fa fa-copy'></i></a></td>";
                echo "</tr>";
            }
        ?>

        
    </tbody>
</table>
            
            </div>
        </div>