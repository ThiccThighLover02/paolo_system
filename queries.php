<?php
    function getNo(){
        include 'db_connect.php';
        $get_no = mysqli_query($conn, "SELECT COUNT(*) as row_count FROM table_attendance WHERE DATE_FORMAT(attendance_dateTime, '%Y-%m-%d')=CURDATE();");
        $get_row = mysqli_fetch_assoc($get_no);
        return $get_row['row_count'];
    }

?>