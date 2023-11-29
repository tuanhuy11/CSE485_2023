-- b.Liệt kê các bài viết của tác giả “Nhacvietplus” (2 đ)
select * from baiviet inner join tacgia
on tacgia.ma_tgia=baiviet.ma_tgia
where tacgia.ten_tgia='Nhacvietplus'
-- f.Liệt kê 2 tác giả có số bài viết nhiều nhất (2 đ)
select ma_tgia,ten_tgia from tacgia 
WHERE ma_tgia IN (
select ma_tgia from baiviet
group by ma_tgia
order by count(ma_bviet) DESC
) 
LIMIT 2
-- j.Tạo 1 thủ tục có tên sp_DSBaiViet với tham số truyền vào là Tên thể loại
-- và trả về danh sách Bài viết của thể loại đó. Nếu thể loại không tồn tại thì hiển thị thông báo lỗi. (2 đ)
DELIMITER //

CREATE PROCEDURE sp_DSBaiViet(IN tentl CHAR(50))
BEGIN
    DECLARE tloai_id INT;
    DECLARE no_exist BOOLEAN DEFAULT TRUE;

    -- Lấy ID của thể loại dựa trên tên thể loại
    SELECT ma_tloai INTO tloai_id FROM theloai WHERE ten_tloai = tentl;

    -- Kiểm tra xem thể loại có tồn tại không
    IF tloai_id IS NOT NULL THEN
        -- Nếu thể loại tồn tại, hiển thị danh sách bài viết của thể loại đó
        SELECT * FROM baiviet WHERE ma_tloai = tloai_id;
        SET no_exist = FALSE;
    END IF;

    -- Nếu thể loại không tồn tại, hiển thị thông báo lỗi
    IF no_exist THEN
        SELECT 'Thể loại không tồn tại' AS Error_Message;
    END IF;
END //

DELIMITER ;
CALL sp_DSBaiViet('Tên thể loại');
