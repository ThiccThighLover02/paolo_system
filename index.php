<?php 
//session_start();
    include 'db_connect.php'; //include mo ung db_connect para makaconnect ka sa database
    include 'queries.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="node_modules/html5-qrcode/html5-qrcode.min.js"></script> <!-- import the scanner -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12" id="reader" style="width: 25vw">
            </div>
        </div>
        <div class="col-md-6">
            <form action="insert1.php" method="post" class="form-horizontal">
                <label>SCAN QR CODE</label>
                <input type="text" name="text" id="text" readonly placeholder="scan qrcode" class="form-control">
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>DATE</th>
                        <th>Points</th> <!-- Added column for numberOfattendance -->
                    </tr>
                </thead>
                <tbody>
                <?php
                    //we'll use prepared statement for extra security haha
                    $attend = $conn->prepare("SELECT * FROM table_attendance A INNER JOIN user_tbl U ON A.user_id=U.user_id WHERE DATE_FORMAT(attendance_dateTime, '%Y-%m-%d')=CURDATE()");
                    $attend->execute();
                    $result = $attend->get_result(); //kailangan kunin mga results
                    while($row = mysqli_fetch_assoc($result)){
                        //initialize the date and time and baguhin ang format
                        //time nalang kunin natin since may day naman na sa attendance
                        $date_time = $row['attendance_dateTime'];
                ?>
                    <tr>
                        <td><?= $row['attend_no'] ?></td>
                        <td><?= $row['first_name'] . " " . $row['last_name'] ?></td>
                        <td><?= $date_time ?></td>
                        <td><?= $row['points'] ?></td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
<script>
    <?php
        if(isset($_GET['recorded']) === 'true'){
    ?>
    alert("This user has been successfullly recorded");
    <?php
        }
        elseif(isset($_GET['attended']) == 'true'){
    ?>
    alert("The user may have already attended");
    <?php
        }
    ?>
    $(document).ready(function(){
        function onScanSuccess(decodedText, decodedResult) {
        //pag magsuccess ung scan ito magrurun
        // handle the scanned code as you like, for example:
        window.location.href = `attendance.php?qr_content=${decodedText}`;
        console.log(`DecodedText: ${decodedText}\nDecodedResult: ${decodedResult}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: {width: 250, height: 250} });
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);

        function onScanFailure(error) {
            //pag mag error ung scan maglalabas siya ng error
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
        }
    })
</script>
</html>
