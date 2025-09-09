<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
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
    }
    .wrapper {
        display: flex;
        width: 900px;
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        animation: fadeIn 1s ease;
    }
    .side-image {
        flex: 1;
        background: url('/public/bg.jpg') no-repeat center/cover;
    }
    .form-container {
        flex: 1;
        padding: 50px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        animation: slideIn 1s ease;
    }
    .form-container h2 {
        color: #333;
        font-size: 32px;
        margin-bottom: 30px;
        text-align: center;
    }
    .form-container input {
        width: 100%;
        padding: 14px 15px;
        margin: 12px 0;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s ease;
    }
    .form-container input:focus {
        border-color: #2575fc;
        box-shadow: 0 0 6px rgba(37,117,252,0.3);
        outline: none;
    }
    .form-container button {
        width: 100%;
        padding: 14px;
        margin-top: 20px;
        background: #2575fc;
        color: white;
        font-size: 16px;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .form-container button:hover {
        background: #1a5ed9;
    }
    .form-container p {
        text-align: center;
        margin-top: 18px;
        font-size: 14px;
        color: #555;
    }
    .form-container p a {
        color: #2575fc;
        font-weight: 500;
        text-decoration: none;
    }
    .form-container p a:hover {
        text-decoration: underline;
    }
    .error {
        color: #e74c3c;
        text-align: center;
        margin-bottom: 12px;
        font-size: 14px;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    @keyframes slideIn {
        from { opacity: 0; transform: translateX(50px); }
        to { opacity: 1; transform: translateX(0); }
    }

    @media (max-width: 900px) {
        .wrapper { flex-direction: column; width: 90%; }
        .side-image { height: 200px; }
    }
</style>
</head>
<body>
    <div class="wrapper">
        <div class="side-image"></div>
        <div class="form-container">
            <h2>Create Account</h2>

            <?php if (!empty($error)): ?>
                <p class="error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <form method="post" action="/auth/register" enctype="multipart/form-data">
                <input type="text" name="first_name" placeholder="First Name" required>
                <input type="text" name="last_name" placeholder="Last Name" required>
                <input type="email" name="email" placeholder="Email Address" required>
                <input type="password" name="password" placeholder="Password" required>
                <label style="margin-top:10px;">Profile Photo (optional):</label>
                <input type="file" name="photo" accept="image/*">
                <button type="submit">Register</button>
            </form>

            <p>Already have an account? <a href="/auth/login">Login</a></p>
        </div>
    </div>
</body>
</html>
