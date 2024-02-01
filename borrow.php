<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_code = $_POST["book_code"];
    $book_title = $_POST["book_title"];
    $author = $_POST["author"];
    $publication_year = $_POST["publication_year"];
    $image_url = $_POST["image_url"];

    
   $mysqli = new mysqli("localhost", "root", "12345678", "library");

    if ($mysqli->connect_error) {
        die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $mysqli->connect_error);
    }

   
    $sql_check_book = "SELECT id FROM books WHERE book_code = '$book_code'";
    $result_check_book = $mysqli->query($sql_check_book);

    if ($result_check_book->num_rows == 0) {
       
        $sql_add_book = "INSERT INTO books (book_code, title, author, publication_year, image_url) 
                         VALUES ('$book_code', '$book_title', '$author', '$publication_year', '$image_url')";
        if ($mysqli->query($sql_add_book) === TRUE) {
            echo "เพิ่มหนังสือเรียบร้อยแล้ว";
        } else {
            echo "เกิดข้อผิดพลาดในการเพิ่มหนังสือ: " . $mysqli->error;
        }
    }


    $sql_get_book_id = "SELECT id FROM books WHERE book_code = '$book_code'";
    $result_get_book_id = $mysqli->query($sql_get_book_id);
    $row = $result_get_book_id->fetch_assoc();
    $book_id = $row["id"];

    $sql = "INSERT INTO loans (member_id, book_id, loan_date) 
            VALUES ('$user_id', '$book_id', '$loan_date')";

    if ($mysqli->query($sql) === TRUE) {
        echo "ยืมหนังสือเรียบร้อยแล้ว";
    } else {
        echo "เกิดข้อผิดพลาดในการยืมหนังสือ: " . $mysqli->error;
    }

    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ยืมหนังสือ</title>
    
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mt-4">
                <img src="image/y.png" alt="โลโก้" class="img-fluid" style="max-width: 100%;" />
            </div>
        </div>

        <div class="h4 text-center alert alert-info my-4" role="alert">ยืมหนังสือ</div>

        <form method="post" action="">
            <div class="mb-3">
                <label for="book_code" class="form-label">รหัสหนังสือ</label>
                <input type="text" name="book_code" class="form-control" id="book_code" placeholder="รหัสหนังสือ" required>
            </div>
            <div class="mb-3">
                <label for="book_title" class="form-label">ชื่อหนังสือ</label>
                <input type="text" name="book_title" class="form-control" id="book_title" placeholder="ชื่อหนังสือ" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">ชื่อผู้แต่ง</label>
                <input type="text" name="author" class="form-control" id="author" placeholder="ชื่อผู้แต่ง" required>
            </div>
            <div class="mb-3">
                <label for="publication_year" class="form-label">ปีที่พิมพ์</label>
                <input type="number" name="publication_year" class="form-control" id="publication_year" placeholder="ปีที่พิมพ์" required>
            </div>
            <div class="mb-3">
                <label for="loan_date" class="form-label">วันที่ยืมหนังสือ</label>
                <input type="date" name="loan_date" class="form-control" id="loan_date" required>
            </div>
            <button type="submit" class="btn btn-warning">ยืมหนังสือ</button>
        </form>

        <div class="text-center mt-4">
            <a href="dashboard.php" class="btn btn-info">กลับสู่หน้าหลัก</a>
        </div>
    </div>

   
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>




