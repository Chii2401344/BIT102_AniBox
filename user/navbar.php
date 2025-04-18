
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="user-home.html">AniBox</a>
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
                        <a class="nav-link" href="user-profile-mybox.html">My Box</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user-profile-about.html">Profile</a>
                    </li>
                </ul>
                <hr class="d-lg-none my-2 text-dark-50">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="user-settings.html" class="d-none d-lg-block me-3">
                            <i class="fa-solid fa-gear"></i>
                        </a>
                        <a class="nav-link d-block d-lg-none" href="user-settings.html">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" id="logoutDesktop" class="d-none d-lg-block me-3">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                        <a href="#" id="logoutMobile" class="nav-link d-block d-lg-none">Logout</a>
                    </li>
                </ul>

                <!-- Profile Picture -->
                <a href="user-profile-about.html" class="card-container d-none d-lg-block">
                    <img src="<?php echo $user['Profile_Img']; ?>" alt="profile" class="user-icon">
                </a>

            </div>
        </div>
    </nav>