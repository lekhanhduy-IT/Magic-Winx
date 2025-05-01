<!-- control.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Remote Arrow Control</title>
    <style>
        body {
            text-align: center;
            font-family: Arial;
        }
        button {
            font-size: 24px;
            margin: 20px;
            padding: 15px 30px;
        }
    </style>
</head>
<body>

<h1>Remote Arrow Control</h1>

<button onclick="sendKey('left')">← Home</button>
<button onclick="sendKey('right')">→ End</button>

<script>
function sendKey(key) {
    fetch('send_key.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'key=' + key
    }).then(res => res.text()).then(alert);
}
</script>

</body>
</html>
