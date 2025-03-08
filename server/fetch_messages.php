<?php
session_start();
if (!isset($_SESSION['room_id'])) {
    die(json_encode(['error' => '未选择房间']));
}

$roomId = $_SESSION['room_id'];
$messages = file_exists('messages.json') ? json_decode(file_get_contents('messages.json'), true) : [];

if (isset($messages[$roomId])) {
    foreach ($messages[$roomId] as &$message) {
        // 管理员的名字显示为红色
        if (in_array($message['username'], ['zjb', 'Wzh'])) {
            $message['username'] = "<span class='admin'>{$message['username']}</span>";
        }
    }
    echo json_encode(['messages' => $messages[$roomId]]);
} else {
    echo json_encode(['messages' => []]);
}
?>