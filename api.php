<?php
 
header("Content-Type:application/json");
include('connection.php');

if(isset($_GET['action']) && $_GET['action']!='')
{
	if($_GET['action'] == "login")
	{
		if ((isset($_GET['username']) && $_GET['username']!="") && (isset($_GET['password']) && $_GET['password']!="")) {
			$username = $_GET['username'];
			$password = $_GET['password'];
			$query = "SELECT * FROM `users` WHERE username='$username' AND password='$password'";
			$result = mysqli_query($con, $query);
			if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$userData['id'] = $row['id'];
				$userData['username'] = $row['username'];
				$userData['password'] = $row['password'];
				$userData['name'] = $row['name'];
				$userData['cnic'] = $row['cnic'];

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
		if ((isset($_GET['username']) && $_GET['username']!="") && (isset($_GET['password']) && $_GET['password']!="") && (isset($_GET['name']) && $_GET['name']!="") && (isset($_GET['cnic']) && $_GET['cnic']!="") && (isset($_GET['address']) && $_GET['address']!="")) 
		{
			$username = $_GET['username'];
			$password = $_GET['password'];
			$name = $_GET['name'];
			$cnic = $_GET['cnic'];
			$address = $_GET['address'];
			$query = "SELECT * FROM `users` WHERE username='$username'";
			$result = mysqli_query($con, $query);
			if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$response["status"] = "true";
				$response["message"] = "Username already exists";
			} else {
				$query = "INSERT INTO `users` (username, password, name, cnic, address) VALUES('$username', '$password', '$name', '$cnic', '$address')";
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
	}
} else {
	$response["status"] = "false";
	$response["message"] = "Action not provided";
}
echo json_encode($response); exit;
 
?>