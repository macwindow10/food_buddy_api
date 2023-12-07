<?php
include('connection.php');

// echo 'be';
$query = "SELECT o.id, o.date_time, r.name restaurant, u.name customer_name, u.address customer_address, u.mobile, m.name menu, o.preparation_instructions, o.order_status, o.special_dietary_requirements, o.any_allergy, o.price
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
        </script>
        <title>Food Buddy - Orders</title>
    </head>
    <body>
        <h2>Food Buddy - Orders</h2>
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
                   echo "<td>$row[restaurant]</td>";
                   echo "<td>$row[restaurant]</td>";
                   echo "</tr>";
               }

            ?>
        </table>
    </body>
</html>