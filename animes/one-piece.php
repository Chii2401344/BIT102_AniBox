<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AniBox</title>
    <link rel="icon" type="image/x-icon" href="../assets/ABLOGO.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/theme.css">
    <link rel="stylesheet" href="../user/user-navbar.css">
    <link rel="stylesheet" href="anime.css">
</head>

<body class="one-piece">

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="../user/user-home.html">AniBox</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../user/user-home.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../user/user-home.html#browse">Browse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../user/user-profile-mybox.html">My Box</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../user/user-profile-about.html">Profile</a>
                    </li>
                </ul>
                <hr class="d-lg-none my-2 text-dark-50">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="../user/user-settings.html" class="d-none d-lg-block me-3">
                            <i class="fa-solid fa-gear"></i>
                        </a>
                        <a class="nav-link d-block d-lg-none" href="../user/user-settings.html">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" id="logoutDesktop" class="d-none d-lg-block me-3">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                        <a href="#" id="logoutMobile" class="nav-link d-block d-lg-none">Logout</a>
                    </li>
                </ul>

                <!-- Profile Picture -->
                <a href="../user/user-profile-about.html" class="card-container d-none d-lg-block">
                    <img src="../assets/img/pfp3.jpg" alt="profile" class="user-icon">
                </a>

            </div>
        </div>
    </nav>

    <!-- Container for Anime Details and Add to Box Button Section -->
    <div class="container1">
        <!-- Container for Main Anime Display -->
        <div class=anime-container>
            <div class="anime-cover">
                <img src="../assets/img/cover-one-piece.jpg" alt="One Piece">
            </div>
            <div class="anime-details">
                <p class="title"><strong>One Piece</strong></p>
                    <span class="piece-genre">Action</span>
                    <p class="detail1"><strong>Episodes:</strong> 1123</p>
                    <p class="detail2"><strong>Status:</strong> Airing</p>
            </div>
        </div>
        <!-- Add to Box Button -->
        <div class="add-button">
            <button class="btn btn-primary"><strong>+ Add to Box</strong></button>
        </div>
        <br>
    </div>

    <!-- Container for Anime Info, Synopsis, Recommendations and Reviews Sections -->
    <div class="container2">

        <!-- Divider between Anime Details and rest of the page -->
        <hr>

        <!-- Container for Anime Info Section -->
        <div class="anime-info-container">

            <div class="score">
                <p>Rating
                <p>
                <h3>88%</h3>
            </div>

            <div class="popularity">
                <p>Popularity
                <p>
                <h3>583912</h3>
            </div>

            <div class="date">
                <p>Release Date
                <p>
                <h3>Oct 20, 1999</h3>
            </div>

            <div class="studio">
                <p>Studio
                <p>
                <h3>Toei Animation</h3>
            </div>

        </div>

        <!-- Anime Synopsis Section -->
        <div class="anime-synopsis">
            <h2><strong>✦ Synopsis ୭ ˚. ᵎᵎ</strong></h2>
            <p>A young pirate, Luffy, sets sail with his crew to find the legendary One Piece treasure and become the
                Pirate King, facing powerful enemies and uncovering world-shaking secrets..
            </p>
        </div>

        <!-- Container for Recommendations and Reviews -->
        <div class="lower-half-container">

            <!-- Container for Recommendations Section -->
            <div class="recommendation-container">
                <h2><strong>✦ More Like This ₊˚⊹⋆</strong></h2>
                <br>
                <!-- Container for All Recommendations -->
                <div class="recommendation">

                    <!-- Container for Individual Recommendation Section -->
                    <div class="individual-recommendation">
                        <img src="../assets/img/cover-fullmetal-alchemist.jpg" alt="Fullmetal Alchemist">
                        <!-- Container for Recommendation Details and Add to Box Button -->
                        <div class="recommendation-details">
                            <h4 class="recommendation-title"><strong>Fullmetal Alchemist</strong></h4>
                            <p class="recommendation-synopsis">
                                Two brothers search for a Philosopher's Stone after an
                                attempt to revive their deceased mother goes awry.
                            </p>
                            <button class="btn btn-light"><strong>+ Add to Box</strong></button>
                        </div>
                    </div>

                    <br>
                    <hr>
                    <br>

                    <!-- Container for Individual Recommendation Section -->
                    <div class="individual-recommendation">
                        <img src="../assets/img/cover-hunterxhunter.jpg" alt="Hunter x Hunter">
                        <!-- Container for Recommendation Details and Add to Box Button -->
                        <div class="recommendation-details">
                            <h4 class="recommendation-title"><strong>Hunter x Hunter</strong></h4>
                            <p class="recommendation-synopsis">A young boy embarks on a journey to become a Hunter and
                                find his long-lost father. He encounters powerful allies and complex challenges along
                                the way.
                            </p>
                            <button class="btn btn-light"><strong>+ Add to Box</strong></button>
                        </div>
                    </div>

                    <br>
                    <hr>
                    <br>

                    <!-- Container for Individual Recommendation Section -->
                    <div class="individual-recommendation">
                        <img src="../assets/img/cover-naruto.jpg" alt="Naruto">
                        <!-- Container for Recommendation Details and Add to Box Button -->
                        <div class="recommendation-details">
                            <h4 class="recommendation-title"><strong>Naruto</strong></h4>
                            <p class="recommendation-synopsis">
                                Naruto Uzumaki, a young ninja who seeks recognition from
                                his peers and dreams of becoming the leader of his village. DATTEBAYO!
                            </p>
                            <button class="btn btn-light"><strong>+ Add to Box</strong></button>
                        </div>
                    </div>

                    <br>

                </div>
            </div>

            <!-- Container for Anime Reviews Section -->
            <div class="anime-review-container">
                <h2><strong>✦ Reviews ✶⋆.˚</strong></h2>

                <!-- Container for All Reviews (including Review Form) -->
                <div class="review-container">

                    <!-- Container for Review Form -->
                    <div class="review-form">

                        <!-- Rating Form (dropdown input) -->
                        <div class="rating-form">
                            <label for="rating">Rating:</label><br>
                            <select class="form-select" id="rating" name="rating">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>

                        <!-- Review Comment Form (text input) -->
                        <div class="review">
                            <label>Review:</label><br>
                            <input type="text" placeholder="Write a review...">
                        </div>

                        <!-- Submit Review Button -->
                        <div class="submisson-button">
                            <br>
                            <button class="submit-button">Submit</button>
                        </div>

                        <br>
                    </div>

                    <!-- Divider between Review Form and Reviews -->
                    <hr>

                    <!-- Container for All Reviews -->
                    <div class="review-comments">

                        <!-- Container for Individual Reviews -->
                        <div class="review-card">
                            <img src="../assets/img/icon-espurr.jpg" alt="profile" class="review-user-icon" width="50px"
                                height="50px">
                            <h4 class="review-username" id="profileUsername1">ikinespurr</h4>
                            <h5>10/10</h5>
                            <p>someone commented one peak.. so true</p>
                            <p class="review-date">Dec 21, 2024</p>
                        </div>

                        <!-- Container for Individual Reviews -->
                        <div class="review-card">
                            <img src="../assets/img/icon-puppy.jpg" alt="profile" class="review-user-icon" width="50px"
                                height="50px">
                            <h4 class="review-username" id="profileUsername2">yummyluvr</h4>
                            <h5>8/10</h5>
                            <p>I don't watch anime but my friend told me to give this anime a good review</p>
                            <p class="review-date">Aug 27, 2024</p>
                        </div>

                        <!-- Container for Individual Reviews -->
                        <div class="review-card">
                            <img src="../assets/img/pfp3.jpg" alt="profile" class="review-user-icon" width="50px"
                                height="50px">
                            <h4 class="review-username" id="profileUsername3">User1_Fein</h4>
                            <h5>10/10</h5>
                            <p>bro one piece or one PEAK</p>
                            <p class="review-date">May 21, 2007</p>
                        </div>

                        <br>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <p class="text-center mb-0">&copy; 2025 AniBox. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>
</section>

</html>