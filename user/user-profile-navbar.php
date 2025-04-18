
    <!-- Profile Section -->
    <div class="profile" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.0) 0%, rgba(0, 0, 0, 1) 100%), url('<?php echo $user['Banner_Img']; ?>');">
        <div class="pfp">
            <img src="<?php echo $user['Profile_Img']; ?>" alt="profile">
        </div>
        <div class="profile_info">
            <h2 class="username" id="profileUsername"><?php echo $user['Username']; ?></h2>
            <h4 class="email" id="profileEmail"><?php echo $user['Email']; ?></h4>
        </div>
    </div>

    <!-- Lower Profile Navigation Bar -->
    <div class="lower_profile">
        <div class="lower_profile_nav">
            <a class="lower_profile_nav_link" href="user-profile-about.php">
                <h5>About</h5>
            </a>
            <a class="lower_profile_nav_link" href="user-profile-mybox.php">
                <h5>My Box</h5>
            </a>
            <a class="lower_profile_nav_link" href="user-profile-review.php">
                <h5>Reviews</h5>
            </a>
        </div>
    </div>
