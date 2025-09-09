<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #f0f2f5, #d9e0ec);
      min-height: 100vh;
      padding: 40px 20px;
    }

    .dashboard-container {
      max-width: 700px;
      margin: 0 auto;
      animation: fadeIn 0.8s ease forwards;
    }

    h2 {
      text-align: center;
      color: #2c3e50;
      font-size: 32px;
      font-weight: 700;
      margin-bottom: 40px;
    }

    .card-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 24px;
    }

    .card {
      background: #ffffff;
      padding: 30px 25px;
      border-radius: 16px;
      box-shadow: 0 12px 30px rgba(0,0,0,0.08);
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      animation: slideUp 0.8s ease forwards;
    }

    .card:hover {
      transform: translateY(-6px);
      box-shadow: 0 15px 35px rgba(0,0,0,0.12);
    }

    .card h3 {
      margin-bottom: 12px;
      font-size: 20px;
      font-weight: 600;
      color: #2575fc;
    }

    .card p {
      color: #555;
      font-size: 14px;
      margin-bottom: 18px;
      line-height: 1.4;
    }

    .card a {
      display: inline-block;
      padding: 10px 16px;
      background: linear-gradient(to right, #2575fc, #6a11cb);
      color: #fff;
      border-radius: 8px;
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      transition: 0.3s ease;
    }

    .card a:hover {
      opacity: 0.95;
      box-shadow: 0 6px 20px rgba(37,117,252,0.4);
    }

    .actions {
      text-align: center;
      margin-top: 40px;
    }

    .actions a {
      display: inline-block;
      padding: 12px 22px;
      background: #e74c3c;
      color: white;
      border-radius: 10px;
      text-decoration: none;
      font-weight: 600;
      font-size: 15px;
      transition: 0.3s;
    }

    .actions a:hover {
      background: #c0392b;
      box-shadow: 0 6px 18px rgba(231,76,60,0.4);
    }

    @keyframes fadeIn {
      0% { opacity: 0; transform: scale(0.96); }
      100% { opacity: 1; transform: scale(1); }
    }

    @keyframes slideUp {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <h2>User Dashboard</h2>

    <div class="card-grid">
      <div class="card">
        <h3>📄 Profile</h3>
        <p>View and manage your personal information.</p>
        <a href="/user/profile">Go to Profile</a>
      </div>
    </div>

    <div class="actions">
      <a href="/auth/logout">🚪 Logout</a>
    </div>
  </div>
</body>
</html>
