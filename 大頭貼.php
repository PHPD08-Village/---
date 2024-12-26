<?php
$host = 'localhost';
$dbname = 'v1';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

$user_id = 39;  // 假设你要查找 ID 为 1 的用户

$sql = "SELECT avatar FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $avatarUrl =   $user['avatar'];  // 如果存储的是文件名
} else {
    $avatarUrl = 'images/default-avatar.jpg';  // 如果用户没有头像，显示默认头像
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <h1>User Profile</h1>
    
    <img src="<?php echo htmlspecialchars($avatarUrl); ?>" alt="User Avatar" />
</body>
</html>
