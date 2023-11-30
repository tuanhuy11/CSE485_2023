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
                        }
                            if (isset($_POST['saveButton'])) {
                                $id = $_POST['id'];
                                $tieude = $_POST['tieude'];
                                $ten_bhat = $_POST['ten_bhat'];
                                $tom_tat = $_POST['tom_tat'];
                                $noi_dung = $_POST['noi_dung'];
                                $ngay_viet = $_POST['ngay_viet'];
                                // echo $tom_tat;
                                $sqlQuery1 = "UPDATE baiviet SET tieude = :tieude, ten_bhat = :ten_bhat, tomtat = :tom_tat, noidung = :noi_dung, ngayviet = :ngay_viet WHERE ma_bviet = :id";
                                $stmt1 = $cnn->prepare($sqlQuery1);
                                $stmt1->bindParam(':tieude', $tieude);
                                $stmt1->bindParam(':ten_bhat', $ten_bhat);
                                $stmt1->bindParam(':tom_tat', $tom_tat);
                                $stmt1->bindParam(':noi_dung', $noi_dung);
                                $stmt1->bindParam(':ngay_viet', $ngay_viet);
                                $stmt1->bindParam(':id', $id);

                                if ($stmt1->execute()) {
                                    header("Location: baiviet.php");
                                    exit();
                                } else {
                                    echo "Có lỗi xảy ra khi cập nhật dữ liệu.";
                                }
                            
                            }
                            ?>