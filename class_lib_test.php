<?php

/*
Class to build the product table in the database with the following credentials:
- Random products (color + article of clothing)
- Random product availability from 0-100
- How much product is on order less 100
- Random arrival date that is 1-5 days from today's date
*/
class product {
	
	public function randomize_product() {
		$color = array("Red","Blue","Green","Orange","Purple","Teal","Black","White","Pink","Brown");
		$clothes = array("Hat","Shirt","Jacket","Pants","Socks","Sneakers","Sandals","Gloves","Shorts","Boots");
		$clothes_array = array();
		for ($i=1; $i<=10; $i++) {
			$random_color = $color[rand(0,9)];
			$random_clothes = $clothes[rand(0,9)];
			$clothes_array[$i] = $random_color . " " . $random_clothes;
		}
			
		for ($i=1; $i<=10; $i++){
			$avail = rand(0,100);
			$on_order = 100 - $avail;
			$random_date = rand(1,5);
			$arrival = date('Y-m-d', strtotime("+$random_date days"));
			$insert_products = "INSERT INTO product (id, product, product_id, avail, on_order, arrival)
								VALUES ('','$clothes_array[$i]','$i','$avail','$on_order','$arrival')";
			$result = mysql_query($insert_products);
			if (!$result) {
				die('Invalid query: ' . mysql_error());
			}
		}
	}
}

/*
Class to build the orders table in the database with the following credentials:
- Random order number
- Random product
- Random ammount of that product
- Random order date that is 1-5 days previous to today's date
*/
class orders{

	public function make_order(){
		$order = array();
		for($i=0; $i<20; $i++){
			$order_number = ($i+2)*rand(1,25);
			$number_products = rand(1,5);
			$random_product = rand(1,10);
			$quantity = rand (1,20);
			$order[$i] = $order_number . "," . $random_product . "," .  $quantity;
		}

		for ($i=0; $i<20; $i++){
			$order_expl = explode(",",$order[$i]);
			$previous_date = rand(1,5);
			$order_date = date('Y-m-d', strtotime("-$previous_date days"));
			$insert_orders = "INSERT INTO orders (id, order_num, date, product_id, quantity)
								VALUES ('','$order_expl[0]','$order_date','$order_expl[1]','$order_expl[2]')";
			$result = mysql_query($insert_orders);
			if (!$result) {
				die('Invalid query: ' . mysql_error());
			}
		}
	}

}

//Class to utilize adding random stock to all products or specific chosen product
class addstock{
	
	public function add_random($min,$max){
		$random = rand($min, $max);
		$update_all = "UPDATE product SET avail=avail+$random";
		$result = mysql_query($update_all);
		if (!$result) {
			die('Invalid query: ' . mysql_error());
		}
	}
	
	public function add_specific($product_number,$min,$max){
		$random = rand($min, $max);
		$update_product = "UPDATE product SET avail=avail+$random WHERE product_id=$product_number";
		$result = mysql_query($update_product);
		if (!$result) {
			die('Invalid query: ' . mysql_error());
		}
	}
	
}

?>