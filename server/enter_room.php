<?php
session_start();
if (!isset($_SESSION['username'])) {
    die('未登录');
}

$roomId = $_POST['room_id'];
$roomPassword = $_POST['room_password'] ?? '';
$username = $_SESSION['username'];

$rooms = file_exists('rooms.json') ? json_decode(file_get_contents('rooms.json'), true) : [];

foreach ($rooms as $room) {
    if ($room['id'] === $roomId) {
        // 管理员可直接进入加密房间
        if (!empty($room['password']) && $room['password'] !== $roomPassword && !in_array($username, ['zjb', 'Wzh'])) {
            die('密码错误！<a href="../chatroom.html">返回大厅</a>');
        }

        $_SESSION['room_id'] = $roomId;
        header('Location: ../chat.html');
        exit;
    }
}

die('房间不存在');
?>