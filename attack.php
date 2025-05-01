<?php
session_start();
file_put_contents('attack.json', json_encode([
    'attacker_id' => $_SESSION['user_id'],
    'target_id' => $_POST['target_id'],
    'timestamp' => time()
]));
echo "ok";
?>
