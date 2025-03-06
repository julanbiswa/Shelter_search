<?php

require 'mbconn.php';
error_reporting(0);


$id = $_GET['id'];


    
// Fetch rooms for the logged-in user
$fetchQuery = "SELECT * FROM room_data WHERE id = {$id}";
$result = mysqli_query($conn, $fetchQuery);

// $total = mysqli_num_rows($result);

$row = mysqli_fetch_assoc($result);
// print_r($row);

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
   
    <!-- Owner area for adding room details  -->

    <div id="uploadDetails" class="mode">
        <h2 id="formH">Upadte Your Room Details.</h2>
        <form id="ownerForm" class="myForm" method="POST" action="#" autocomplete="off" enctype="multipart/form-data"
            onsubmit="return validate()">

            <label for="roomImage">Upload Room Images:</label>
<input type="file" id="roomImage" name="uploadimg" accept="image/*" onchange="previewImage(event)">
<br>
<!-- Display current image -->
<img id="currentImage" src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="Current Image" style="width: 100px; height: 100px; margin-top: 10px;">

            <label for="Title">Title Here:</label>
            <input type="test" id="title" name="title" value="<?php echo htmlspecialchars($row['Title']); ?>"><br>
            <label for="rate">Rate (per month):</label>
            <input type="number" id="rate" value="<?php echo htmlspecialchars($row['Rate']); ?>" name="rate"><br>
            <label for="contact">Contact Number:</label>
            <input type="text" id="number" value="<?php echo htmlspecialchars($row['Contact']);?>" name="contact"><br>
            <label for="address">Address:</label>
            <input type="text" id="address" value="<?php echo htmlspecialchars($row['Address']); ?>" name="address"><br>
            <label for="description">Description:</label>
            <textarea name="description" id="descriptionBox"><?php echo htmlspecialchars($row['Description']);?></textarea>


            <button type="submit" name="Update">Update Details</button>
        </form>
    </div>


    <script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('currentImage');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>



</body>

</html>

<?php 


// Handle Room Submission
if (isset($_POST["Update"])) {

    $title = $_POST["title"];
    $rate = $_POST["rate"];
    $contact = $_POST["contact"];
    $address = $_POST["address"];
    $description = $_POST["description"];

    // Handle file upload
    $filename = $_FILES["uploadimg"]["name"];
    $tempname = $_FILES["uploadimg"]["tmp_name"];
    
    if (!empty($filename)) { 
        // If a new image is selected, update it
        $folder = "images/" . $filename;
        move_uploaded_file($tempname, $folder);
        $query = "UPDATE room_data SET Title='$title', Rate='$rate', Contact='$contact', Address='$address', Description='$description', image_path='$folder' WHERE id='$id'";
    } else {
        // If no new image is selected, do not update image_path
        $query = "UPDATE room_data SET Title='$title', Rate='$rate', Contact='$contact', Address='$address', Description='$description' WHERE id='$id'";
    }
    
    $data = mysqli_query($conn, $query);
    
    if($data){
        echo "Record Updated";
    } else {
        echo "Failed to update.";
    }
}
    
?>