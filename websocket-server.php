<?php
require dirname(__DIR__) . '/Winx/vendor/autoload.php'; // Đảm bảo thư viện Ratchet được load đúng

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    public function onOpen(ConnectionInterface $conn) {
        echo "Mới kết nối: ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        echo "Message từ {$from->resourceId}: $msg\n";
        
        // Phát message đến tất cả client
        foreach ($from->httpRequest->getConnection()->getConnections() as $client) {
            if ($from !== $client) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        echo "Đóng kết nối: ({$conn->resourceId})\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Lỗi: {$e->getMessage()}\n";
        $conn->close();
    }
}

// Tạo WebSocket server
$server = new Ratchet\App('localhost', 8080);
$server->route('/chat', new Chat, ['*']);
$server->run();
