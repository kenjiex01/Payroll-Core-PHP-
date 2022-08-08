<?php 
include("../connection.php");
session_start();
$company_name = $_SESSION['company_name'];
 $s_d = $_POST['start_date'];
 $e_d = $_POST['end_date'];
$start_date = date("m/d/Y", strtotime($s_d));
$end_date = date("m/d/Y", strtotime($e_d));

 $sql = "SELECT * FROM employee_tbl WHERE company = '$company_name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
        $finger_id = $row['finger_id'];
        $full_name = $row['employee_first_name'] . " " . $row['employee_middle_name']. " " . $row['employee_last_name'];

        $sql1 = "SELECT * FROM employee_time WHERE finger_id = '$finger_id' GROUP BY date_in_out";
        $result1 = $conn->query($sql1);

        if ($result1->num_rows > 0) {
        // output data of each row
            while($row1 = $result1->fetch_assoc()) { //second while

            $date_in_out = date("m/d/Y", strtotime($row1['date_in_out']));
            if(($date_in_out >= $start_date) && ($date_in_out <= $end_date)){

            echo "<tr id='tbl_rw'>";
            echo "<td>".$row['finger_id']."</td>";
            echo "<td>".$full_name."</td>";
            echo "<td>".$row1['date_in_out']."</td>";
            $sql2 = "SELECT * FROM employee_time WHERE finger_id = '$finger_id' AND date_in_out = '$date_in_out' ORDER BY time_in_out";
            $result2 = $conn->query($sql2);

            if ($result2->num_rows > 0) {
            // output data of each row
                $aa = 1;
                $eight = "08:04:00";
                while($row2 = $result2->fetch_assoc()) {

                // echo "<td>".$row2['time_in_out']."</td>";

                if($aa == 1 AND strtotime($row2['time_in_out']) > strtotime($eight)){
                echo "<td style='width: 60px;color:red;' name='edit_time' id='edit_time' onclick='test_click()' data-time_id='".$row2['id']."'>".$row2['time_in_out']." ----- $aa</td>";
                }else{

                if($row2['forgotten'] == 1){
                echo "<td style='width: 60px; color:red;' name='edit_time' id='edit_time' onclick='test_click()' data-time_id='".$row2['id']."'>".$row2['time_in_out']. " ---- $aa</td>";
                }else{
                echo "<td style='width: 60px; color:black;' name='edit_time' id='edit_time' onclick='test_click()' data-time_id='".$row2['id']."'>".$row2['time_in_out']. " ---- $aa</td>";
                }
                }
                $aa++;
                }
                if($result2->num_rows<4){
                    $a = $result2->num_rows;
                    while($a < 4){
                    echo "<td style='background-color:#1ecbe1;'></td>";
                    $a++;
                    }
                }
            }

            echo "</tr>";
            }//if start and end date condition
               
            }//second while
        }else{
                echo "NoRecord.";
            }
        
        }
    }
?>