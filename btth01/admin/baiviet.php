<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>
<?php
const _HOST='localhost';
const _DB='btth01_cse485';
const _USER='root';
const _PASSWORD='';
$option=[
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];
try{
    if(class_exists('PDO')){
        $sql='mysql:host='._HOST.';dbname='._DB;
        $cnn=new PDO($sql,_USER,_PASSWORD,$option);
    }
}
catch(PDOException $ex){
    echo $ex->getMessage();
}?>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="h3">
                    <a class="navbar-brand" href="#">Administration</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Trang ngoài</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="category.php">Thể loại</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="author.php">Tác giả</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="article.php">Bài viết</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

    </header>
    <main class="container mt-6 mb-4">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="row">
            <div class="col-sm">
                <a href="add.php" class="btn btn-success">Thêm mới</a>
                
                <?php
                    try {
                        $sqlQuery = "SELECT * FROM baiviet";
                        $result = $cnn->prepare($sqlQuery);
                        $result->execute();
    
                        $data = $result->fetchAll(PDO::FETCH_ASSOC);
    
                        echo "<table class='table'>";
                        echo "<thead><tr>";
                        $columnName = array
                        ("Mã bài viết", "Tiêu đề", "Tên bài hát", "Mã thể loại", "Tóm tắt", "Nội dung", "Mã tác giả", "Ngày viết", "Hình ảnh", "Sửa");
                        // Display table header with column names
                        foreach ($columnName as $columnNames) {
                            echo "<th scope='col'>$columnNames</th>";
                        }
    
                        echo "</tr></thead>";
                        echo "<tbody>";
    
                        // Display each row of data
                        foreach ($data as $row) {
                            echo "<tr>";
                            foreach ($row as $key => $value) {
                                echo "<td>$value</td>";
                            }
    
                            // Add the "Edit" column with an edit icon
                            echo "<td>
                                    <a href='edit.php?id={$row['ma_bviet']}'>
                                        <i class='fas fa-edit'></i>
                                    </a>
                                </td>";
    
                            echo "</tr>";
                        }
                        echo "</tbody></table>";
                    } catch (PDOException $e) {
                        // Handle database errors
                        echo "Error: " . $e->getMessage();
                    }
                    ?>
                
            </div>
        </div>
    </main>
    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>