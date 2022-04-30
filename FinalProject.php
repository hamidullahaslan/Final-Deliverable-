<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  
<h2>Watch for your entry in the Result!</h2>
<?php
$servername = "ecs-pd-proj-db.ecs.csus.edu";
$username = "CSC174106";
$password = "Csc134_120400539";
$dbname = "CSC174106";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Inserting data into the database using prepared statement.
$stmt = $conn->prepare("INSERT INTO USER_INFO (user_id, name, type, ad_watch_time) 
	VALUES (?, ?, ?, ?)");

$stmt->bind_param("issi", $user_id, $name, $type, $adWatchTime); 

$user_id = $_POST["user_id"];
$name = $_POST["name"];
$type = $_POST["type"];
$adWatchTime = $_POST["ad-watch-time"];

$stmt->execute();


//Display content of the table
$sql = "SELECT user_id, name, type, ad_watch_time FROM USER_INFO
	WHERE type = 'FREE_USER'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	echo '<pre>';
        echo "<br> User_ID: ". $row["user_id"]. "	Name: ". $row["name"]. "	User_Type: ".$row["type"]. "	Ad-Watch-Time: ".$row["ad_watch_time"]. "<br>";
	echo '</pre>';
    }
} else {
    echo "0 results";
}

$conn->close();

?>

</body>
</html>