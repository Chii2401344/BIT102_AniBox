<?php
require 'login/connect.php'; // Include the database connection file
$sql = "SELECT * FROM anime"; // SQL query to fetch all anime
$result = $conn->query($sql); // Execute the query
?>

<!-- Browse Section -->
<section class="browse-section" id="browse">
    <div class="container">
        <h2 class="section-title text-center mb-5">✦ Browse Anime ✦</h2>

        <!-- Search and Filter Section -->
        <div class="search-filter-section mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <!-- Search bar -->
                    <div class="search-group">
                        <label for="animeSearch" class="form-label">Search</label>
                        <input type="text" class="form-control" id="animeSearch"
                            placeholder="Search by title...">
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- Genre filter dropdown -->
                    <div class="filter-group">
                        <label for="genreFilter" class="form-label">Genres</label>
                        <select class="form-select" id="genreFilter">
                            <option value="" selected>Any</option>
                            <option value="action">Action</option>
                            <option value="adventure">Adventure</option>
                            <option value="comedy">Comedy</option>
                            <option value="drama">Drama</option>
                            <option value="fantasy">Fantasy</option>
                            <option value="romance">Romance</option>
                            <option value="sci-fi">Sci-Fi</option>
                            <option value="slice-of-life">Slice of Life</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- Status filter dropdown -->
                    <div class="filter-group">
                        <label for="statusFilter" class="form-label">Status</label>
                        <select class="form-select" id="statusFilter">
                            <option value="" selected>Any</option>
                            <option value="airing">Airing</option>
                            <option value="completed">Completed</option>
                            <option value="upcoming">Upcoming</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <!-- Year filter dropdown -->
                    <div class="filter-group">
                        <label for="yearFilter" class="form-label">Year</label>
                        <select class="form-select" id="yearFilter">
                            <option value="" selected>Any</option>
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                            <option value="2022">2022</option>
                            <option value="2021">2021</option>
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>
                            <option value="2018">2018</option>
                            <option value="2017">2017</option>
                            <option value="2016">2016</option>
                            <option value="2015">2015</option>
                            <option value="2014">2014</option>
                            <option value="2013">2013</option>
                            <option value="2012">2012</option>
                            <option value="2011">2011</option>
                            <option value="2010">2010</option>
                            <option value="2009">2009</option>
                            <option value="2008">2008</option>
                            <option value="2007">2007</option>
                            <option value="2006">2006</option>
                            <option value="2005">2005</option>
                            <option value="2004">2004</option>
                            <option value="2003">2003</option>
                            <option value="2002">2002</option>
                            <option value="2001">2001</option>
                            <option value="2000">2000</option>
                            <option value="1999">1999</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Anime Listings Section -->
        <?php
        $count = 0;

        if ($result->num_rows > 0) {
            echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">';
            while ($row = $result->fetch_assoc()) {
        ?>
                <div class="col anime-item">
                    <div class="anime-card">
                        <div class="anime-cover">
                            <a href="login/user-login.html" class="anime-card-link" onclick="redirectToLogin()" style="text-decoration: none; color: inherit;">
                                <img src="<?= $row['Cover_Img'] ?>" alt="<?= $row['Title'] ?>" class="img-fluid">
                            </a>
                        </div>
                        <div class="anime-caption">
                            <a href="login/user-login.html" class="anime-card-link" onclick="redirectToLogin()" style="text-decoration: none; color: inherit;">
                                <h3><?= $row['Title'] ?></h3>
                            </a>
                        </div>
                    </div>
                </div>
        <?php
            }
            echo '</div>'; // Close row

        } else {
            echo '<p>No anime found :( </p>';
        }
        ?>
    </div>
</section>


<script>
    // Function to redirect to login page with alert
    function redirectToLogin() {
        alert("Please login or sign up to view anime details!");
    }
</script>