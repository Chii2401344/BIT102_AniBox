<?php

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page
    header("Location: ../user-login.html");
    exit();
}

// Get the User_ID from session
$user_id = $_SESSION['user_id'];

require '../login/connect.php'; // Include the database connection file

// Fetch user data
$sql = "SELECT * FROM user WHERE user_id = '$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

$fav_anime_sql = "SELECT a.* FROM favourite f JOIN anime a ON f.Ani_ID = a.Ani_ID WHERE f.User_ID = '$user_id'";
$fav_anime_result = $conn->query($fav_anime_sql);
$fav_anime = $fav_anime_result->fetch_all(MYSQLI_ASSOC);

?>

<div class="about-bar">
    <div class="FavoriteAnime">
    <h2><strong>✦ Favorite Anime ✦</strong></h2>
        <div class="fav-anime-card">
            <?php foreach ($fav_anime as $anime): ?>
                <div class="fav-anime-list">
                    <div class="fav-anime-cover">
                        <img src="../<?php echo $anime['Cover_Img']; ?>" alt="<?php echo htmlspecialchars($anime['Title']); ?>">
                    </div>
                    <div class="fav-anime-title">
                        <h4>
                            <a href="../animes/anime.php?id=<?php echo $anime['Ani_ID']; ?>">
                                <?php echo htmlspecialchars($anime['Title']); ?>
                            </a>
                        </h4>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>