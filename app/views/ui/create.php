<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Student</title>
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

    .form-card {
      width: 100%;
      max-width: 500px;
      background: #ffffff;
      border-radius: 16px;
      padding: 40px 50px;
      box-shadow: 0 20px 50px rgba(0,0,0,0.1);
      animation: fadeIn 0.8s ease forwards;
    }

    .form-card h2 {
      font-size: 28px;
      font-weight: 700;
      color: #2c3e50;
      text-align: center;
      margin-bottom: 10px;
    }

    .form-card p.subtext {
      text-align: center;
      font-size: 14px;
      color: #666;
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 18px;
    }

    .form-group label {
      display: block;
      font-weight: 600;
      margin-bottom: 6px;
      color: #2c3e50;
    }

    .form-group input {
      width: 100%;
      padding: 14px 16px;
      border: 1px solid #ccd1d9;
      border-radius: 10px;
      font-size: 15px;
      background-color: #fafbfc;
      transition: 0.3s;
    }

    .form-group input:focus {
      border-color: #2575fc;
      box-shadow: 0 0 8px rgba(37, 117, 252, 0.3);
      outline: none;
      background-color: #fff;
    }

    .form-card button {
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

    .form-card button:hover {
      opacity: 0.95;
      box-shadow: 0 6px 20px rgba(37, 117, 252, 0.4);
    }

    .form-card .error {
      color: #e74c3c;
      background: #fdecea;
      padding: 10px 15px;
      border-radius: 6px;
      font-size: 14px;
      text-align: center;
      margin-bottom: 18px;
    }

    .back-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
      color: #2575fc;
      font-weight: 600;
      text-decoration: none;
      transition: 0.3s;
    }

    .back-link:hover {
      text-decoration: underline;
    }

    @keyframes fadeIn {
      0% { opacity: 0; transform: scale(0.95); }
      100% { opacity: 1; transform: scale(1); }
    }
  </style>
</head>
<body>
  <div class="form-card">
    <h2>Add Student</h2>
    <p class="subtext">Fill in the form below to add a new student</p>

    <?php if (!empty($error_message)): ?>
      <div class="error"><?= $error_message ?></div>
    <?php endif; ?>

    <form method="post" action="/students/create" enctype="multipart/form-data">
      <div class="form-group">
        <label>First Name:</label>
        <input type="text" name="first_name" required value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>">
      </div>

      <div class="form-group">
        <label>Last Name:</label>
        <input type="text" name="last_name" required value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>">
      </div>

      <div class="form-group">
        <label>Email:</label>
        <input type="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
      </div>

      <div class="form-group">
        <label>Password:</label>
        <input type="password" name="password" required>
      </div>

      <div class="form-group">
        <label>Photo:</label>
        <input type="file" name="photo" accept="image/*">
      </div>

      <button type="submit">Save Student</button>
    </form>

    <a class="back-link" href="/students/get-all">⬅ Back to List</a>
  </div>
</body>
</html>
