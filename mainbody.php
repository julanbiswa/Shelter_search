<?php
session_start();
require 'mbconn.php';
// error_reporting(0);

// Redirect if user is not logged in
if (!isset($_SESSION["user_id"])) {
    echo "<script>alert('You must log in to access this page.');</script>";
    echo "<script>window.location.href = 'login.php';</script>";
    exit();
}

// var_dump($_SESSION["user_id"]);

$user_id = $_SESSION["user_id"]; // Logged-in user's ID


// echo "Logged-in User ID: " . htmlspecialchars($user_id);



// Handle Room Submission
if (isset($_POST["submit"])) {

    $title = $_POST["title"];
    $rate = $_POST["rate"];
    $contact = $_POST["contact"];
    $address = $_POST["address"];
    $description = $_POST["description"];

    // Handle file upload
    $filename = $_FILES["uploadimg"]["name"];
    $tempname = $_FILES["uploadimg"]["tmp_name"];
    $folder = "images/" . $filename;
    move_uploaded_file($tempname, $folder);

    // echo "<img src='$folder' height='80px' width='80px'>";

    // Insert room details into room_data table with user_id
    $query = "INSERT INTO room_data (user_id, Title, Rate, Contact, Address, Description, image_path) 
              VALUES ('$user_id','$title', '$rate', '$contact', '$address', '$description', '$folder')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Room Details Added Successfully!');</script>";
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }
}

// Fetch rooms for the logged-in user
$fetchQuery = "SELECT * FROM room_data WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $fetchQuery);

if (!$result) {
    die("Error fetching rooms: " . mysqli_error($conn)); // Display SQL error if the query fails
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shelter Search</title>
    <link rel="stylesheet" href="body.css">
</head>

<body>

    <!-- Back Button -->
<button id="backButton" onclick="goBack()" style="display: none;">Back</button>


    <!-- Shelter Search Application (Hidden until login) -->

    <header>

        <h1>Welcome to Shelter Search</h1>
        <p>Select your mode</p>
        <div id="modeButtons">
            <button id="ownerModeBtn">Owner Mode</button>
            <a href="tenentMode.php"><button>Tenant Mode</button></a>
            <!-- <button id="myroomsModeBtn">My rooms</button> -->
            <button id="logoutBtn">Logout</button>
        </div>
    </header>

    <div id="OwnerMode" class="OwnerMode" style="display: none;">


        <!-- after entering the owner mode -->
        <div class="titlehead" id="titlehead">
            <h1>Manage Your Rentals</h1>
        </div>

        <!-- this is upload button  -->



        <div class="bottom-section" id="buttonU">
            <button class="btn" id="UploadBtn">+ Upload Room Details</button>

        </div>



        <!-- This is the area of created rental rooms  -->

        <div id="myroomsMode" class="mode">


            <h2>My Uploaded Rooms</h2>
            <?php if (mysqli_num_rows($result) > 0): ?>
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
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td>
                                    <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="Room Image"
                                        style="width: 100px; height: 100px;">
                                </td>
                                <td><?php echo htmlspecialchars($row['Rate']); ?></td>
                                <td><?php echo htmlspecialchars($row['Contact']); ?></td>
                                <td><?php echo htmlspecialchars($row['Address']); ?></td>
                                <td class="description-cell" >
    <?php echo htmlspecialchars($row['Description']); ?>
</td>

                                <td>
                                    <a class="delete" href="delete.php?id=<?php echo htmlspecialchars($row['id']); ?>"
                                        onclick="return confirm('Are you sure you want to delete this room?');">Delete</a>

                                    <a class="update"
                                        href="update_details.php?id=<?php echo htmlspecialchars($row['id']);?>">Update</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No rooms uploaded yet.</p>
            <?php endif; ?>

            <!-- Second Div: Buttons Section -->

        </div>

    </div>




    <!-- Toggle Button and Menu -->
    <button id="menuToggleBtn" class="hamburger-menu">&#9776;</button>
    <div id="menu" class="menu" style="display: none;">

        <ul class="mainMenu">
            <li id="ownerModeMenuBtn"><span>Owner Mode</span></li>
            <a href="tenentMode.php">
                <li id="tenantModeMenuBtn"><span>Tenent Mode</span></li>
            </a>
            <!-- <li id="myroomsMenuBtn"><span>My rooms</span></li> -->
            <li id="logoutMenuBtn"><span>Logout</span></li>
        </ul>
    </div>

    <!-- Owner area for adding room details  -->

    <div id="uploadDetails" class="mode" style="display: none;">
        <h2 id="formH">Fill up your room details.</h2>
        <form id="ownerForm" class="myForm" method="POST" action="#" autocomplete="off" enctype="multipart/form-data"
            onsubmit="return validate()">

            <label for="roomImage">Upload Room Images:</label>
            <input type="file" id="roomImage" name="uploadimg" accept="image/*"><br>
            <label for="Title">Title Here:</label>
            <input type="test" id="title" name="title" maxlength="40"><br>
            <label for="rate">Rate (per month):</label>
            <input type="number" id="rate" name="rate" min="3000" max="20000"><br>
            <label for="contact">Contact Number:</label>
            <input type="text" id="number" name="contact" maxlength="13"><br>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" maxlength="50"><br>
            <label for="description">Description:</label>
            <textarea name="description" id="descriptionBox" maxlength="200"></textarea>


            <button type="submit" name="submit">Submit Room</button>
        </form>
    </div>


    <script src="bdyscript.js"></script>

</body>

</html>