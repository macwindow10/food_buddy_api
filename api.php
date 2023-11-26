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
		else 
		{
			$response["status"] = "false";
			$response["message"] = "Action not provided";
		}
	}
}
else if ($requestMethod == "POST") {
	echo "POST action";
	$data = json_decode(file_get_contents("php://input"));
	echo($data->action);
	if($data->action == "signup") {
		echo "====";
		if (($data->username != "") && 
			($data->password != "") && 
			($data->name != "") && 
			($data->mobile != "") && 
			($data->address != "")) 
		{
			$username = $data->username;
			$password = $data->password;
			echo $password;
			$password = hash('sha256', $password);
			echo $password;
			$name = $data->name;
			$mobile = $data->mobile;
			$address = $data->address;
			$user_type = $data->user_type;
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
}
else {
	$response["status"] = "false";
	$response["message"] = "Action not provided";
}
echo json_encode($response); exit;
 
?>