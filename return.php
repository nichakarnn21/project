<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["loan_id"])) {
    $loan_id = $_GET["loan_id"];
    
    
    //$mysqli = new mysqli("localhost", "root", "12345678", "library");

    if ($mysqli->connect_error) {
        die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $mysqli->connect_error);
    }
    $return_date = date("Y-m-d");
    
    //$sql_check_loan = "SELECT * FROM loans WHERE id = '$loan_id' AND return_date ";
    $sql_check_loan = "SELECT * FROM loans WHERE id = '$loan_id' AND return_date IS NULL";

    $result_check_loan = $mysqli->query($sql_check_loan);

    
       
        
        
        $sql_get_loan_date = "SELECT loan_date FROM loans WHERE id = '$loan_id'";
        $result_get_loan_date = $mysqli->query($sql_get_loan_date);
        $row = $result_get_loan_date->fetch_assoc();
        $loan_date = strtotime($row["loan_date"]);
        $return_date = strtotime($return_date);
        $days_late = floor(($return_date - $loan_date) / (60 * 60 * 24));
        $fine = ($days_late > 20) ? ($days_late - 20) * 10 : 0;

       
        $sql_return_book = "UPDATE loans SET return_date = '$return_date', fine = '$fine' WHERE id = '$loan_id'";
        $sql_return_book = "UPDATE loans SET return_date = '$return_date', fine = '$fine' WHERE id = '$loan_id' AND return_date IS NULL";

        if ($mysqli->query($sql_return_book) === TRUE) {
            header("Location: dashboard.php");
        } else {
            echo "เกิดข้อผิดพลาดในการคืนหนังสือ: " . $mysqli->error;
        }
    } else {
        echo "ไม่พบรายการยืมหนังสือที่ต้องการคืนหรือรายการนี้ถูกคืนไปแล้ว";
    }

 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</html>
