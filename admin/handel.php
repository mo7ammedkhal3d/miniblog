<?php

    define("ROOT_PATH","/PHP/blog/admin/handel.php");

    $requstURI = str_replace(ROOT_PATH,"", $_SERVER['REQUEST_URI']);

    // GET ALL AUTHORS

    if($requstURI == "/authors" && $_SERVER['REQUEST_METHOD'] === "GET"){
        try {
            $conn = new  mysqli('localhost','root','','miniblog','3306');
        } catch (\Throwable $th) {
            die('connection failed .. !! '.$th->getMessage());
        }
    
        $result = $conn->query('SELECT id, name FROM author');
        $conn->close();
        $rows = [];
    
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    
        header('Content-Type: application/json');
    
        echo json_encode($rows);
    }

    // GET ALL POSTS

    if($requstURI == "/posts" && $_SERVER['REQUEST_METHOD'] === "GET"){
        try {
            $conn = new  mysqli('localhost','root','','miniblog','3306');
        } catch (\Throwable $th) {
            die('connection failed .. !! '.$th->getMessage());
        }
    
        $result = $conn->query('SELECT posts.id as id ,posts.title as title ,posts.date as date ,author.name as author  FROM posts JOIN author ON posts.authorId=author.id');
        $conn->close();
        $rows = [];
    
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    
        header('Content-Type: application/json');
    
        echo json_encode($rows);
    }

    // GET ONE POST

    if(str_contains($requstURI,'/posts/?id') && $_SERVER['REQUEST_METHOD'] === "GET"){
        $postId = $_GET['id'];
        try {
            $conn = new  mysqli('localhost','root','','miniblog','3306');
        } catch (\Throwable $th) {
            die('connection failed .. !! '.$th->getMessage());
        }

        $result = $conn->query("Select * from Posts where id = $postId");
        $author = 
        $conn->close();
        $rows = [];
    
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    
        header('Content-Type: application/json');
    
        echo json_encode($rows);


    }

    // ADD POST

    if($requstURI == "/posts" && $_SERVER['REQUEST_METHOD']=== "POST"){
        $title = $_POST['title'];
        $authorId = $_POST['authorId'];
        $content = $_POST['content'];
        $date = date('Y/m/d');
        $uploadDir = '../assets/upload/posts/'; 
        $fileName = basename($_FILES['upload']['name']);
        $uploadFile = $uploadDir . basename($_FILES['upload']['name']);
        move_uploaded_file($_FILES['upload']['tmp_name'], $uploadFile);
        // if (!move_uploaded_file($_FILES['upload']['tmp_name'], $uploadFile)) {
        //     echo "File upload failed.\n";
        // }
        try {
            $conn = new  mysqli('localhost','root','','miniblog','3306');
        } catch (\Throwable $th) {
            die('connection failed .. !! '.$th->getMessage());
        }

        $stmt = $conn->prepare("INSERT INTO posts (title, content, date, authorId, imgUrl) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $title, $content, $date, $authorId, $fileName);
        $result=$stmt->execute();
        $stmt->close();
        $conn->close();
        echo json_encode($result);
    }

    // EDIT POST

    if(str_contains($requstURI,'/posts/?id')  && $_SERVER['REQUEST_METHOD'] === "POST"){
        $postId = $_GET['id'];
        $title = $_POST['title'];
        $authorId = $_POST['authorId'];
        $content = $_POST['content'];
        $uploadDir = '../assets/upload/posts/'; 
        try {
            $conn = new  mysqli('localhost','root','','miniblog','3306');
        } catch (\Throwable $th) {
            die('connection failed .. !! '.$th->getMessage());
        }
        if(!empty($_FILES['upload']['name'])){
            $fileName = basename($_FILES['upload']['name']);
            $uploadFile = $uploadDir . basename($_FILES['upload']['name']);
            move_uploaded_file($_FILES['upload']['tmp_name'], $uploadFile);
    
            $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ?, authorId = ?, imgUrl = ? WHERE id = ?");
            $stmt->bind_param("ssisi", $title, $content, $authorId, $fileName, $postId);
            $result = $stmt->execute();
            $stmt->close();
            echo json_encode($result);
        } else {
            $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ?, authorId = ?, imgUrl = ? WHERE id = ?");
            $stmt->bind_param("ssisi", $title, $content, $authorId, $fileName, $postId);
            $result = $stmt->execute();
            $stmt->close();
            echo json_encode($result);
        } 
    }

    // DELETE POST

    if(str_contains($requstURI,'/posts/?id') && $_SERVER['REQUEST_METHOD'] ==="DELETE"){
        $postId = $_GET['id'];
        try {
            $conn = new  mysqli('localhost','root','','miniblog','3306');
        } catch (\Throwable $th) {
            die('connection failed .. !! '.$th->getMessage());
        }

        $result = $conn->query("DELETE from posts where id=$postId");
        $conn->close();
    
        header('Content-Type: application/json');
    
        echo json_encode($result);
    }    
?>