<?php
session_start();
if (!isset($_SESSION['username'])) {
    die('未登录');
}

$roomName = trim($_POST['room_name']);
$roomPassword = trim($_POST['room_password']);
$username = $_SESSION['username'];

$rooms = file_exists('rooms.json') ? json_decode(file_get_contents('rooms.json'), true) : [];

// 检查房间是否已存在
foreach ($rooms as $room) {
    if ($room['name'] === $roomName) {
        die('房间名已存在，请返回重试');
    }
}

// 创建新房间
$rooms[] = [
    'id' => uniqid(),
    'name' => $roomName,
    'password' => $roomPassword,
    'owner' => $username
];

file_put_contents('rooms.json', json_encode($rooms));
header('Location: ../chatroom.html');
?>
