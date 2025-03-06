// Hamburger menu elements
const menuToggleBtn = document.getElementById('menuToggleBtn'); // Hamburger menu button
const menu = document.getElementById('menu'); // Menu container
const modeButtons = document.getElementById('modeButtons'); // Initial mode buttons

// Mode buttons in the menu
const ownerModeMenuBtn = document.getElementById('ownerModeMenuBtn'); // Owner mode button in menu
const tenantModeMenuBtn = document.getElementById('tenantModeMenuBtn'); // Tenant mode button in menu
// const myroomsMenuBtn = document.getElementById('myroomsMenuBtn'); // myrooms mode button in menu
const logoutMenuBtn = document.getElementById('logoutMenuBtn'); // Logout button in menu

// Elements for owner/tenant mode
const ownerModeBtn = document.getElementById('ownerModeBtn'); // Button to switch to owner mode
const logoutBtn = document.getElementById('logoutBtn'); // for logout function
const tenantModeBtn = document.getElementById('tenantModeBtn'); // Button to switch to tenant mode    
const myroomsModeBtn = document.getElementById('myroomsModeBtn'); // Button to switch to myrooms mode    
const uploadDetails = document.getElementById('uploadDetails'); // Owner mode section   
// const tenantMode = document.getElementById('tenantMode'); // Tenant mode section
// const myroomsMode = document.getElementById('myroomsMode'); // Tenant mode section
const ownerForm = document.getElementById('ownerForm'); // Form to submit room details (owner mode)
const roomsContainer = document.getElementById('roomsContainer'); // Container to display rooms (tenant mode)

const Ownerarea = document.getElementById('Ownerarea'); // Container to display owner mode
const UploadBtn = document.getElementById('UploadBtn'); // Button to display owner mode

// const buttonU = document.getElementById('buttonU'); // Button to display owner mode
// const titlehead = document.getElementById('titlehead'); // Button to display owner mode
const OwnerMode = document.getElementById('OwnerMode'); // Button to display owner mode

// for number
// const number = document.getElementById("number");

// Toggle hamburger menu visibility
menuToggleBtn.addEventListener('click', () => {
    menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
});

// Switch to Owner Mode
// ownerModeBtn.addEventListener('click', () => switchMode('ownerMode')); just for a while1


// Switch to Tenant Mode
// tenantModeBtn.addEventListener('click', () => switchMode('tenant'));
// tenantModeMenuBtn.addEventListener('click', () => switchMode('tenant'));
// Switch to my rooms mode
// myroomsModeBtn.addEventListener('click', () => switchMode('myrooms'));just for while2
// myroomsMenuBtn.addEventListener('click', () => switchMode('myrooms'));

UploadBtn.addEventListener('click', () => switchMode('roomUpload'));
ownerModeBtn.addEventListener('click', () => switchMode('roomshow'));
ownerModeMenuBtn.addEventListener('click', () => switchMode('roomshow'));




// Logout from menu
logoutMenuBtn.addEventListener('click', () => {
    window.location.href = 'logout.php';
});
// Logout from mainmenu
logoutBtn.addEventListener('click', () => {
    window.location.href = 'logout.php';
});

// Function to handle mode switching
function switchMode(mode) {
    OwnerMode.style.display = mode === 'roomshow' ? 'block' : 'none';
    uploadDetails.style.display = mode === 'roomUpload' ? 'block' : 'none';
    modeButtons.style.display = 'none'; // Hide initial mode buttons
    menu.style.display = 'none'; // Hide menu after selection
    document.querySelector('header').style.display = 'none';

    // Show the Back button only in uploadDetails section
    if (mode === 'roomUpload') {
        document.getElementById('backButton').style.display = 'block';
    } else {
        document.getElementById('backButton').style.display = 'none';
    }
}


//for the validation section


function validate() {
    var txt = document.getElementById("number").value; // Contact number
    var rate = document.getElementById("rate").value; // Rate
    var address = document.getElementById("address").value; // Address
    var description = document.getElementById("descriptionBox").value; // Fix incorrect ID reference
    var imageInput = document.getElementById("roomImage"); // Image input


    // Validate image file selection
    if (imageInput.files.length === 0) {
        alert("Please upload a room image.");
        return false;
    }

    // Validate image file type
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    var fileName = imageInput.value;
    if (!allowedExtensions.test(fileName)) {
        alert("Please upload a valid image file (jpg, jpeg, png, gif).");
        return false;
    }

    // Regex for Nepali mobile number validation: 10 digits, starts with 97 or 98
    var regx = /^(97|98)[0-9]{8}$/;

    // Validate contact number
    if (!regx.test(txt)) {
        alert("Invalid contact number. It should be a 10-digit number starting with 97 or 98.");
        return false;
    }

    // Validate rate
    if (rate === "" || rate <= 0) {
        alert("Please enter a valid rate (greater than 0).");
        return false;
    }

    // Validate address
    if (address.trim() === "") {
        alert("Address cannot be empty.");
        return false;
    }

    // Validate description
    if (description.trim() === "") {
        alert("Description cannot be empty.");
        return false;
    }

    

    return true; // Form will submit only if all validations pass
}

function goBack() {
    switchMode('roomshow'); // Go back to Owner Mode
}


