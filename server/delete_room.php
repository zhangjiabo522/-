<?php
session_start();
if (!isset($_SESSION['username'])) {
    die('未登录');
}

$roomId = $_POST['room_id'];
$username = $_SESSION['username'];

$rooms = file_exists('rooms.json') ? json_decode(file_get_contents('rooms.json'), true) : [];

foreach ($rooms as $key => $room) {
    // 管理员或房主可以删除房间
    if ($room['id'] === $roomId && ($room['owner'] === $username || in_array($username, ['zjb', 'Wzh']))) {
        unset($rooms[$key]);
        file_put_contents('rooms.json', json_encode(array_values($rooms))); // 更新房间文件
        header('Location: ../chatroom.html');
        exit;
    }
}

die('无权限删除此房间');
?>