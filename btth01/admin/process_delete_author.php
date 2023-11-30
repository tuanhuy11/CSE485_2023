<?php 
    require_once '../connect.php';

    $sql = 'delete from tacgia where ma_tgia = ?';
    try {
        $delete = $cnn->prepare($sql);
        $data = [$_GET['id']];
        $delete->execute($data);

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    header('Location:author.php');
    
?>