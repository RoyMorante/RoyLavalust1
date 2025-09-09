<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Student</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
body {
    font-family: 'Inter', sans-serif;
    background: #f0f2f5;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}
.container {
    background: #fff;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    width: 100%;
    max-width: 480px;
    text-align: center;
    transition: transform 0.2s ease;
}
.container:hover {
    transform: translateY(-5px);
}
h2 {
    font-size: 26px;
    color: #2c3e50;
    margin-bottom: 25px;
}
form {
    text-align: left;
}
label {
    font-weight: 600;
    display: block;
    margin-bottom: 6px;
    color: #2c3e50;
}
input[type="text"],
input[type="email"],
input[type="password"],
input[type="file"] {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-bottom: 18px;
    font-size: 15px;
    transition: border 0.3s, box-shadow 0.3s;
}
input:focus {
    border-color: #2575fc;
    box-shadow: 0 0 6px rgba(37,117,252,0.3);
    outline: none;
}
button[type="submit"] {
    width: 100%;
    padding: 14px;
    background: #2575fc;
    border: none;
    border-radius: 8px;
    color: #fff;
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s;
}
button[type="submit"]:hover {
    background: #1a5ed9;
}
.photo-preview {
    margin: 10px 0 18px;
    text-align: center;
}
.photo-preview img {
    border: 2px solid #2575fc;
    border-radius: 8px;
    padding: 3px;
    max-width: 100px;
}
.back-link {
    display: inline-block;
    margin-top: 20px;
    color: #2575fc;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.3s;
}
.back-link:hover {
    color: #1a5ed9;
    text-decoration: underline;
}
</style>
</head>
<body>
<div class="container">
    <h2>✏️ Edit Student</h2>

    <form method="post" action="/students/update/<?= (int) $user['id'] ?>" enctype="multipart/form-data">
        <label>First Name:</label>
        <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>

        <label>Last Name:</label>
        <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

        <label>Password (leave blank to keep current):</label>
        <input type="password" name="password">

        <label>Photo:</label>
        <?php if (!empty($user['photo'])): ?>
            <div class="photo-preview">
                <img src="<?= $upload_url . htmlspecialchars($user['photo']) ?>" alt="Student Photo">
            </div>
        <?php endif; ?>
        <input type="file" name="photo" accept="image/*">

        <button type="submit">💾 Update Student</button>
    </form>

    <a class="back-link" href="/students/get-all">⬅ Back to List</a>
</div>
</body>
</html>
