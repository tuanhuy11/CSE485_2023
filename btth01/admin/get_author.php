<?php
    require_once('../connect.php');

    try {
        $sqlQuery = 'select * from tacgia';
        $result = $cnn->prepare($sqlQuery);
        $result->execute();
        $data = $result->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
?>