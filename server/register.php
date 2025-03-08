
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $file = 'users.json';
    $ip_file = 'ip_log.json';

    // 加载 IP 日志数据
    $ip_log = [];
    if (file_exists($ip_file)) {
        $ip_log = json_decode(file_get_contents($ip_file), true);
    }

    // 检查 IP 是否被封禁
    $current_time = time();
    if (isset($ip_log[$ip_address]) && $ip_log[$ip_address] > $current_time) {
        die('您的 IP 地址已被暂时封禁，请稍后再试。');
    }

    // 加载用户数据
    $users = [];
    if (file_exists($file)) {
        $users = json_decode(file_get_contents($file), true);
    }

    // 检查用户名是否已存在
    if (isset($users[$username])) {
        die('用户名已存在，请选择其他用户名。');
    }

    // 保存新用户数据
    $users[$username] = $password;
    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));

    echo '注册成功！';
}
?>
