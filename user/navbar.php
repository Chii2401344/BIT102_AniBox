<?php

// Get the User_ID from session
$user_id = $_SESSION['user_id'];

require '../login/connect.php'; // Include the database connection file
$sql = "SELECT * FROM user WHERE user_id = '$user_id'"; // SQL query to fetch user data
$result = $conn->query($sql); // Execute the query
$user = $result->fetch_assoc(); // Fetch the user data

?>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="user-home.php">AniBox</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="user-home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user-home.php#browse">Browse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user-profile-mybox.php">My Box</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user-profile-about.php">Profile</a>
                    </li>
                </ul>
                <hr class="d-lg-none my-2 text-dark-50">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="user-settings.php" class="d-none d-lg-block me-3">
                            <i class="fa-solid fa-gear"></i>
                        </a>
                        <a class="nav-link d-block d-lg-none" href="user-settings.php">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" id="logoutDesktop" class="d-none d-lg-block me-3">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                        <a href="#" id="logoutMobile" class="nav-link d-block d-lg-none">Logout</a>
                    </li>
                </ul>

                <!-- Profile Picture -->
                <a href="user-profile-about.php" class="card-container d-none d-lg-block">
                    <img src="<?php echo $user['Profile_Img']; ?>" alt="profile" class="user-icon">
                </a>

            </div>
        </div>
    </nav>
    
    <script src="logout.js"></script>