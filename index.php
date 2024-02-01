<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ระบบยืม-คืนหนังสือห้องสมุด</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
        .logo-img {
            max-height: 2000px;
        }

        .btn-rounded {
            border-radius: 20px;
        }

        .btn-spacing {
            margin-right: 10px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <img src="image/book.png" alt="Book" class="img-fluid logo-img">
            <div class="mt-4">
                <button class="btn btn-warning btn-rounded btn-spacing" onclick="location.href='register.php'">สมัครสมาชิก</button>
                <button class="btn btn-info btn-rounded" onclick="location.href='login.php'">เข้าสู่ระบบ</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>

