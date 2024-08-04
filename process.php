<?php
require __DIR__ . '/vendor/autoload.php';

// Database connection
$servername = "localhost"; // Replace with your server name
$username = "root";        // Replace with your database username
$password = "";            // Replace with your database password
$dbname = "php_chat"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pusher setup
$app_id = '';
$app_key = '';
$app_secret = '';
$app_cluster = 'ap2';

$pusher = new Pusher\Pusher($app_key, $app_secret, $app_id, ['cluster' => $app_cluster]);

// Fetch POST data
$fname = $_POST['fname'];
$lname = $_POST['lname'];

// Store data in the database
$sql = "INSERT INTO messages (fname, lname) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $fname, $lname);

if ($stmt->execute()) {
    // Data stored successfully, trigger Pusher event
    $id = $stmt->insert_id;
    $data = array(
        'id' => $id,
        'fname' => $fname,
        'lname' => $lname
    );

    $pusher->trigger('chat','2', $data); //1 is dynamic id
    echo "success";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
