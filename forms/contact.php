<?php
if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    // Capture form inputs
    $userName = $_POST['userName'];
    $userEmail = $_POST['userEmail'];
    $userPhone = $_POST['userPhone'];
    $userMessage = $_POST['userMessage'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'delicious');
    
    // Check if the connection failed
    if($conn->connect_error){
        die("Connection Failed: " . $conn->connect_error);
    } else {
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO restaurent (userName, userEmail, userPhone, userMessage) VALUES (?, ?, ?, ?)");

        // Check if the statement was prepared successfully
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        // Bind parameters (s for string, i for integer)
        $stmt->bind_param("ssis", $userName, $userEmail, $userPhone, $userMessage);

        // Execute the query
        if ($stmt->execute()) {
            echo "OK";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>
