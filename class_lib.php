<?php

class random_product {
	var $color;
	var $clothes;
	var $clothes_array;
	
	function randomize_product() {
		$color = array("Red","Blue","Green","Orange","Purple","Teal","Black","White","Pink","Brown");
		$clothes = array("Hat","Shirt","Jacket","Pants","Socks","Sneakers","Sandals","Gloves","Shorts","Boots");
		$clothes_array = array();
		for ($i=0; $i<10; $i++) {
			$random_color = $color[rand(0,9)];
			$random_clothes = $clothes[rand(0,9)];
			$clothes_array[$i] = $random_color . " " . $random_clothes;
		}
		return $clothes_array;
	}

}

class generate_orders{

	function make_order(){
		$order = array();
		for($i=0; $i<20; $i++){
			$order_number = ($i+2)*rand(1,25);
			$number_products = rand(1,5);
			$random_product = rand(0,9);
			$quantity = rand (1,100);
			$order[$i] = $order_number . "," . $random_product . "," .  $quantity;
		}
		return $order;
	}

}

?>