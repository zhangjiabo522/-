document.addEventListener('DOMContentLoaded', () => {
    const chatBox = document.getElementById('chat-box');
    const messageForm = document.getElementById('message-form');
    const messageInput = document.getElementById('message');

    // 定期获取消息
    async function fetchMessages() {
        try {
            const response = await fetch('server/fetch_messages.php');
            const data = await response.json();

            if (data.error) {
                chatBox.innerHTML = `<div class="error">${data.error}</div>`;
                return;
            }

            chatBox.innerHTML = ''; // 清空消息框
            data.messages.forEach(msg => {
                const msgDiv = document.createElement('div');
                msgDiv.classList.add('message');
                msgDiv.innerHTML = `
                    <div class="message-header">
                        <strong class="${msg.username.includes('admin') ? 'admin' : ''}">${msg.username}</strong>
                        <span class="timestamp">${msg.timestamp}</span>
                    </div>
                    <div class="message-body">${msg.message}</div>
                `;
                chatBox.appendChild(msgDiv);
            });
            chatBox.scrollTop = chatBox.scrollHeight; // 滚动到底部
        } catch (error) {
            chatBox.innerHTML = `<div class="error">无法加载消息，请稍后再试。</div>`;
        }
    }

    // 发送消息
    messageForm.addEventListener('submit', async e => {
        e.preventDefault();
        const message = messageInput.value.trim();
        if (message === '') return;

        try {
            const response = await fetch('server/save_message.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `message=${encodeURIComponent(message)}`
            });
            const data = await response.json();

            if (data.error) {
                alert(data.error);
            } else if (data.success) {
                messageInput.value = '';
                fetchMessages();
            }
        } catch (error) {
            alert('发送消息时出现问题，请检查网络连接。');
        }
    });

    // 初次加载消息并启动轮询
    fetchMessages();
    setInterval(fetchMessages, 3000);
});
