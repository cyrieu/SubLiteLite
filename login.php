<?php
include "functions.php";

$session_start(); //start session 
$error = ""; //to store errors 

if (isset($_POST['submit'])){
	if (empty($_POST['username']) || empty($_POST['password'])){
		$error = "Username or Password is invalid";
	} else {
		//Posted the login form

		//clean input
		$username = clean($_POST['username']);
		$password = clean($_POST['password']);

		//get instance of database
		$db = MongoSingleton::getMongoCon();
		$users = $db->users;

		//check if user is in Mongo Datbase
		$salt = "sublite";
		$userQuery = array(
			'username' => $username,
			'password' => crypt($password,$salt));
		$cursor = $users->find($userQuery);
		if ($cursor->count() > 0){
			//Found a user
			$_SESSION['username'] = $username; //initialize session variable
			header("location: profile.php");

		} else {
			//No user in database
			//redirect to registration page
			header("location: register.php");
		}
	}
}


?>