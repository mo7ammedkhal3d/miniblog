<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "blog";

$message = '';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $id = $_POST['id'];
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $create_date = $_POST['create_date'];

    // Update the record in the database
    $sql = "UPDATE posts SET title='$title',title='$subtitle', create_date='$create_date' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        $message = "Record updated successfully";
    } else {
        $message = "Error updating record: " . $conn->error;
    }
}

// Get the post data from the database
$id = $_GET['id'];
$sql = "SELECT * FROM posts WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Post</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container" style="margin-top:50px">
        <h2>Update Post</h2>
        <?php if (!empty($message)): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $row['title']; ?>" required>
            </div>
            <div class="form-group">
                <label for="title">subTitle:</label>
                <input type="text" class="form-control" id="title" name="subtitle" value="<?php echo $row['subtitle']; ?>" required>
            </div>
            <div class="form-group">
                <label for="create_date">Publishing Date:</label>
                <input type="date" class="form-control" id="create_date" name="create_date" value="<?php echo $row['create_date']; ?>" required>
            </div>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <button type="submit" class="btn btn-primary">Update</button>
            <a class="btn btn-secondary" href="index.php">Cancel</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>
</html>