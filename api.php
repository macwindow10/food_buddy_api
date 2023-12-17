<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: POST");
//ßheader("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include('connection.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];


if ($requestMethod == "GET") {
	if(isset($_GET['action']) && $_GET['action']!='')
	{
		if($_GET['action'] == "login")
		{
			if ((isset($_GET['username']) && $_GET['username']!="") && (isset($_GET['password']) && $_GET['password']!="")) {
				$username = $_GET['username'];
				$password = $_GET['password'];
				$password = hash('sha256', $password);
				$query = "SELECT * FROM `users` WHERE username='$username' AND password='$password'";
				$result = mysqli_query($con, $query);
				if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
				{
					$userData['id'] = $row['id'];
					$userData['username'] = $row['username'];
					//$userData['password'] = $row['password'];
					$userData['name'] = $row['name'];
					$userData['address'] = $row['address'];
					$userData['mobile'] = $row['mobile'];
					$userData['user_type'] = $row['user_type'];

					$response["status"] = "true";
					$response["message"] = "User Details";
					$response["users"] = $userData;
				} else {
					$response["status"] = "true";
					$response["message"] = "Login failed";
				}
			}
			else{
				$response["status"] = "false";
				$response["message"] = "No user(s) found!";
			}
		}
		else if($_GET['action'] == "signup")
		{
			if ((isset($_GET['username']) && $_GET['username']!="") && 
				(isset($_GET['password']) && $_GET['password']!="") && 
				(isset($_GET['name']) && $_GET['name']!="") && 
				(isset($_GET['mobile']) && $_GET['mobile']!="") && 
				(isset($_GET['address']) && $_GET['address']!="")) 
			{
				$username = $_GET['username'];
				$password = $_GET['password'];
				echo $password;
				$password = hash('sha256', $password);
				echo $password;
				$name = $_GET['name'];
				$mobile = $_GET['mobile'];
				$address = $_GET['address'];
				$user_type = $_GET['user_type'];
				$query = "SELECT * FROM `users` WHERE username='$username'";
				$result = mysqli_query($con, $query);
				if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
				{
					echo "user already exists";
					$response["status"] = "true";
					$response["message"] = "Username already exists";
				} else {
					echo "new user";
					$query = "INSERT INTO `users` (username, password, name, mobile, address, user_type) VALUES('$username', '$password', '$name', '$mobile', '$address', '$user_type')";
					echo $query;
					if(mysqli_query($con, $query)) {
						$response["status"] = "true";
						$response["message"] = "User created";
					} else{
						$response["status"] = "true";
						$response["message"] = "Error in creating user";
					}
				}
			}
			else{
				$response["status"] = "false";
				$response["message"] = "Error in creating user";
			}
		}
		else if($_GET['action'] == "get_restaurants")
		{
			$data = array();
			if (isset($_GET['name'])) {
				$name = $_GET['name'];
				if ($name == "") {
					$query = "SELECT * FROM `restaurant`";
				} else {
					$query = "SELECT * FROM `restaurant`";
				}
				$result = mysqli_query($con, $query);
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
				{
					$userData['id'] = $row['id'];
					$userData['name'] = $row['name'];
					$userData['contact_number'] = $row['contact_number'];
					$userData['address'] = $row['address'];
					$userData['city'] = $row['city'];
					$userData['restaurant_type'] = $row['restaurant_type'];
					$userData['rating'] = $row['rating'];
					$userData['image_filename'] = $row['image_filename'];

					$data[]=array("id"=>$row['id'],"name"=>$row['name'],
						"contact_number"=>$row['contact_number'],
						"address"=>$row['address'],
						"city"=>$row['city'],
						"restaurant_type"=>$row['restaurant_type'],
						"rating"=>$row['rating'],
						"image_filename"=>$row['image_filename']);
				} 
				$response["status"] = "true";
				$response["message"] = "No quote found";
				$response["restaurants"] = $data;
			}
			else{
				$response["status"] = "false";
				$response["message"] = "No restaurant found";
				$response["restaurants"] = $data;
			}
		}
		else if($_GET['action'] == "get_menus")
		{
			$data = array();
			if (isset($_GET['restaurant_id'])) {
				$restaurant_id = $_GET['restaurant_id'];
				$query = "SELECT * FROM `menu` WHERE restaurant_id=$restaurant_id";
				$result = mysqli_query($con, $query);
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
				{
					$userData['id'] = $row['id'];
					$userData['name'] = $row['name'];
					$userData['description'] = $row['description'];
					$userData['preparation_time'] = $row['preparation_time'];
					$userData['price'] = $row['price'];
					$userData['image_filename'] = $row['image_filename'];

					$data[]=array("id"=>$row['id'],
						"name"=>$row['name'],
						"description"=>$row['description'],
						"preparation_time"=>$row['preparation_time'],
						"price"=>$row['price'],
						"image_filename"=>$row['image_filename']);
				} 
				$response["status"] = "true";
				$response["message"] = "No quote found";
				$response["menus"] = $data;
			}
			else{
				$response["status"] = "false";
				$response["message"] = "No restaurant found";
				$response["menus"] = $data;
			}
		}
		else if($_GET['action'] == "place_order")
		{
			if ((isset($_GET['menu_id']) && $_GET['menu_id']!="") && 
				(isset($_GET['user_id']) && $_GET['user_id']!="") && 
				(isset($_GET['date_time']) && $_GET['date_time']!="") && 
				(isset($_GET['preparation_instructions']) && $_GET['preparation_instructions']!="") && 
				(isset($_GET['special_dietary_requirements']) && $_GET['special_dietary_requirements']!="") &&
				(isset($_GET['any_allergy']) && $_GET['any_allergy']!="") && 
				(isset($_GET['order_status']) && $_GET['order_status']!="") && 
				(isset($_GET['price']) && $_GET['price']!="")) 
			{
				$menu_id = $_GET['menu_id'];
				$user_id = $_GET['user_id'];
				$date_time = $_GET['date_time'];
				$preparation_instructions = $_GET['preparation_instructions'];
				$special_dietary_requirements = $_GET['special_dietary_requirements'];
				$any_allergy = $_GET['any_allergy'];
				$order_status = $_GET['order_status'];
				$price = $_GET['price'];
				
				$query = "INSERT INTO `order` (date_time, menu_id, ingredients, preparation_instructions, user_id, order_status, special_dietary_requirements, any_allergy, price) VALUES('$date_time', '$menu_id', '', '$preparation_instructions', '$user_id', '$order_status', '$special_dietary_requirements', '$any_allergy', '$price')";
				if(mysqli_query($con, $query)) {
					$response["status"] = "true";
					$response["message"] = "Order placed";

					// insert default location
					$order_id = mysqli_insert_id($con);
					$query = "INSERT INTO `order_location` (order_id, latitude, longitude) VALUES('$order_id', '31.553', '74.332')";
					if(mysqli_query($con, $query)) {
						$response["status"] = "true";
						$response["message"] = "Order placed";
					}

				} else{
					$response["status"] = "false";
					$response["message"] = "Error in order placing 2";
					$response["query"] = $query;
				}
			}
			else{
				$response["status"] = "false";
				$response["message"] = "Error in order placing 1";
			}
		}
		else if($_GET['action'] == "get_orders")
		{
			$data = array();
			if (isset($_GET['user_id'])) {
				$user_id = $_GET['user_id'];
				
				$query = "SELECT o.id, o.date_time, o.order_status, o.is_feedback_given, m.id menu_id, m.name menu_name, ifnull(ol.latitude, 33.00) latitude, ifnull(ol.longitude, 73.00) longitude
					FROM `order` o LEFT JOIN `menu` m ON o.menu_id=m.id 
					LEFT OUTER JOIN `order_location` ol ON o.id=ol.order_id WHERE o.user_id='$user_id' AND o.order_status>0";
				
				$result = mysqli_query($con, $query);
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
				{
					$userData['id'] = $row['id'];
					$userData['date_time'] = $row['date_time'];
					$userData['order_status'] = $row['order_status'];
					$userData['menu_id'] = $row['menu_id'];
					$userData['menu_name'] = $row['menu_name'];
					$userData['latitude'] = $row['latitude'];
					$userData['longitude'] = $row['longitude'];
					$userData['is_feedback_given'] = $row['is_feedback_given'];
					
					$data[]=array("id"=>$row['id'],
						"date_time"=>$row['date_time'],
						"order_status"=>$row['order_status'],
						"menu_id"=>$row['menu_id'],
						"menu_name"=>$row['menu_name'],
						"latitude"=>$row['latitude'],
						"longitude"=>$row['longitude'],
						"is_feedback_given"=>$row['is_feedback_given']
					);
				} 
				$response["status"] = "true";
				$response["message"] = "Order(s) found";
				$response["orders"] = $data;
			}
			else{
				$response["status"] = "false";
				$response["message"] = "No order found";
				$response["orders"] = $data;
			}
		}
		else if($_GET['action'] == "get_order_location")
		{
			$data = array();
			if (isset($_GET['order_id'])) {

				$order_id = $_GET['order_id'];
				$query = "SELECT latitude, longitude
					FROM `order_location`
					WHERE order_id='$order_id'";
				
				$result = mysqli_query($con, $query);
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
				{
					$userData['latitude'] = $row['latitude'];
					$userData['longitude'] = $row['longitude'];
					
					$data[]=array("latitude"=>$row['latitude'],
						"longitude"=>$row['longitude']);
				} 
				$response["status"] = "true";
				$response["message"] = "Order location found";
				$response["order_location"] = $data;
			}
			else{
				$response["status"] = "false";
				$response["message"] = "No order location found";
				$response["order_location"] = $data;
			}
		}
		else if($_GET['action'] == "update_order_status")
		{
			$data = array();
			if (isset($_GET['order_id']) && isset($_GET['order_status'])) {

				$order_status = $_GET['order_status'];
				$order_id = $_GET['order_id'];
				$query = "UPDATE `order`
					SET order_status='$order_status'
					WHERE order_id='$order_id'";
				
				$result = mysqli_query($con, $query);
				
				$response["status"] = "true";
				$response["message"] = "Order status updated";
			}
			else{
				$response["status"] = "false";
				$response["message"] = "Order status could not update";
			}
		}
		else 
		{
			$response["status"] = "false";
			$response["message"] = "Action not provided";
		}
	}
}
else if ($requestMethod == "POST") {
	// echo "POST action";
	$data = json_decode(file_get_contents("php://input"));
	// echo($data->action);
	if($data->action == "signup") {
		// echo "====";
		if (($data->username != "") && 
			($data->password != "") && 
			($data->name != "") && 
			($data->mobile != "") && 
			($data->address != "")) 
		{
			$username = $data->username;
			$password = $data->password;
			// echo $password;
			$password = hash('sha256', $password);
			// echo $password;
			$name = $data->name;
			$mobile = $data->mobile;
			$address = $data->address;
			$user_type = $data->user_type;
			$query = "SELECT * FROM `users` WHERE username='$username'";
			$result = mysqli_query($con, $query);
			if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				// echo "user already exists";
				$response["status"] = "true";
				$response["message"] = "Username already exists";
			} else {
				// echo "new user";
				$query = "INSERT INTO `users` (username, password, name, mobile, address, user_type) VALUES('$username', '$password', '$name', '$mobile', '$address', '$user_type')";
				// echo $query;
				if(mysqli_query($con, $query)) {
					$response["status"] = "true";
					$response["message"] = "User created";
				} else{
					$response["status"] = "true";
					$response["message"] = "Error in creating user";
				}
			}
		}
		else{
			$response["status"] = "false";
			$response["message"] = "Error in creating user";
		}
	}
	else if($data->action == "add_restaurant")
	{
		if (($data->user_id!="") &&
			($data->name!="") && 
			($data->contact_number!="") && 
			($data->address!="") && 
			($data->city!="") && 
			($data->restaurant_type!="")) 
		{
			$user_id = $data->user_id;
			$name = $data->name;
			$contact_number = $data->contact_number;
			$city = $data->city;
			$address = $data->address;
			$restaurant_type = $data->restaurant_type;
			$query = "SELECT * FROM `restaurant` WHERE name='$name'";
			$result = mysqli_query($con, $query);
			if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$response["status"] = "false";
				$response["message"] = "Restaurant already exists";
			} else {
				$query = "INSERT INTO `restaurant` (user_id, name, contact_number, address, city, restaurant_type, rating, image_filename) VALUES('$user_id', '$name', '$contact_number', '$address', '$city', '$restaurant_type', '1', '')";
				// echo $query;
				if(mysqli_query($con, $query)) {
					$response["status"] = "true";
					$response["message"] = "Restaurant created";
				} else{
					$response["status"] = "false";
					$response["message"] = "Error in creating restaurant";
				}
			}
		}
		else{
			$response["status"] = "false";
			$response["message"] = "Error in creating restaurant";
		}
	}
	else if($data->action == "add_menu")
	{
		if (($data->user_id!="") &&
			($data->restaurant_id!="") && 
			($data->name!="") && 
			($data->description!="") && 
			($data->preparation_time!="") && 
			($data->price!="")) 
		{
			$user_id = $data->user_id;
			$restaurant_id = $data->restaurant_id;
			$name = $data->name;
			$description = $data->description;
			$preparation_time = $data->preparation_time;
			$price = $data->price;
			
			$query = "SELECT * FROM `menu` WHERE name='$name' AND restaurant_id='$restaurant_id'";
			$result = mysqli_query($con, $query);
			if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$response["status"] = "false";
				$response["message"] = "Menu already exists in restaurant";
			} else {
				$query = "INSERT INTO `menu` (name, description, preparation_time, price, image_filename, restaurant_id) VALUES('$name', '$description', '$preparation_time', '$price', 'menu.jpg', '$restaurant_id')";
				// echo $query;
				if(mysqli_query($con, $query)) {
					$response["status"] = "true";
					$response["message"] = "Menu created";
				} else{
					$response["status"] = "false";
					$response["message"] = "Error in creating menu";
				}
			}
		}
		else {
			$response["status"] = "false";
			$response["message"] = "Error in creating menu";
		}
	}
	else if($data->action == "order_feedback")
	{
		if (($data->menu_id!="") &&
			($data->order_id!="") &&
			($data->feedback!="") && 
			($data->restaurant_rating!="") && 
			($data->delivery_rating!="") && 
			($data->overall_rating!="")) 
		{
			$menu_id = $data->menu_id;
			$order_id = $data->order_id;
			$feedback = $data->feedback;
			$restaurant_rating = $data->restaurant_rating;
			$delivery_rating = $data->delivery_rating;
			$overall_rating = $data->overall_rating;
			
			$query = "SELECT id FROM `menu` WHERE id='$menu_id'";
			$result1 = mysqli_query($con, $query);
			$restaurant_id = 0;
			while ($row = mysqli_fetch_array($result1, MYSQLI_ASSOC))
			{
				$restaurant_id = $row['id'];
			} 

			$query = "INSERT INTO `restaurant_reviews` (restaurant_id, feedback, rating, delivery_service, overall_experience) VALUES('$restaurant_id', '$feedback', '$restaurant_rating', '$delivery_rating', '$overall_rating')";
			// echo $query;
			if(mysqli_query($con, $query)) {
				$response["status"] = "true";
				$response["message"] = "Restaurant review created";
			} else{
				$response["status"] = "false";
				$response["message"] = "Error in creating restaurant review";
			}
		}
		else {
			$response["status"] = "false";
			$response["message"] = "Error in creating restaurant review";
		}
	}
}
else {
	$response["status"] = "false";
	$response["message"] = "Action not provided";
}
echo json_encode($response); exit;
 
?>