<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .email-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .email-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
            white-space: nowrap; /* Ngăn ngừng xuống dòng */
            overflow: hidden; /* Ẩn phần nội dung bị tràn */
            text-overflow: ellipsis; /* Hiển thị dấu ... khi tràn */
            max-width: 360px; /* Độ rộng tối đa của liên kết */
        }
        }
        .email-link:hover {
            background-color: #0056b3;
        }
        .email-footer {
            text-align: center;
            margin-top: 20px;
            color: #888888;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <h2>Xin chào,</h2>
    </div>
    <p>Bạn đã yêu cầu đặt lại mật khẩu cho tài khoản của mình. Để hoàn tất, vui lòng nhấp vào liên kết dưới đây:</p>
    <a class="email-link" href="{{ $link }}" target="_blank">{{ $link }}</a>
    <p>Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.</p>
    <div class="email-footer">
        <p>Trân trọng,</p>
        <p>Đội ngũ của chúng tôi</p>
    </div>
</div>
</body>
</html>
