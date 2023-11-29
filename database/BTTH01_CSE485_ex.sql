-- a. Liệt kê các bài viết về các bài hát thuộc thể loại Nhạc trữ tình (2 đ)
SELECT * FROM baiviet WHERE ma_tloai = (SELECT ma_tloai FROM theloai WHERE ten_tloai = 'Nhạc trữ tình');

-- b. Liệt kê các bài viết của tác giả "Nhacvietplus" (2 đ)
SELECT * FROM baiviet WHERE ma_tgia = (SELECT ma_tgia FROM tacgia WHERE ten_tgia = 'Nhacvietplus');

-- c. Liệt kê các thể loại nhạc chưa có bài viết cảm nhận nào. (2 đ)
SELECT * FROM theloai WHERE ma_tloai NOT IN (SELECT DISTINCT ma_tloai FROM baiviet);

-- d. Liệt kê các bài viết với các thông tin sau: mã bài viết, tên bài viết, tên bài hát, tên tác giả, tên thể loại, ngày viết. (2 đ)
SELECT bv.ma_bviet, bv.tieude, bv.ten_bhat, tg.ten_tgia, tl.ten_tloai, bv.ngayviet
FROM baiviet bv
JOIN tacgia tg ON bv.ma_tgia = tg.ma_tgia
JOIN theloai tl ON bv.ma_tloai = tl.ma_tloai;

-- e. Tìm thể loại có số bài viết nhiều nhất (2 đ)
SELECT tl.ten_tloai, COUNT(bv.ma_bviet) AS SoBaiViet
FROM theloai tl
LEFT JOIN baiviet bv ON tl.ma_tloai = bv.ma_tloai
GROUP BY tl.ten_tloai
ORDER BY SoBaiViet DESC
LIMIT 1;

-- f. Liệt kê 2 tác giả có số bài viết nhiều nhất (2 đ)
SELECT tg.ten_tgia, COUNT(bv.ma_bviet) AS SoBaiViet
FROM tacgia tg
LEFT JOIN baiviet bv ON tg.ma_tgia = bv.ma_tgia
GROUP BY tg.ten_tgia
ORDER BY SoBaiViet DESC
LIMIT 2;

-- g. Liệt kê các bài viết về các bài hát có tựa bài hát chứa 1 trong các từ “yêu”, “thương", "anh", "em" (2 đ)
SELECT * FROM baiviet WHERE tieude LIKE '%yêu%' OR tieude LIKE '%thương%' OR tieude LIKE '%anh%' OR tieude LIKE '%em%';

-- h. Liệt kê các bài viết về các bài hát có tiêu đề bài viết hoặc tựa bài hát chứa 1 trong các từ “yêu”, “thương", "anh", "em" (2 đ)
SELECT * FROM baiviet WHERE tieude LIKE '%yêu%' OR tieude LIKE '%thương%' OR tieude LIKE '%anh%' OR tieude LIKE '%em%' OR ten_bhat LIKE '%yêu%' OR ten_bhat LIKE '%thương%' OR ten_bhat LIKE '%anh%' OR ten_bhat LIKE '%em%';

-- i. Tạo 1 view có tên vw_Music để hiển thị thông tin về Danh sách các bài viết kèm theo Tên thể loại và tên tác giả (2 đ)
CREATE VIEW vw_Music AS
SELECT bv.ma_bviet, bv.tieude, bv.ten_bhat, tg.ten_tgia, tl.ten_tloai, bv.ngayviet
FROM baiviet bv
JOIN tacgia tg ON bv.ma_tgia = tg.ma_tgia
JOIN theloai tl ON bv.ma_tloai = tl.ma_tloai;

-- j. Tạo 1 thủ tục có tên sp_DSBaiViet với tham số truyền vào là Tên thể loại và trả về danh sách Bài viết của thể loại đó. Nếu thể loại không tồn tại thì hiển thị thông báo lỗi. (2 đ)
DELIMITER //
CREATE PROCEDURE sp_DSBaiViet(IN p_ten_tloai VARCHAR(50))
BEGIN
    DECLARE v_tloai_id INT;
    
    SELECT ma_tloai INTO v_tloai_id FROM theloai WHERE ten_tloai = p_ten_tloai;
    
    IF v_tloai_id IS NOT NULL THEN
        SELECT * FROM baiviet WHERE ma_tloai = v_tloai_id;
    ELSE
        SELECT 'Thể loại không tồn tại' AS ErrorMsg;
    END IF;
END //
DELIMITER ;

-- k. Thêm mới cột SLBai Viet vào trong bảng theloai. Tạo 1 trigger có tên tg_CapNhatTheLoai để khi thêm/sửa/xóa bài viết thì số lượng bài viết trong bảng theloai được cập nhật theo. (2 đ)
-- Thêm cột
ALTER TABLE theloai ADD COLUMN SLBaiViet INT DEFAULT 0;

-- Tạo trigger
DELIMITER //
CREATE TRIGGER tg_CapNhatTheLoai
AFTER INSERT ON baiviet
FOR EACH ROW
BEGIN
    UPDATE theloai
    SET SLBaiViet = SLBaiViet + 1
    WHERE ma_tloai = NEW.ma_tloai;
END;
//
DELIMITER ;

-- i. Bổ sung thêm bảng Users để lưu thông tin Tài khoản đăng nhập và sử dụng cho chức năng Đăng nhập/Quản trị trang web. (5 đ)
CREATE TABLE Users (
    user_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,	
    password VARCHAR(255) NOT NULL, -- Hashed password
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);