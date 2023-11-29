<?php 
    require_once '../connect.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $nameAuthor = $_POST['txtAuthorName'];
        $imagDir = '../images/authors/'.$_POST['file'];

        $sql = 'update tacgia set ten_tgia = :ten_tgia, hinh_tgia = :hinh_tgia where ma_tgia = :ma_tgia';
        try {
            $update = $cnn->prepare($sql);
            $data = [
                'ten_tgia' => $nameAuthor,
                'hinh_tgia' => $imagDir,
                'ma_tgia'=> $_GET['id']
            ];
            $update->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        header('Location:author.php');
    }
?>