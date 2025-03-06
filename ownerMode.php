<?php
// session_start();

require 'mbconn.php'; // Include database connection


// $user_id = $_SESSION["user_id"];

// Fetch all rooms
// $query = "SELECT * FROM room_data";
// $result = mysqli_query($conn, $query);

// Fetch rooms for the logged-in user
$query = "SELECT * FROM room_data WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching rooms: " . mysqli_error($conn)); // Display SQL error if the query fails
}

$rooms = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rooms[] = $row;
}

// Encode data as JSON for JavaScript use
$rooms_json = json_encode($rooms);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Mode - Manage Your Rentals</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('background2.jpg'); /* Gradient + Image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #fff;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: auto;
            padding-top: 50px;
        }
        h2 {
            font-size: 32px;
            margin-bottom: 20px;
        }
        .room-list {
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 15px;
            border-bottom: 1px solid #555;
            text-align: center;
        }
        th {
            background: rgba(255, 255, 255, 0.2);
        }
        img {
            width: 100px;
            height: 100px;
            border-radius: 5px;
        }
        .actions a {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            margin: 5px;
            display: inline-block;
        }
        .delete {
            background: red;
            color: #fff;
        }
        .update {
            background: orange;
            color: #fff;
        }
        .btn-container {
            margin-top: 20px;
        }
        .btn {
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            margin: 10px;
            border-radius: 5px;
        }
        .upload-btn {
            background: green;
            color: #fff;
        }
        .back-btn {
            background: gray;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Manage Your Rentals</h2>

    <div class="room-list">
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Room Image</th>
                        <th>Rate</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="Room Image"></td>
                            <td><?php echo htmlspecialchars($row['Rate']); ?></td>
                            <td><?php echo htmlspecialchars($row['Contact']); ?></td>
                            <td><?php echo htmlspecialchars($row['Address']); ?></td>
                            <td><?php echo htmlspecialchars($row['Description']); ?></td>
                            <td class="actions">
                                <a class="delete" href="delete.php?id=<?php echo htmlspecialchars($row['id']); ?>" onclick="return confirm('Are you sure you want to delete this room?');">Delete</a>
                                <a class="update" href="update_details.php?id=<?php echo htmlspecialchars($row['id']); ?>">Update</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No rooms uploaded yet.</p>
        <?php endif; ?>
    </div>

    <div class="btn-container">
        <button class="btn upload-btn" onclick="window.location.href='upload_room.php';">Upload Your Room</button>
        <button class="btn back-btn" onclick="window.history.back();">Back</button>
    </div>
</div>

</body>
</html>
