<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $file = 'users.json';

    // 检查用户文件是否存在
    if (!file_exists($file)) {
        die('用户文件不存在，请先注册！');
    }

    // 加载用户数据
    $users = json_decode(file_get_contents($file), true);

    // 验证用户名和密码
    if (isset($users[$username]) && password_verify($password, $users[$username])) {
        $_SESSION['username'] = $username;
        header('Location: ../chatroom.html'); // 登录成功跳转
        exit;
    }

    echo "用户名或密码错误！<a href='../index.html'>返回登录</a>";
}
?>