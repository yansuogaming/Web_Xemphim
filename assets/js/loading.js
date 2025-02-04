// script.js
window.onload = function() {
    // Giả lập việc tải dữ liệu
    setTimeout(function() {
        document.getElementById('loading').style.display = 'none'; // Ẩn loading
        document.getElementById('content').style.display = 'block'; // Hiển thị nội dung
    }, 2000); // Thay đổi 2000 thành thời gian tải dữ liệu thực tế nếu cần
};
