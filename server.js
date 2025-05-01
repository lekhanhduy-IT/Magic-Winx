const WebSocket = require('ws');
const wss = new WebSocket.Server({ port: 8888 });

wss.on('connection', ws => {
    // Gửi dữ liệu hiện tại cho client khi kết nối
    wss.clients.forEach(client => {
        if (client !== ws && client.readyState === WebSocket.OPEN) {
            client.send(JSON.stringify({ type: 'user_connected', message: 'A user has joined the chat' }));
        }
    });

    ws.on('message', message => {
        const data = JSON.parse(message);

        // Gửi dữ liệu đến tất cả client khác
        wss.clients.forEach(client => {
            if (client.readyState === WebSocket.OPEN) {
                client.send(JSON.stringify(data));
            }
        });
    });
});


console.log("WebSocket server đang chạy tại ws://localhost:8888");
