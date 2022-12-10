<?php

$output = " ";

//Export Excel File - HQ Stock
if (isset($_POST['generate_hq'])) {
    $getData = "SELECT * FROM product WHERE store_type='Headquarters' ";
    $get_data = mysqli_query($connect, $getData);

    if (mysqli_num_rows($get_data) > 0) {
        $output .= "  <table class='table' bordered='1'>
                            <tr>
                                <th colspan='9'>Stock Report ( Headquarter )</th>
                            <tr>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Product Category</th>
                                 <th>Product Quantity</th>
                                <th>Store ID</th>
                                <th>Store Name</th>
                                <th>Store Type</th>
                            </tr>
                            ";

        foreach ($get_data as $row) {
            $output .= " <tr>
                                        <td>" . $row["product_id"] . "</td>
                                        <td>" . $row["name"] . "</td>
                                         <td>" . $row["price"] . "</td>
                                         <td>" . $row["category_name"] . "</td>
                                         <td>" . $row["quantity"] . "</td>
                                         <td>" . $row["store_id"] . "</td>
                                          <td>" . $row["store_name"] . "</td>
                                          <td>" . $row["store_type"] . "</td>
                                    </tr>";
        }
        $output .= "</table>";
    } else {
        echo 'no data found';
    }
    header("Content-Type:application/xls");
    header("Content-Disposition:attachment;filename=stock_report_HQ.xls");
    echo $output;
    exit(0);
}

//Export Excel File - Branch Stock
if (isset($_POST['generate_branch'])) {
    $getData = "SELECT * FROM product WHERE store_type='Branch' ";
    $get_data = mysqli_query($connect, $getData);

    if (mysqli_num_rows($get_data) > 0) {
        $output .= "  <table class='table' bordered='1'>
                            <tr>
                                <th colspan='9'>Stock Report ( Branches )</th>
                            <tr>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Product Category</th>
                                 <th>Product Quantity</th>
                                <th>Store ID</th>
                                <th>Store Name</th>
                                <th>Store Type</th>
                            </tr>
                            ";

        foreach ($get_data as $row) {
            $output .= " <tr>
                                        <td>" . $row["product_id"] . "</td>
                                        <td>" . $row["name"] . "</td>
                                         <td>" . $row["price"] . "</td>
                                         <td>" . $row["category_name"] . "</td>
                                         <td>" . $row["quantity"] . "</td>
                                         <td>" . $row["store_id"] . "</td>
                                          <td>" . $row["store_name"] . "</td>
                                          <td>" . $row["store_type"] . "</td>
                                    </tr>";
        }
        $output .= "</table>";
    } else {
        echo 'no data found';
    }
    header("Content-Type:application/xls");
    header("Content-Disposition:attachment;filename=stock_report_Branch.xls");
    echo $output;
    exit(0);
}
?>