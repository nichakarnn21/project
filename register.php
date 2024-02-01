<?php
$mysqli = new mysqli("localhost", "root", "12345678", "library");

if ($mysqli->connect_error) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST["student_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $year = $_POST["year"];
    $department = $_POST["department"];
    $phone = $_POST["phone"];
    $birthdate = $_POST["birthdate"];

    $sql = "INSERT INTO members (student_id, first_name, last_name, year, department, phone, birthdate) 
            VALUES ('$student_id', '$first_name', '$last_name', '$year', '$department', '$phone', '$birthdate')";

    if ($mysqli->query($sql) === TRUE) {
        header("Location: login.php");
    } else {
        echo "เกิดข้อผิดพลาด: " . $mysqli->error;
    }

    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2e0ff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .registration-container {
            width: 400px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .registration-container h2 {
            text-align: center;
            color: #333;
        }

        .registration-form {
            text-align: center;
        }

        .registration-form label {
            display: block;
            margin-bottom: 5px;
            text-align: left;
            color: #333;
        }

        .registration-form input {
            width: 80%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .registration-form button {
            width: 50%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .registration-form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="registration-container">
        <h2>สมัครสมาชิก</h2>
        <form class="registration-form" method="post" action="">
            
            <input type="text" name="student_id" placeholder="รหัสนักศึกษา" required><br>
            
            <input type="text" name="first_name" placeholder="ชื่อ" required><br>
            
            <input type="text" name="last_name" placeholder="นามสกุล" required><br>
            
            <input type="text" name="year" placeholder="ชั้นปี" required><br>
            
            <input type="text" name="department" placeholder="แผนก" required><br>
            
            <input type="text" name="phone" placeholder="เบอร์โทร" required><br>
            
            <input type="date" name="birthdate" required><br>
            <button type="submit">สมัครสมาชิก</button><br><br>
            <button class="btn btn-info btn-rounded" onclick="location.href='login.php'">เข้าสู่ระบบ</button><br>
        </form>
    </div>
</body>
</html>

