<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Profile</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Inter', sans-serif;
        background: #f0f2f5;
        padding: 40px;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
    .profile-container {
        background: #fff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        max-width: 500px;
        width: 100%;
        text-align: center;
        transition: transform 0.2s;
    }
    .profile-container:hover {
        transform: translateY(-5px);
    }
    h2 {
        color: #2c3e50;
        margin-bottom: 20px;
    }
    .profile-photo img {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 20px;
        border: 4px solid #2575fc;
    }
    .profile-info {
        text-align: left;
        margin: 20px 0;
    }
    .profile-info p {
        font-size: 15px;
        margin: 10px 0;
        color: #555;
    }
    .profile-info strong {
        color: #2c3e50;
    }
    .actions {
        text-align: center;
        margin-top: 25px;
    }
    .actions a {
        display: inline-block;
        padding: 10px 20px;
        background: #2575fc;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        margin: 5px;
        transition: background 0.3s;
    }
    .actions a:hover {
        background: #1a5ed9;
    }
</style>
</head>
<body>
<div class="profile-container">
    <h2>My Profile</h2>
    <div class="profile-photo">
        <?php if (!empty($user['photo'])): ?>
            <img src="<?= BASE_URL . 'public/uploads/' . htmlspecialchars($user['photo']) ?>" alt="Profile Photo">
        <?php else: ?>
            <img src="https://via.placeholder.com/130?text=No+Photo" alt="No Photo">
        <?php endif; ?>
    </div>
    <div class="profile-info">
        <p><strong>Name:</strong> <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
        <p><strong>Role:</strong> <?= htmlspecialchars($user['role']) ?></p>
    </div>
    <div class="actions">
        <a href="/user/dashboard">🏠 Dashboard</a>
        <a href="/auth/logout">🚪 Logout</a>
    </div>
</div>
</body>
</html>
