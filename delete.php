<?php
session_start();
require 'mbconn.php';

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    echo "<script>alert('You must log in to access this page.');</script>";
    echo "<script>window.location.href = 'login.php';</script>";
    exit();
}

$user_id = $_SESSION["user_id"]; // Logged-in user's ID

// Check if the room ID is provided
if (isset($_GET['id'])) {
    $room_id = $_GET['id'];

    // Fetch the room details to verify ownership and get the image path
    $stmt = $conn->prepare("SELECT * FROM room_data WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $room_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $room = $result->fetch_assoc();
        $image_path = $room['image_path'];

        // Delete the room from the database
        $stmt = $conn->prepare("DELETE FROM room_data WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $room_id, $user_id);

        if ($stmt->execute()) {
            // Delete the image file from the server
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            echo "<script>alert('Room deleted successfully.');</script>";
            echo "<script>window.location.href = 'mainbody.php#myroomsMode';</script>";
                } else {
            echo "<script>alert('Error deleting room.');</script>";
        }
    } else {
        echo "<script>alert('Room not found or you do not have permission to delete it.');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
    }
} else {
    echo "<script>alert('No room ID provided.');</script>";
    echo "<script>window.location.href = 'index.php';</script>";
}
?>