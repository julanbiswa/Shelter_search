<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shelter Search</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: linear-gradient(rgba(0, 0, 20, 0.5), rgba(0, 0, 20, 0.2)), url('background2.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            overflow-x: hidden;
        }

        .logo {
    position: absolute; /* Allows precise positioning */
    top: 20px; /* Adjust distance from the top */
    left: 20px; /* Adjust distance from the left */
    height: 100px; /* Set height */
    width: 250px; /* Set width */
    background-image: url('logo.png');
    background-size: 100%; /* Ensure the image covers the entire element */
    background-repeat: no-repeat; /* Prevent the image from repeating */
    filter: contrast(2.5);
    z-index: 10; /* Ensure it appears above other elements */
}

        .navbar {
            position: fixed;
            top: 0;
            right: 0;
            width: 40%;
            display: flex;
            justify-content: space-around;
            /* background-color: rgba(0, 0, 0, 0.8); */
            padding: 20px;
            z-index: 1000;
        }

        .navbar a {
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            border-radius: 15px;
            font-size: 16px;
            transition: background-color 0.3s ease, color 0.3s ease;
            cursor: pointer;
        }

        .navbar a:hover {
            background-color: white;
            color: black;
        }

        .nav-info {
            display: none;
            position: absolute;
            top: 60px;
            left: 70%;
            /* transform: translateX(-50%); */
            width: 90%;
            max-width: 300px;
            background-color: rgba(0, 0, 0, 0.9);
            color: white;
            padding: 15px;
            border-radius: 10px;
            /* text-align: center; */
            z-index: 1001;
            
        }

        #about{
            align-items: left;
            
        }

        .nav-info.active {
            display: block;
        }

        .main-content {
            margin-top: 100px;
            padding: 20px;
            text-align: left;
            color: white;
            width: 45%;
        }

        .main-content h2 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #FFD700;
        }

        .main-content p {
            font-size: 1.2em;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .main-content ul {
            text-align: left;
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="logo">

    </div>
    <!-- Navbar -->
    <div class="navbar">
        <a href="#" data-info="about">About Us</a>
        <a href="#" data-info="blog">Blog</a>
        <a href="#" data-info="suggestion">Suggestion</a>
        <a href="#" data-info="contact">Contact</a>
        <a href="login.php">Login</a>
    </div>

    <!-- Navigation Information -->
    <div id="about" class="nav-info">
        <h3>About Us</h3>
        <p>Shelter Search connects room seekers with property owners for direct and easy communication. We simplify the rental process with verified listings and excellent customer support.</p>
    </div>
    <div id="blog" class="nav-info">
        <h3>Blog</h3>
        <p>Read about tips for finding affordable housing, managing roommates, and insights into the best student cities to live and study in.</p>
    </div>
    <div id="suggestion" class="nav-info">
        <h3>Suggestion</h3>
        <p>We value your input! Share your ideas to help improve our platform and services.</p>
    </div>
    <div id="contact" class="nav-info">
        <h3>Contact</h3>
        <p>Email: support@sheltersearch.com<br>Phone: +1 234 567 890<br>Address: 123 Main Street, City, Country</p>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h2>Welcome to Shelter Search</h2>
        <p>
            Shelter Search specializes in connecting room seekers with property owners, offering a platform where tenants can directly contact landlords without intermediaries. We aim to make the process of finding rental rooms simple, fast, and transparent.
        </p>
        <h3>Our Services</h3>
        <ul>
            <li>Comprehensive room listings verified for quality and accuracy.</li>
            <li>Direct communication between room seekers and owners.</li>
            <li>Student-friendly housing options tailored for study and comfort.</li>
            <li>Roommate matching services based on lifestyle preferences.</li>
            <li>24/7 customer support to address your queries.</li>
        </ul>
        <h3>Interesting Facts</h3>
        <p>
            Over 10,000 successful room matches made to date! Shelter Search is the go-to platform for hassle-free rental services trusted by students and professionals alike.
        </p>
    </div>

    <script>
    // JavaScript to handle navbar interactions
    
const navLinks = document.querySelectorAll('.navbar a');
const navInfos = document.querySelectorAll('.nav-info');

navLinks.forEach(link => {
    link.addEventListener('click', (e) => {
        const targetId = link.getAttribute('data-info');

        // Check if the link is not the Login button
        if (targetId) {
            e.preventDefault();
            const targetInfo = document.getElementById(targetId);

            // Check if the target info is already active
            if (targetInfo.classList.contains('active')) {
                // Hide the currently visible info
                targetInfo.classList.remove('active');
            } else {
                // Hide all other info boxes
                navInfos.forEach(info => info.classList.remove('active'));

                // Show the target info box
                if (targetInfo) {
                    targetInfo.classList.add('active');

                    // Auto-hide the nav-info after 5 seconds
                    setTimeout(() => {
                        targetInfo.classList.remove('active');
                    }, 5000);
                }
            }
        }
    });
});

</script>

</body>

</html>
