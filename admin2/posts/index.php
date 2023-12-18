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

$sql = "SELECT * FROM posts";
$result = $conn->query($sql);


$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customized Table Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .table-custom {
            background-color: #f8f9fa;
            color: black;
        }
        .table-custom thead th {
            background-color:#3f3a3a;
            color: #fff;
            border: 2px solid #956d6d;
            text-align: center;
        }
        .table-custom tbody tr:nth-of-type(odd) {
            background-color: #f0f2f5;
        }
        .table-custom tbody tr:hover {
            background-color: #e8eaf6;
        }
    </style>
</head>
<body>
    <div class="container" style="margin-top:30px">
        <h2>Posts</h2>
        <table class="table table-bordered table-custom" >
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Publishing Date</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row): ?>
                    <tr>
                    <td><?php echo $row["title"]; ?></td>
                    <td><?php echo $row["create_date"]; ?></td>
                    <td>
                        <a class="btn btn-primary" href="update.php?id=<?php echo $row['id']; ?>">
                            <i class="bi bi-pencil-fill"></i> Edit
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">
                            <i class="bi bi-trash-fill"></i> Delete
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-primary" href="details.php?id=<?php echo $row['id']; ?>">
                            <i class="bi bi-info-circle-fill"></i> Details
                        </a>
                    </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
    </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>
</html>