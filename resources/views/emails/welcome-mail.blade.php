<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Welcome to 24Finder</title>
  <style>
    /* General Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Body Styling */
    body {
      font-family: Arial, Helvetica, sans-serif;
      background: #f0f4f8;
      color: #333;
      line-height: 1.6;
      padding: 20px 10px;
    }

    /* Main Wrapper */
    .email-container {
      max-width: 600px;
      margin: 20px auto;
      background: #ffffff;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      padding: 20px;
      text-align: center;
    }

    /* Header Section */
    h1 {
      color: #2c3e50;
      margin-bottom: 10px;
    }

    /* Message */
    p {
      margin: 10px 0;
      font-size: 16px;
      color: #555;
    }

    /* Button */
    .btn {
      display: inline-block;
      padding: 10px 20px;
      margin: 20px 0;
      text-decoration: none;
      background: #3498db;
      color: white;
      border-radius: 5px;
      transition: background 0.3s ease;
    }

    .btn:hover {
      background: #2980b9;
    }

    /* Footer Section */
    .footer {
      font-size: 12px;
      margin-top: 20px;
      color: #777;
    }

    /* Responsiveness */
    @media (max-width: 480px) {
      .email-container {
        padding: 10px;
      }

      p {
        font-size: 14px;
      }

      h1 {
        font-size: 24px;
      }
    }
  </style>
</head>
<body>
  <!-- Email Container -->
  <div class="email-container">
    <!-- Header Section -->
    <h1>Welcome, {{$name}}!</h1>
    <hr style="border: 1px solid #3498db; width: 50%; margin-bottom: 20px;" />

    <!-- Main Message -->
    <p style="font-size: 18px; color: #555;">{{$mailmessage}}</p>
    <p>We're thrilled to have you join us at 24Finder.</p>
    <p>Thank you for signing up! Let’s get started.</p>

    <!-- Call to Action -->
    <a href="https://24finder.ng/login" class="btn">Explore Now</a>

    <!-- Footer Section -->
    <div class="footer">
      <p>If you did not sign up for 24Finder, please ignore this email.</p>
      <p>&copy; 2024 24Finder. All Rights Reserved.</p>
    </div>
  </div>
</body>
</html>
