<?php
$host = 'localhost';
$username = 'root';
$password = 'password';
$database = 'my_database';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
} catch (PDOException $e) {
  echo 'Connection failed: ' . $e->getMessage();
  exit;
} 

$name = $_POST['name'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];

$sql = "INSERT INTO details (name, gender, dob, email, phone_number) VALUES (:name, :gender, :dob, :email, :phone_number)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':gender', $gender);
$stmt->bindParam(':dob', $dob);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':phone_number', $phone_number);
$stmt->execute();

$sql = "SELECT * FROM details";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll();

foreach ($results as $result) {
  echo $result['name'] . ' - ' . $result['gender'] . ' - ' . $result['dob'] . ' - ' . $result['email'] . ' - ' . $result['phone_number'] . '<br>';
}
?>

