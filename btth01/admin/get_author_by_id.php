<?php 
    require_once '../connect.php';
    if ($_GET['id']) {
        $sql = 'select * from tacgia where ma_tgia = '.$_GET['id'];
        try {
            $result = $cnn->prepare($sql);
            $result->execute();
            $data = $result->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
?>