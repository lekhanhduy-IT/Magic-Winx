// send_key.php
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $key = $_POST['key'];

    // Đảm bảo chỉ nhận phím trái hoặc phải
    if ($key === 'left' || $key === 'right') {
        // Gửi lệnh giả lập phím bằng shell
        if ($key === 'left') {
            shell_exec("xdotool key Left"); // Linux: giả lập phím mũi tên trái
        } else {
            shell_exec("xdotool key Right"); // Linux: giả lập phím mũi tên phải
        }

        echo "Đã gửi phím $key";
    } else {
        echo "Phím không hợp lệ.";
    }
} else {
    echo "Chỉ chấp nhận POST.";
}
