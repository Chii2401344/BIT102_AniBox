<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AniBox</title>
    <link rel="icon" type="image/x-icon" href="assets/ABLOGO.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/theme.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="user/browse-anime.css">
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">AniBox</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#browse">Browse</a>
                    </li>
                </ul>
                <hr class="d-lg-none my-2 text-dark-50">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="login/user-login.html">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login/user-sign-up.html">Sign Up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>

        <!-- Hero Section -->
        <section class="hero-section position-relative">
            <video class="background-video" autoplay loop muted playsinline>
                <source src="assets/homepage-broll.mp4" type="video/mp4">
            </video>
            <div class="hero-overlay"></div>
            <div class="hero-content-wrapper">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="hero-content text-center">
                                <h1 class="display-4 mb-4">Welcome to AniBox</h1>
                                <p class="lead mb-4">Your ultimate destination for anime discovery and tracking.</p>
                                <div class="cta-buttons">
                                    <a href="login/user-sign-up.html" class="btn btn-primary me-3">Get Started</a>
                                    <a href="#browse" class="btn btn-secondary">Browse Anime</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="about-section position-relative" id="about">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="about-card">
                            <h2 class="section-title">✦ About AniBox</h2>
                            <p>AniBox is your personal anime companion, designed to help you discover, track, and share
                                your favorite anime. Join our community of anime enthusiasts and start your AniBox
                                collection now!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Include Browse Section -->
        <?php include "browse.php"; ?>

    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p class="text-center mb-0">&copy; 2025 AniBox. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>