<?php
	header('Content-Type: text/xml'); 
	include ("dbconnect.php");
	include ("class_lib_test.php");
	echo "<?xml version='1.0' encoding='ISO-8859-1'?> \n";
	
	// CREATE TABLE OF PRODUCTS AND AVAILABILITY
	$select_products = "SELECT product, product_id, avail, on_order, DATE_FORMAT(arrival,'%M %d, %Y') AS arrival
						FROM product";
	$products_result = mysql_query($select_products);
	?>
    <products>
    <?php
	while($row=mysql_fetch_array($products_result)){
		$product = $row['product'];
		$product_id = $row['product_id'];
		$avail = $row['avail'];
		$on_order = $row['on_order'];
		$arrival = $row['arrival'];
		
		print "\n\t<product>";
		print "\n\t\t<name>$product</name>";
		print "\n\t\t<id>$product_id</id>";
		print "\n\t\t<available>$avail</available>";
		print "\n\t\t<onorder>$on_order</onorder>";
		print "\n\t\t<arrival>$arrival</arrival>";
		
		//Add the total of the current product that is in the orders table
		$select_total = "SELECT SUM(quantity) AS quantity_total FROM orders WHERE product_id=$product_id";
		$row=mysql_fetch_array(mysql_query($select_total));
		$total = $row['quantity_total'];
		if ($total == null){
			print "\n\t\t<total>0</total>";
		}
		else{
			print "\n\t\t<total>$total</total>";
		}
		
		//Find the average appearance of product in all orders
		$select_appearances = mysql_query("SELECT * FROM orders WHERE product_id=$product_id");
		$appearances = mysql_num_rows($select_appearances);
		$average_appearance = (($appearances / 20) * 100);
		print "\n\t\t<average>$average_appearance%</average>";
		
		$average_total = round(($total / $appearances),2);
		if ($average_total == null){
			print "\n\t\t<totalaverage>0</totalaverage>";
		}
		else{
			print "\n\t\t<totalaverage>$average_total</totalaverage>";
		}
		
		
		print "\n\t</product>\n";
	}
	?>
    </products>
<?php
	mysql_close($con);
?>