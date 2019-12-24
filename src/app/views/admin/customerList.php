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
            <h1 class="page-title">Customers</h1>
            <hr>
            <!-- END PAGE TITLE-->
            
            <table id="table_id" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>CustomerID</th>
            <th>Customer Name</th>
            <th>Mobile No.</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while($row = $data['customer']->fetch_assoc()){
                echo "<tr>";
                echo "<td>".$row['customerID']."</td>";
                echo "<td>".$row['customerName']."</td>";
                echo "<td>".$row['customerPhone']."</td>";
                echo "<td>".$row['customerAddress']."</td>";
                echo "</tr>";
            }
        ?>

        
    </tbody>
</table>
            
            </div>
        </div>