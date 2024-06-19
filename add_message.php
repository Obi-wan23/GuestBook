<?php
session_start();
require 'config.php';


$username = $_POST['username'];
$email = $_POST['email'];
$message = strip_tags($_POST['message']);
$ip_address = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];

if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
	die("Invalid username");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	die("Invalid email");
}

if (empty($message)) {
	die("Message cannot be empty");
}

$sql = "INSERT INTO messages (username, email, message, ip_address, user_agent) VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$username, $email, $message, $ip_address, $user_agent]);

header("Location: index.php");
exit;
