<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['room_id'])) {
    die(json_encode(['error' => '未登录或未选择房间']));
}

$message = trim($_POST['message']);
$username = $_SESSION['username'];
$roomId = $_SESSION['room_id'];

if ($message === '') {
    die(json_encode(['error' => '消息不能为空']));
}

$messages = file_exists('messages.json') ? json_decode(file_get_contents('messages.json'), true) : [];
if (!isset($messages[$roomId])) {
    $messages[$roomId] = [];
}

// 保存消息
$newMessage = [
    'username' => $username,
    'message' => htmlspecialchars($message),
    'timestamp' => date('Y-m-d H:i:s'),
];

$messages[$roomId][] = $newMessage;

// 添加文件锁以防止写入冲突
if (file_put_contents('messages.json', json_encode($messages), LOCK_EX) === false) {
    die(json_encode(['error' => '无法保存消息']));
}

echo json_encode(['success' => true, 'message' => $newMessage]);
?>