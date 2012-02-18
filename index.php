<?php
	include ("dbconnect.php");
	include ("class_lib_test.php");
	$producttoadd = $_POST['product'];
	
	$product_check = "SELECT * FROM product";
	$order_check = "SELECT * FROM orders";
	
	if (mysql_num_rows(mysql_query($product_check)) <= 0){
		//Generate random products and build product table
		$products = new product();
		$products->randomize_product();
	}
	else{}
	
	if (mysql_num_rows(mysql_query($order_check)) <= 0){
		//Generate random orders and build order table
		$orders = new orders();
		$orders->make_order();
	}
	else{}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Rhodes Test Store</title>
    <style type="text/css">
        <!--
        @import url("css/reset.css");
        @import url("css/styles.css");
        -->
    </style>
</head>
<body>
<?	
	if (isset($_POST['add'])){
		$addproduct = new addstock();
		$addproduct->add_specific($producttoadd,1,20);
		
		$select_query = "SELECT product, product_id
							FROM product
							WHERE product_id = $producttoadd";
		$result = mysql_query($select_query);
		$row=mysql_fetch_array($result);
		$addedproduct = $row['product'];
		print "<div class='info'><h2>Stock added to $addedproduct.</h2></div>";
	}
	else if (isset($_POST['addtoall'])){
		$addstock = new addstock();
		$addstock->add_random(1,30);
		print "<div class='info'><h2>Stock added to all products.</h2></div>";
	}
	else if (isset($_POST['reset'])){
		mysql_query("TRUNCATE TABLE orders");
		mysql_query("TRUNCATE TABLE product");
		print "<div class='info'><h2>Tables have been reset. <a href='index.php'>Rebuild Tables Again</a></h2></div>";
	}
	else{}
	
	// CREATE TABLE OF PRODUCTS AND AVAILABILITY
	$select_products = "SELECT product, product_id, avail, on_order, DATE_FORMAT(arrival,'%M %d, %Y') AS arrival
						FROM product";
	$products_result = mysql_query($select_products);
	?>
    <div class="container">
    <div class="tables">
    <table>
        <tr>
            <th>Product</th>
            <th>Product ID</th>
            <th>Available</th>
            <th>On Order</th>
            <th>Arrival Date</th>
            <th>Amount Sold</th>
            <th>Average in Orders</th>
            <th>Average Purchased</th>
        </tr>
    <?php
	while($row=mysql_fetch_array($products_result)){
		$product = $row['product'];
		$product_id = $row['product_id'];
		$avail = $row['avail'];
		$on_order = $row['on_order'];
		$arrival = $row['arrival'];
		
		print "\n\t<tr>";
		print "\n\t\t<td>$product</td>";
		print "\n\t\t<td>$product_id</td>";
		print "\n\t\t<td>$avail</td>";
		print "\n\t\t<td>$on_order</td>";
		print "\n\t\t<td>$arrival</td>";
		
		//Add the total of the current product that is in the orders table
		$select_total = "SELECT SUM(quantity) AS quantity_total FROM orders WHERE product_id=$product_id";
		$row=mysql_fetch_array(mysql_query($select_total));
		$total = $row['quantity_total'];
		if ($total == null){
			print "\n\t\t<td>0</td>";
		}
		else{
			print "\n\t\t<td>$total</td>";
		}
		
		//Find the average appearance of product in all orders
		$select_appearances = mysql_query("SELECT * FROM orders WHERE product_id=$product_id");
		$appearances = mysql_num_rows($select_appearances);
		$average_appearance = (($appearances / 20) * 100);
		print "\n\t\t<td>$average_appearance%</td>";
		
		$average_total = round(($total / $appearances),2);
		if ($average_total == null){
			print "\n\t\t<td>0</td>";
		}
		else{
			print "\n\t\t<td>$average_total</td>";
		}
		
		
		print "\n\t</tr>\n";
	}
	?>
    </table>
    <?php
	
	//CREATE TABLE OF CURRENT ORDERS
	$select_orders = "SELECT o.order_num, DATE_FORMAT(date,'%M %d, %Y') AS date, o.product_id, o.quantity, p.product, p.product_id
						FROM orders as o, product as p
						WHERE p.product_id = o.product_id
						ORDER BY o.order_num ASC";
	$orders_result = mysql_query($select_orders);
	?>
    <table>
        <tr>
            <th>Order #</th>
            <th>Date Placed</th>
            <th>Product</th>
            <th>Quantity</th>
        </tr>
    <?php
	while($row=mysql_fetch_array($orders_result)){
		$order_num = $row['order_num'];
		$date = $row['date'];
		$product = $row['product'];
		$quantity = $row['quantity'];
		
		print "\n\t<tr>";
		print "\n\t\t<td>$order_num</td>";
		print "\n\t\t<td>$date</td>";
		print "\n\t\t<td>$product</td>";
		print "\n\t\t<td>$quantity</td>";
		print "\n\t</tr>\n";

	}
	?>
    </table>
    </div>
    <div class="admin">
    <form name="reset" action="index.php" method="post">
    	<input type="submit" name="reset" class="form_button" value="Clear Table">
    </form>
    
    <form name="addrandom" action="index.php" method="post">
    	<input type="submit" name="addtoall" class="form_button" value="Add Stock To All">
    </form>
    
    <form name="addproduct" action="index.php" method="post">
    	<select name="product">
        	<?php
			$dropdown_select = "SELECT product, product_id
								FROM product";
			$result = mysql_query($dropdown_select);
			while($row=mysql_fetch_array($result)){
				$product = $row['product'];
				$product_id = $row['product_id'];
				?>
                <option value="<?php print $product_id;?>"><?php print $product;?></option>
                <?php
			}
			?>
        </select>
        <input type="submit" name="add" class="form_button" value="Add Stock">
    </form>
    
    <h2><a href="products.php" target="_blank">Products XML</a></h2>
    <h2><a href="orders.php" target="_blank">Orders XML</a></h2>
    
    <?php
	mysql_close($con);
?>
	</div>
	</div>
</body>
</html>