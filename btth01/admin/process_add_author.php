<?php
    require_once '../connect.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $nameAuthor = $_POST['txtAuthorName'];
        $imagDir = '/images/authors/'.$_POST['file'];

        $sql = "INSERT INTO tacgia(ten_tgia, hinh_tgia) VALUES(:ten_tgia, :hinh_tgia)";
        try {
            $insert = $cnn->prepare($sql);
            $data = [
                'ten_tgia' => $nameAuthor,
                'hinh_tgia' => $imagDir
            ];
            $insert->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        header('Location:author.php');
    }
?>