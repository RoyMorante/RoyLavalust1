<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #f0f2f5, #d9e0ec);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .login-wrapper {
      display: flex;
      width: 100%;
      max-width: 960px;
      background: #ffffff;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 20px 50px rgba(0,0,0,0.1);
      animation: fadeIn 0.8s ease forwards;
    }

    .login-image {
      flex: 1;
      background: url('/public/bg.jpg') no-repeat center/cover;
      min-height: 500px;
    }

    .login-form {
      flex: 1;
      padding: 60px 50px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      background: #ffffff;
      animation: slideIn 0.8s ease forwards;
    }

    .login-form h2 {
      font-size: 28px;
      font-weight: 700;
      color: #2c3e50;
      margin-bottom: 8px;
      text-align: center;
    }

    .login-form p.subtext {
      font-size: 14px;
      color: #666;
      text-align: center;
      margin-bottom: 32px;
    }

    .form-group {
      position: relative;
      margin-bottom: 20px;
    }

    .form-group input {
      width: 100%;
      padding: 16px 50px 16px 16px;
      border: 1px solid #ccd1d9;
      border-radius: 10px;
      font-size: 16px;
      background-color: #fafbfc;
      transition: 0.3s;
    }

    .form-group input:focus {
      border-color: #2575fc;
      box-shadow: 0 0 8px rgba(37, 117, 252, 0.3);
      outline: none;
      background-color: #fff;
    }

    .form-group i {
      position: absolute;
      right: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #888;
      font-size: 18px;
    }

    .login-form button {
      display: block;
      width: 100%;
      margin-top: 10px;
      padding: 16px;
      background: linear-gradient(to right, #2575fc, #6a11cb);
      border: none;
      border-radius: 10px;
      color: #fff;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s ease;
      text-align: center;
    }

    .login-form button:hover {
      opacity: 0.95;
      box-shadow: 0 6px 20px rgba(37, 117, 252, 0.4);
    }

    .login-form .error {
      color: #e74c3c;
      background: #fdecea;
      padding: 10px 15px;
      border-radius: 6px;
      font-size: 14px;
      text-align: center;
      margin-bottom: 18px;
    }

    @keyframes fadeIn {
      0% { opacity: 0; transform: scale(0.95); }
      100% { opacity: 1; transform: scale(1); }
    }

    @keyframes slideIn {
      0% { opacity: 0; transform: translateY(30px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    /* Responsive Design */
    @media (max-width: 900px) {
      .login-wrapper {
        flex-direction: column;
        max-width: 100%;
        box-shadow: none;
        border-radius: 0;
      }

      .login-image {
        height: 250px;
      }

      .login-form {
        padding: 40px 30px;
      }

      .login-form h2 {
        font-size: 24px;
      }
    }
  </style>
  <!-- FontAwesome for icons -->
  <script src="https://kit.fontawesome.com/yourkit.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="login-wrapper">
    <div class="login-image"></div>
    <div class="login-form">
      <h2>Sign In</h2>
      <p class="subtext">Access your account using your email and password.</p>

      <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>

      <form method="post" action="/auth/login">
        <div class="form-group">
          <input type="email" name="email" placeholder="Email Address" required>
          <i class="fas fa-envelope"></i>
        </div>
        <div class="form-group">
          <input type="password" name="password" placeholder="Password" required>
          <i class="fas fa-lock"></i>
        </div>
        <button type="submit">Sign In</button>
      </form>
    </div>
  </div>
</body>
</html>
