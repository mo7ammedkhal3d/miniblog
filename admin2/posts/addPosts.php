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
if(isset($_POST["title"])){
    $title = $_POST["title"];
    $subtitle = $_POST["subtitle"];
    $content = $_POST["content"];
    $create_date = $_POST["create_date"];
    $sql = "INSERT INTO posts (title, subtitle, content ,create_date)
VALUES ('$title', '$subtitle', '$content',' $create_date')";

if ($conn->query($sql) === TRUE) {
  $message= "New record created successfully";
} else {
    $message=  "Error: " . $sql . "<br>" . $conn->error;
}
}

$sql = "SELECT * FROM posts";
$result = $conn->query($sql);

// if ($result->num_rows > 0) {
  // output data of each row
  foreach ($result as $row) {
    echo $row["title"] ."<br>";
}
// } else {
//   echo "0 results";
// }

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Bootstrap Form Example</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h2>Post Data Form</h2>
    <?php if (!empty($message)) { ?>
      <div class="alert alert-<?php echo ($message === "New record created successfully") ? 'success' : 'danger'; ?>" role="alert">
        <?php echo $message; ?>
      </div>
    <?php } ?>
    <form id="postDataForm" action='' method='POST'>
      <div class="form-group">
        <label for="title">title:</label>
        <input type="text" class="form-control" id="name" name="title" placeholder="Enter post title" required>
      </div>
      <div class="form-group">
        <label for="subtitle">subtitle:</label>
        <input type="text" class="form-control" id="email" name="subtitle" placeholder="Enter post subtitle" required>
      </div>
      <div class="form-group">
        <label for="content">content:</label>
        <input type="text" class="form-control" id="email" name="content" placeholder="Enter post date" required>
      </div>
      <div class="form-group">
        <label for="create_date">content:</label>
        <input type="text" class="form-control" id="email" name="create_date" placeholder="Enter post date" required>
      </div>
      <button type="submit"  class="btn btn-primary">Submit</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script>
  
  </script>
</body>
</html>