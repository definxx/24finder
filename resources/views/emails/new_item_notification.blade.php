<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>New Item Available</title>
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
      background: #e2e8f0;
      color: #333;
      line-height: 1.6;
      padding: 10px;
    }

    /* Main Wrapper */
    .email-container {
      max-width: 600px;
      margin: 20px auto;
      background: #ffffff;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      padding: 20px;
      text-align: center;
    }

    /* Header */
    h1 {
      color: #2c3e50;
      margin-bottom: 10px;
    }

    /* Section */
    p {
      margin: 8px 0;
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

    /* Footer */
    .footer {
      font-size: 12px;
      color: #777;
      margin-top: 20px;
    }

  </style>
</head>
<body>
  <div class="email-container">
    <h1>New Item Available: {{ $itemTitle }}</h1>
    <p>Category: {{ $itemCategory }}</p>
    <p>Description: {{ $itemDescription }}</p>
    <p>Don't miss out on this item! Visit <a href="24finder.ng" class="btn">24Finder Now</a></p>
    <div class="footer">
      <p>If you are not interested in these notifications, you can unsubscribe anytime.</p>
    </div>
  </div>
</body>
</html>
