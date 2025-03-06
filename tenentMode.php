<?php
require 'mbconn.php'; // Include database connection

// Fetch all rooms
$query = "SELECT * FROM room_data";
$result = mysqli_query($conn, $query);

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
    <title>Room Listings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Global Styles */
        /* Make the header fixed */
       /* Style for Header */
/* Header Styling */
header {
    background: #2c3e50;
    color: white;
    display: flex;
    align-items: center;
    justify-content: space-between; /* Ensures left and center alignment */
    padding: 15px 40px;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
    height: 90px;
}

/* Ensure the text (h1 and p) stays centered */
.header-text {
    text-align: center;
    flex-grow: 1; /* Ensures it stays in the center */
}


.search-container {
    display: flex;
    align-items: center;
    background: white;
    border-radius: 30px;
    padding: 5px 15px;
    width: 300px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    position: absolute;
    left: 150px;
}

/* Search Input */
#search-box {
    border: none;
    outline: none;
    padding: 8px;
    font-size: 16px;
    width: 100%;
    border-radius: 30px;
}

/* Search Button */
#search-btn {
    background: #007bff;
    color: white;
    border: none;
    padding: 8px 12px;
    cursor: pointer;
    border-radius: 50%;
    transition: background 0.3s ease;
}

#search-btn:hover {
    background: #0056b3;
}

/* Search Icon */
#search-btn i {
    font-size: 18px;
}

/* Responsive Styling */
@media (max-width: 768px) {
    header {
        flex-direction: column;
        height: auto;
        padding: 15px;
    }

    .search-container {
        width: 90%;
        margin-top: 10px;
        position: static;
    }

    .header-text {
        margin-top: 10px;
    }
}



        h1 {
            margin-top: -5px;
            margin-bottom: -10px;
        }

        /* Ensure the body does not go under the header */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: rgb(200, 219, 238);
            width: 100%;
            height: 100%;
        }

        /* Add padding to prevent content from being hidden under the fixed header */
        .room-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: stretch; /* Ensures all items stretch to the same height */
    padding: 20px;
    margin-top: 100px;
    height: calc(100vh - 120px);
    overflow-y: auto;
    gap: 20px; /* Adds space between cards */
}



        /* Room Card */
        .room-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    overflow: hidden;
    margin: 15px;
    width: 300px;
    height: 420px; /* Set a fixed height */
    transition: transform 0.3s;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Keeps elements evenly distributed */
}


        .room-card:hover {
            transform: scale(1.05);
        }

        /* Room Image */
        .room-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        /* Room Info */
        .room-info {
    padding: 30px;
    flex-grow: 1; /* Ensures consistent height */
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Makes content evenly spaced */
}


        .room-info h3 {
            margin: 0;
            font-size: 1.2em;
            color: #333;
            text-decoration: underline;
            color: red;
            font-weight: weight;
        }

        .room-info p {
            color: #777;
            font-size: 0.9em;
        }

        /* Room Details Section */
        .room-details {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 800px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            display: flex;
            flex-direction: row;
            overflow: hidden;
            z-index: 1001;

        }

        .room-details .image-box {
            width: 50%;
            height: 100%;
            overflow: hidden;
        }

        .room-details img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .details-box {
            padding: 20px;
            text-align: left;
            width: 50%;
        }

        .details-box h3 {
            font-size: 1.5em;
            color: #333;
        }

        .details-box p {
            font-size: 1em;
            margin: 10px 0;
            color: #555;
        }

        .close-btn {
            background: red;
            color: white;
            padding: 8px;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }

        #roomTitle {
            color: red;
            text-decoration: underline;
        }

        .search_form {
            position: absolute;
            left: 3rem;
            margin-left: -100px;
        }

        /* Back Button Container */
.back-container {
    display: flex;
    justify-content: flex-start; /* Align to the left */
    padding: 10px 20px;
    position: absolute;
    top: 30px; /* Adjusted to sit above the room cards */
    left: 20px;
    z-index: 1100;
}

/* Back Button Styling */
#back-btn {
    background: #ff4444; /* Attractive red */
    color: white;
    border: none;
    padding: 10px 18px;
    font-size: 16px;
    border-radius: 30px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px; /* Space between icon and text */
    transition: background 0.3s ease;
}

#back-btn i {
    font-size: 18px;
}

/* Hover effect */
#back-btn:hover {
    background: #cc0000;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .back-container {
        top: 120px; /* Adjust for smaller screens */
    }

    #back-btn {
        font-size: 14px;
        padding: 8px 14px;
    }
}

    </style>
</head>

<body>

<!-- Back Button (Keep it outside header) -->
<div class="back-container">
    <button id="back-btn" onclick="goBack()">
        <i class="fas fa-arrow-left"></i> Back
    </button>
</div>

<header>
    <!-- Search Bar -->
    <div class="search-container">
        <input type="search" id="search-box" placeholder="Search for rooms..." onkeyup="search()">
        <button id="search-btn"><i class="fas fa-search"></i></button>
    </div>

    <div class="header-text">
        <h1>Find Your Perfect Room <i class="fas fa-search"></i></h1>
        <p>Explore the best rental rooms available</p>
    </div>
</header>



    <!-- Room Cards Container -->
    <div id="roomContainer" class="room-container"></div>

    <!-- Room Details Section -->
    <div id="roomDetails" class="room-details" style="display:none;">
        <div class="image-box">
            <img id="roomImage" src="" alt="Room Image">
        </div>
        <div class="details-box">
            <h3 id="roomTitle"><b></b></h3>
            <p><strong>Rate:</strong> <span id="roomRate"></span> per month</p>
            <p><strong>Location:</strong> <span id="roomLocation"></span></p>
            <p><strong>Contact:</strong> <span id="roomContact"></span></p>
            <p><strong>Description:</strong> <span id="roomDescription"></span></p>
            <button id="closeBtn" class="close-btn">Close</button>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
    let rooms = <?php echo $rooms_json; ?>;
    const roomContainer = document.getElementById("roomContainer");
    const roomDetails = document.getElementById("roomDetails");

    const roomImage = document.getElementById("roomImage");
    const roomTitle = document.getElementById("roomTitle");
    const roomRate = document.getElementById("roomRate");
    const roomLocation = document.getElementById("roomLocation");
    const roomContact = document.getElementById("roomContact");
    const roomDescription = document.getElementById("roomDescription");

    // Populate room cards correctly
    rooms.forEach(room => {
        let card = document.createElement("div");
        card.classList.add("room-card");
        card.innerHTML = `
            <img src="${room.image_path}" alt="Room Image">
            <div class="room-info">
                <h3 class="room-title">${room.Description}</h3>
                <p><strong>Rate:</strong> ${room.Rate} per month</p>
                <p class="room-location"><strong>Location:</strong> ${room.Address}</p>
                <button class="details-btn" data-id="${room.id}">View Details</button>
            </div>
        `;
        roomContainer.appendChild(card);

        // Show room details on click
        card.querySelector(".details-btn").addEventListener("click", function () {
            roomImage.src = room.image_path;
            roomTitle.innerText = room.Description;
            roomRate.innerText = room.Rate;
            roomLocation.innerText = room.Address;
            roomContact.innerText = room.Contact;
            roomDescription.innerText = room.Description;

            roomDetails.style.display = "flex";
        });
    });

    // Close button functionality
    document.getElementById("closeBtn").addEventListener("click", function () {
        roomDetails.style.display = "none";
    });
});



function search() {
    let filter = document.getElementById('search-box').value.toUpperCase();
    let roomCards = document.querySelectorAll('.room-card');

    roomCards.forEach(card => {
        let title = card.querySelector('.room-title').innerText.toUpperCase();
        let location = card.querySelector('.room-location').innerText.toUpperCase();

        if (title.includes(filter) || location.includes(filter)) {
            card.style.display = "flex"; /* Instead of "block", keeps flex properties */
        } else {
            card.style.display = "none";
        }
    });
}


function goBack() {
    if (document.referrer.includes("mainbody.php")) {
        window.location.href = "mainbody.php"; // Redirect to main page
    } else {
        window.history.back(); // Go back normally
    }
}





    </script>

</body>

</html>