<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_name = $_SESSION["user_name"];
$user_id = $_SESSION["user_id"];

//$mysqli = new mysqli("localhost", "root", "12345678", "library");

if ($mysqli->connect_error) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $mysqli->connect_error);
}


$sql = "SELECT loans.id AS loan_id, books.title AS book_title, loans.loan_date, loans.return_date, loans.fine
        FROM loans
        INNER JOIN books ON loans.book_id = books.id
        WHERE loans.member_id = '$user_id'";

$result = $mysqli->query($sql);

$loan_list = array();
while ($row = $result->fetch_assoc()) {
    $loan_list[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบจัดการหนังสือ</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mt-4">
                <img src="image/w.png" alt="โลโก้" class="img-fluid" style="max-width: 100%;" />
            </div>
        </div>

        <div class="h4 text-center alert alert-info my-4" role="alert">รายการหนังสือของคุณ</div>

        <a href="borrow.php" class="btn btn-success my-4">ยืมหนังสือ</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>รหัสรายการยืม</th>
                    <th>ชื่อหนังสือ</th>
                    <th>วันที่ยืม</th>
                    <th>ค่าปรับ (บาท)</th>
                    <th>คืนหนังสือ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($loan_list as $loan) : ?>
                    <tr>
                        <td><?php echo $loan["loan_id"]; ?></td>
                        <td><?php echo $loan["book_title"]; ?></td>
                        <td><?php echo $loan["loan_date"]; ?></td>
                        <td><?php echo $loan["fine"]; ?></td>
                        <td>
                            <a href="return.php?loan_id=<?php echo $loan['loan_id']; ?>" class="btn btn-warning">คืนหนังสือ</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-center">
            <a href="logout.php" class="btn btn-danger">ออกจากระบบ</a>
            <div class="alert alert-warning mb-4 mt-4 text-right" role="alert">
    *โปรดชำระค่าปรับ ณ ห้องสมุดวิทยาลัยอาชีวศึกษา

    </div>

 
    <script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
