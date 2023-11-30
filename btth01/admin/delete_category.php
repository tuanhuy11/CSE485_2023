<?php 
require '../../database/connection.php';

try{
    $id=$_GET['id'] ?? 0;
    $sql='DELETE FROM theloai WHERE ma_tloai=:ma_tloai';
    $delete=$cnn->prepare($sql);
    $data=[
        'ma_tloai'=>$id
    ];
    $delete->execute($data);
    
}
catch(PDOException $ex){
    echo $ex->getMessage();
}
header('Location:category.php');
