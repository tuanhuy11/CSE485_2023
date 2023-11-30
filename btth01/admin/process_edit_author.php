<?php 
    require_once '../connect.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        try {
            $nameAuthor = $_POST['txtAuthorName'];
            $imagDir = '/images/authors/'.$_POST['file'];
            $sql = '';
            $data = [];
            if ( $imagDir == '/images/authors/') {
                $sql = 'update tacgia set ten_tgia = :ten_tgia where ma_tgia = :ma_tgia';
                $data = [
                    'ten_tgia' => $nameAuthor,
                    'ma_tgia'=> $_GET['id']
                ];
            }
            else {
                $sql = 'update tacgia set ten_tgia = :ten_tgia, hinh_tgia = :hinh_tgia where ma_tgia = :ma_tgia';
                $data = [
                    'ten_tgia' => $nameAuthor,
                    'hinh_tgia' => $imagDir,
                    'ma_tgia'=> $_GET['id']
                ];
            }

            $update = $cnn->prepare($sql);
            
            $update->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        // header('Location:author.php');
    }
?>