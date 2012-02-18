<?php
	header('Content-Type: text/xml'); 
	include ("dbconnect.php");
	include ("class_lib_test.php");
	echo "<?xml version='1.0' encoding='ISO-8859-1'?> \n";
	
	//CREATE TABLE OF CURRENT ORDERS
	$select_orders = "SELECT o.order_num, DATE_FORMAT(date,'%M %d, %Y') AS date, o.product_id, o.quantity, p.product, p.product_id
						FROM orders as o, product as p
						WHERE p.product_id = o.product_id";
	$orders_result = mysql_query($select_orders);
	?>
    <orders>
    <?php
	while($row=mysql_fetch_array($orders_result)){
		$order_num = $row['order_num'];
		$date = $row['date'];
		$product = $row['product'];
		$quantity = $row['quantity'];
		
		print "\n\t<order>";
		print "\n\t\t<number>$order_num</number>";
		print "\n\t\t<date>$date</date>";
		print "\n\t\t<product>$product</product>";
		print "\n\t\t<quantity>$quantity</quantity>";
		print "\n\t</order>\n";

	}
	?>
    </orders>
<?php
	mysql_close($con);
?>