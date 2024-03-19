<?php
// Retrieve the form data
$employeeID = $_POST['employeeID'];
$dayOfWeek = $_POST['dayOfWeek'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];

// Prepare and execute the SQL statement
$stmt = $conn->prepare("INSERT INTO availability (EmployeeID, DayOfWeek, StartTime, EndTime) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $employeeID, $dayOfWeek, $startTime, $endTime);

if ($stmt->execute()) {
    echo "Data saved successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>