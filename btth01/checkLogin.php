<?php
    include "../database/connectDatabase.php";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];

        try {
            $query = $cnn -> prepare("Select tai_khoan, mat_khau, quyen_han From nguoidung Where tai_khoan=:user_name And mat_khau=:user_password");
            $data = [
                'user_name' => $user_name,
                'user_password' => $user_password,
            ];
            $query -> execute($data);
            $data = $query -> fetch(PDO::FETCH_ASSOC);

            if (!empty($data)) {
                if ($data['quyen_han'] == 1) header('Location:admin/index.php');
                else header('Location:index.php');
            }
            else header('Location:login.php?state=fail');

        }
        catch(PDOException $ex){
            echo $ex->getMessage();
        }
    }