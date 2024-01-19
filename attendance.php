<?php
    include 'db_connect.php';
    include 'queries.php';
    if(isset($_GET['qr_content'])){
        $qr_content = $_GET['qr_content'];
        $sql = $conn->prepare("SELECT * FROM table_attendance WHERE qr_content=? AND DATE_FORMAT(attendance_dateTime, '%Y-%m-%d')=CURDATE()");
        $sql->bind_param("s", $qr_content);
        $sql->execute();
        $result = $sql->get_result();
        $attend_rows = mysqli_num_rows($result);
        echo $attend_rows;

        #if the user  has not yet attended this will run
        if($attend_rows === 0){
            #get the info of the user
            $select = $conn->prepare("SELECT * FROM user_tbl WHERE qr_contents=?");
            $select->bind_param("s", $qr_content);
            $select->execute();
            $selected_res = $select->get_result();
            $selected_row = mysqli_fetch_assoc($selected_res);

            #get the name of the user
            $user_id = $selected_row['user_id'];
            $first_name = $selected_row['first_name'];
            $mid_name = $selected_row['mid_name'];
            $last_name = $selected_row['last_name'];
            $attend_no = getNo() + 1;
            $points = $selected_row['points'] + 1;
            $date_time = date("Y-m-d H:i:s");

            #now we'll insert the information to the attendance table
            $insert = $conn->prepare("INSERT INTO `table_attendance`(`attend_no`, `user_id`, `qr_content`, `attendance_dateTime`) VALUES (?, ?, ?, ?)");
            $insert->bind_param("iiss", $attend_no, $selected_row['user_id'], $qr_content, $date_time);
            $insert->execute();

            $update_points = $conn->prepare("UPDATE user_tbl SET points=? WHERE user_id=?");
            $update_points->bind_param("ii", $points, $user_id);
            $update_points->execute();

            header("Location: index.php?recorded=true");
        }

        else{
            header("Location: index.php?attended=true");
        }
    }

    else{
        header("Location: index.php");
    }
?>