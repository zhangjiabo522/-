document.addEventListener('DOMContentLoaded', () => {
    const roomList = document.getElementById('room-list');

    // 获取当前登录用户
    let currentUser = '';
    fetch('server/current_user.php')
        .then(response => response.text())
        .then(user => {
            currentUser = user.trim();
        });

    // 加载房间列表
    function loadRooms() {
        fetch('server/rooms.json')
            .then(response => response.json())
            .then(rooms => {
                roomList.innerHTML = '';
                rooms.forEach(room => {
                    const roomDiv = document.createElement('div');
                    roomDiv.classList.add('room');

                    let roomHTML = `
                        <div class="room-info">
                            <strong>${room.name}</strong>
                            ${room.password ? '<span class="encrypted">加密</span>' : ''}
                        </div>
                        <form action="server/enter_room.php" method="POST" class="room-actions">
                            <input type="hidden" name="room_id" value="${room.id}">
                            ${room.password ? '<input type="password" name="room_password" placeholder="房间密码">' : ''}
                            <button type="submit">进入房间</button>
                        </form>
                    `;

                    // 管理员和房主显示删除按钮
                    if (currentUser === 'zjb' || currentUser === 'Wzh' || currentUser === room.owner) {
                        roomHTML += `
                            <form action="server/delete_room.php" method="POST" class="delete-room-form">
                                <input type="hidden" name="room_id" value="${room.id}">
                                <button type="submit" class="delete-button">删除</button>
                            </form>
                        `;
                    }

                    roomDiv.innerHTML = roomHTML;
                    roomList.appendChild(roomDiv);
                });
            });
    }

    // 初次加载房间列表
    loadRooms();
    setInterval(loadRooms, 50); // 定期刷新房间列表
});