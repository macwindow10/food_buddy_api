<?php
include('connection.php');

// echo 'be';
$query = "SELECT o.id, o.date_time, r.name restaurant, u.name customer_name, u.address customer_address, u.mobile, m.name menu, o.preparation_instructions, CASE(o.order_status) WHEN 0 THEN 'Received' WHEN 1 THEN 'Approved'  WHEN 2 THEN 'Preparing'  WHEN 3 THEN 'Out for Delivery'  WHEN 4 THEN 'Delivered' END order_status, o.special_dietary_requirements, o.any_allergy, o.price
    FROM `order` o INNER JOIN menu m ON o.menu_id=m.id
	INNER JOIN users u ON o.user_id=u.id
    INNER JOIN restaurant r ON m.restaurant_id=r.id";
// echo $query;
$result = mysqli_query($con, $query);
// echo 'before2';
$rows_count = mysqli_num_rows($result);
// echo $rows_count;
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
        <style type="text/css">
            tr.header
            {
                font-weight:bold;
            }
            tr.alt
            {
                background-color: #F0F0F0;
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function(){
               $('.striped tr:even').addClass('alt');
            });

            function onApprove(id) {
                console.log('onApprove');
            }

            function onPreparing(id) {
                console.log('onPreparing');
            }

            function onOutForDelivery(id) {
                console.log('onOutForDelivery');
            }

            function onDelivered(id) {
                console.log('Delivered');
            }
        </script>
        <title>Food Buddy - Orders</title>
    </head>
    <body>
        <h2>Food Buddy - Orders</h2>
        Order Status
        <select>
            <option value=-1 selected>All</option>
            <option value=0 >Received</option>
            <option value=1 >Preparing</option>
            <option value=2 >Out for Delivery</option>
            <option value=3 >Delivered</option>
        </select>
        <table class="striped">
            <tr class="header">
                <td>Id</td>
                <td>Order Date</td>
                <td>Restaurant</td>
                <td>Customer</td>
                <td>Customer Address</td>
                <td>Mobile</td>
                <td>Menu</td>
                <td>Preparation Instructions</td>
                <td>Order Status</td>
                <td>Special Dietary Requirements</td>
                <td>Any Allergy</td>
                <td>Price (Rupee)</td>
                <td>Actions</td>
            </tr>
            <?php
               while ($row = mysqli_fetch_array($result)) {
                   echo "<tr>";
                   echo "<td>$row[id]</td>";
                   echo "<td>$row[date_time]</td>";
                   echo "<td>$row[restaurant]</td>";
                   echo "<td>$row[customer_name]</td>";
                   echo "<td>$row[customer_address]</td>";
                   echo "<td>$row[mobile]</td>";
                   echo "<td>$row[menu]</td>";
                   echo "<td>$row[preparation_instructions]</td>";
                   echo "<td>$row[order_status]</td>";
                   echo "<td>$row[special_dietary_requirements]</td>";
                   echo "<td>$row[any_allergy]</td>";
                   echo "<td>$row[price]</td>";
                   echo "<td><a href='#' onclick='onApprove($row[id])'>Approve</a> | <a href='#' onclick='onPreparing($row[id])'>Preparing</a> | <a href='#' onclick='onOutForDelivery($row[id])'>Out for Delivery</a> | <a href='#' onclick='onDelivered($row[id])'>Delivered</a></td>";
                   echo "</tr>";
               }

            ?>
        </table>
    </body>
</html>