<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page
    header("Location: ../login/user-login.html");
    exit();
}

// Get the User_ID from session
$user_id = $_SESSION['user_id'];

require '../login/connect.php'; // Include the database connection file

// Fetch user data
$sql = "SELECT * FROM user WHERE user_id = '$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Fetch watchlist data with anime details
$watchlist_sql = "SELECT w.*, a.Title, a.Cover_Img 
                FROM watchlist w 
                JOIN anime a ON w.Ani_ID = a.Ani_ID 
                WHERE w.User_ID = '$user_id'";
$watchlist_result = $conn->query($watchlist_sql);

// Organize anime by status
$watching = array();
$completed = array();
$planning = array();

while ($row = $watchlist_result->fetch_assoc()) {
    switch ($row['Status']) {
        case 'Watching':
            $watching[] = $row;
            break;
        case 'Completed':
            $completed[] = $row;
            break;
        case 'Planning':
            $planning[] = $row;
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AniBox</title>
    <link rel="icon" type="image/x-icon" href="../assets/ABLOGO.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/theme.css">
    <link rel="stylesheet" href="user-profile-mybox.css">
    <link rel="stylesheet" href="user-navbar.css">
    <link rel="stylesheet" href="user-profile.css">
</head>

<body>

    <!-- Include User's Navigation Bar  -->
    <?php include "navbar.php"; ?>

    <!-- Include User Profile Section and Lower Navigation Bar -->
     <?php include "user-profile-navbar.php"; ?>

    <main>
        <!-- My Box Section -->
        <div class="mybox-container mt-3">
            <div class="row mt-3">
                <div class="filter-container col-md-3">
                    <!-- Search and Filter Section -->
                    <div class="filter-container2">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Search bar -->
                            <input type="text" class="form-control" placeholder="Search Anime...">
                            <button class="btn btn-secondary d-md-none" type="button" data-bs-toggle="collapse"
                                data-bs-target="#filters">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                        </div>
                        <div class="collapse d-md-block" id="filters">
                            <h6 class="mt-2">Filters</h6>
                            <!-- Lists filter dropdown -->
                            <select class="form-select mt-2">
                                <option value="" selected disabled>Lists</option>
                                <option>All</option>
                                <option>Watching</option>
                                <option>Completed</option>
                                <option>Planning</option>
                            </select>
                            <!-- Status filter dropdown -->
                            <select class="form-select mt-2">
                                <option value="" selected disabled>Status</option>
                                <option>All</option>
                                <option value="airing">Airing</option>
                                <option value="completed">Completed</option>
                                <option value="upcoming">Upcoming</option>
                            </select>
                            <!-- Genre filter dropdown -->
                            <select class="form-select mt-2">
                                <option value="" selected disabled>Genre</option>
                                <option>All</option>
                                <option value="action">Action</option>
                                <option value="adventure">Adventure</option>
                                <option value="comedy">Comedy</option>
                                <option value="drama">Drama</option>
                                <option value="fantasy">Fantasy</option>
                                <option value="romance">Romance</option>
                                <option value="sci-fi">Sci-Fi</option>
                            </select>
                            <!-- Year filter dropdown -->
                            <select class="form-select mt-2">
                                <option value="" selected disabled>Year</option>
                                <option>All Time</option>
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

                <div class="col-1 anime-list-container">
                    <!-- Watching Category List -->
                    <div class="anime-category">
                        <h4>Watching</h4>
                        <table class="watching-table table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10%;"> </th>
                                    <th style="width: 50%;">
                                        <p class="anime-card-th">Title</p>
                                    </th>
                                    <th style="width: 20%;">
                                        <p class="anime-card-th">Edit</p>
                                    </th>
                                    <th style="width: 20%;">
                                        <p class="anime-card-th">Delete</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($watching as $anime): ?>
                                <tr class="anime-card">
                                    <td>
                                        <img src="../<?php echo $anime['Cover_Img']; ?>" alt="<?php echo $anime['Title']; ?>" width="5%">
                                    </td>
                                    <td>
                                        <a class="anime-card-title" href="../animes/anime.php?id=<?php echo $anime['Ani_ID'] ?>">
                                            <?php echo $anime['Title']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit-watchlist" 
                                                data-anime-id="<?php echo $anime['Ani_ID']; ?>"
                                                data-status="<?php echo $anime['Status']; ?>">
                                            Edit
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger" style="border-radius: 25px;"
                                                data-anime-id="<?php echo $anime['Ani_ID']; ?>">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Completed Category List -->
                    <div class="anime-category">
                        <h4>Completed</h4>
                        <table class="completed-table table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10%;"> </th>
                                    <th style="width: 50%;">
                                        <p class="anime-card-th">Title</p>
                                    </th>
                                    <th style="width: 20%;">
                                        <p class="anime-card-th">Edit</p>
                                    </th>
                                    <th style="width: 20%;">
                                        <p class="anime-card-th">Delete</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($completed as $anime): ?>
                                <tr class="anime-card">
                                    <td>
                                        <img src="../<?php echo $anime['Cover_Img']; ?>" alt="<?php echo $anime['Title']; ?>" width="5%">
                                    </td>
                                    <td>
                                        <a class="anime-card-title" href="../animes/anime.php?id=<?php echo $anime['Ani_ID'] ?>">
                                            <?php echo $anime['Title']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit-watchlist"
                                                data-anime-id="<?php echo $anime['Ani_ID']; ?>"
                                                data-status="<?php echo $anime['Status']; ?>">
                                            Edit
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger" style="border-radius: 25px;"
                                                data-anime-id="<?php echo $anime['Ani_ID']; ?>">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Planning Category List -->
                    <div class="anime-category">
                        <h4>Planning</h4>
                        <table class="planning-table table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10%;"> </th>
                                    <th style="width: 50%;">
                                        <p class="anime-card-th">Title</p>
                                    </th>
                                    <th style="width: 20%;">
                                        <p class="anime-card-th">Edit</p>
                                    </th>
                                    <th style="width: 20%;">
                                        <p class="anime-card-th">Delete</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($planning as $anime): ?>
                                <tr class="anime-card">
                                    <td>
                                        <img src="../<?php echo $anime['Cover_Img']; ?>" alt="<?php echo $anime['Title']; ?>" width="5%">
                                    </td>
                                    <td>
                                        <a class="anime-card-title" href="../animes/anime.php?id=<?php echo $anime['Ani_ID'] ?>">
                                            <?php echo $anime['Title']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit-watchlist"
                                                data-anime-id="<?php echo $anime['Ani_ID']; ?>"
                                                data-status="<?php echo $anime['Status']; ?>">
                                            Edit
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger" style="border-radius: 25px;"
                                                data-anime-id="<?php echo $anime['Ani_ID']; ?>">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Watchlist Modal -->
        <div class="modal fade" id="edit-watchlist" tabindex="-1" aria-labelledby="edit-watchlist" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit-watchlist">Edit Watchlist</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select mt-2" id="status">
                                    <option>Watching</option>
                                    <option>Completed</option>
                                    <option>Planning</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

    </main>

    <footer class="footer">
        <div class="container">
            <p class="text-center mb-0">&copy; 2025 AniBox. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Handle the edit watchlist modal
        const editModal = document.getElementById('edit-watchlist');
        let currentAnimeId = null;

        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            currentAnimeId = button.getAttribute('data-anime-id');
            const currentStatus = button.getAttribute('data-status');
            
            // Set the current status in the dropdown
            const statusSelect = document.getElementById('status');
            statusSelect.value = currentStatus;
        });

        // Handle the form submission
        document.querySelector('#edit-watchlist .btn-primary').addEventListener('click', function() {
            const status = document.getElementById('status').value;
            
            // Send the update request
            fetch('update-watchlist.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    anime_id: currentAnimeId,
                    status: status
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Reload the page to show updated watchlist
                    window.location.reload();
                } else {
                    alert('Failed to update watchlist: ' + (data.error || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to update watchlist. Please try again.');
            });
        });

        // Handle delete buttons
        document.querySelectorAll('.btn-danger').forEach(button => {
            button.addEventListener('click', function() {
                const animeId = this.getAttribute('data-anime-id');
                const animeTitle = this.closest('tr').querySelector('.anime-card-title').textContent;
                
                // Show confirmation dialog
                if (confirm(`Are you sure you want to remove this from your Box?`)) {
                    // Send delete request
                    fetch('delete-watchlist.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            anime_id: animeId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Remove the row from the table
                            this.closest('tr').remove();
                        } else {
                            alert('Failed to delete watchlist entry: ' + (data.error || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to delete watchlist entry. Please try again.');
                    });
                }
            });
        });
    </script>

</body>

</html>