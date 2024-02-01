<?php
$mysqli = new mysqli("localhost", "root", "12345678", "library");

if ($mysqli->connect_error) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST["student_id"];
    $birthdate = $_POST["birthdate"];

    $sql = "SELECT * FROM members WHERE student_id = '$student_id' AND birthdate = '$birthdate'";
    $result = $mysqli->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $user_id = $row["id"];
        session_start();
        $_SESSION["user_id"] = $user_id;
        header("Location: dashboard.php");
    } else {
        echo "ล็อคอินล้มเหลว";
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ล็อกอิน</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #c4cef2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            width: 350px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .login-container h2 {
            text-align: center;
            color: #333;
        }

        .login-form {
            text-align: center;
        }

        .login-form input {
            width: 80%;
            padding: 10px;
            margin: 20px 0;
            border: 2px solid #ccc;
            border-radius: 3px;
        }

        .login-form button {
            width: 60%;
            padding: 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .login-form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>ล็อกอิน</h2>
        <form class="login-form" method="post" action="">
            <label></label>
            <input type="text" name="student_id" placeholder="รหัสนักศึกษา" required><br>
            <label></label>
            <input type="date" name="birthdate" required><br>
            <button type="submit">เข้าสู่ระบบ</button><br><br>
            <button class="btn btn-warning btn-rounded btn-spacing" onclick="location.href='register.php'">สมัครสมาชิก</button>
        </form>
    </div>
</body>
</html>

