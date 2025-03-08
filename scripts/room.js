document.addEventListener('DOMContentLoaded', () => {
    // 假设当前登录用户
    const currentUser = 'currentLoggedInUser';  // 你可以动态设置为当前登录用户
    const isAdmin = (currentUser === 'zjb' || currentUser === 'Wzh');  // 判断是否为管理员

    // 模拟房间数据
    let rooms = [
        { id: 1, name: '房间1', owner: 'user1' },
        { id: 2, name: '房间2', owner: 'user2' },
        { id: 3, name: '房间3', owner: 'zjb' },
        // 添加更多房间数据
    ];

    const roomList = document.getElementById('room-list');
    const createRoomButton = document.getElementById('create-room-btn');

    // 获取并显示所有房间
    function fetchRooms() {
        roomList.innerHTML = '';  // 清空当前房间列表

        rooms.forEach(room => {
            const roomDiv = document.createElement('div');
            roomDiv.classList.add('room');
            
            roomDiv.innerHTML = `
                <span class="room-name">${room.name} (房主: ${room.owner})</span>
                ${room.owner === currentUser || isAdmin ? `<button class="delete-btn" data-room-id="${room.id}">删除</button>` : ''}
            `;

            // 为房主或管理员添加删除功能
            if (room.owner === currentUser || isAdmin) {
                roomDiv.querySelector('.delete-btn').addEventListener('click', () => {
                    deleteRoom(room.id);
                });
            }

            roomList.appendChild(roomDiv);
        });
    }

    // 删除房间
    function deleteRoom(roomId) {
        if (!confirm('确定要删除这个房间吗？')) return;

        // 根据房间ID删除房间
        rooms = rooms.filter(room => room.id !== roomId);
        fetchRooms();  // 刷新房间列表
    }

    // 创建房间
    function createRoom(roomName) {
        const newRoom = {
            id: rooms.length + 1,
            name: roomName,
            owner: currentUser
        };
        rooms.push(newRoom);
        fetchRooms();  // 刷新房间列表
    }

    // 监听创建房间按钮
    createRoomButton.addEventListener('click', () => {
        const roomName = prompt('请输入房间名');
        if (roomName) {
            createRoom(roomName);
        }
    });

    // 初次加载房间并启动轮询
    fetchRooms();
});