<?php 
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "miniblog";

$message = '';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalis of  Post</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    $sql = "SELECT * FROM posts WHERE id = $id";
                    $result = $conn->query($sql);

                    if ($result->num_rows == 1) {
                        $row = $result->fetch_assoc();
                        $title = $row["title"];
                        $createDate = $row["create_date"];

                        if (isset($_GET['confirm'])) {
                            $deleteSql = "DELETE FROM posts WHERE id = $id";
                            if ($conn->query($deleteSql) === TRUE) {
                                echo "<div class='alert alert-success'>Post deleted successfully. <a href='index.php'>Go back to the index page</a></div>";
                            } else {
                                echo "<div class='alert alert-danger'>Error deleting the post: " . $conn->error . "</div>";
                            }
                        } else {
                            echo "<h2 class='mb-4'>Delete Post</h2>";
                            echo "<p class='mb-4'>Are you sure you want to delete the following post?</p>";
                            echo "<p><strong>Title:</strong> $title</p>";
                            echo "<p><strong>Publishing Date:</strong> $createDate</p>";
                            echo " <a class='btn btn-primary' href='index.php'>Cancel</a>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>Post not found. <a href='index.php'>Go back to the index page</a></div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Invalid request. <a href='index.php'>Go back to the index page</a></div>";
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>
</html>