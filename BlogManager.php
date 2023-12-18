<?php

class BlogManager
{
    private static $posts = [];

    public static function getAll() : array
    {
        try {
            $conn = new  mysqli('localhost','root','','miniblog','3306');
        } catch (\Throwable $th) {
            die('connection failed .. !! '.$th->getMessage());
        }
    
        $result = $conn->query('SELECT posts.id as id ,posts.title as title ,posts.content as content ,posts.date as date,posts.imgUrl as imgUrl ,author.name as author  FROM posts JOIN author ON posts.authorId=author.id');
        $conn->close();
    
        while ($row = mysqli_fetch_assoc($result)) {
            self::$posts[] = $row;
        }

        return self::$posts;
    }

    public static function get($id)
    {
        self::$posts = self::getAll();

        foreach (self::$posts as $post)
        {
            if ($post['id'] == $id)
            {
                return $post;
            }
        }

        return null;
    }
}