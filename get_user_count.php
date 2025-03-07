<?php
header('Content-Type: application/json');

// 用户数据文件路径
$file = 'server/users.json';

// 检查文件是否存在
if (!file_exists($file)) {
    echo json_encode(['count' => 0, 'error' => '用户文件不存在']);
    exit;
}

// 读取用户数据
$data = file_get_contents($file);
$users = json_decode($data, true);

// 检查 JSON 是否解析成功
if ($users === null) {
    echo json_encode(['count' => 0, 'error' => '用户数据格式错误']);
    exit;
}

// 计算用户数量
$user_count = count($users);

// 返回用户数量
echo json_encode(['count' => $user_count]);
?>