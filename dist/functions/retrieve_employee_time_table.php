<?php 


echo '
<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="tbl_employee_time" style="text-align: center;">
                                    <thead>
                                        <tr>
                                            <td>Employee ID</td>
                                            <td>Employee Name</td>
                                            <td>Date</td>
                                            <td>IN</td>
                                            <td>OUT</td>
                                            <td>IN</td>
                                            <td>OUT</td>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                        

                                        include("../connection.php");
                                         $sql = "SELECT * FROM employee_tbl";
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
                                                    while($row1 = $result1->fetch_assoc()) {


                                                    $date_in_out = $row1['date_in_out'];
                                                    echo "<tr>";
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
                                                        echo "<td style='width: 60px;color:red;'>".$row2['time_in_out']." ----- $aa</td>";
                                                        }else{

                                                        if($row2['forgotten'] == 1){
                                                        echo "<td style='width: 60px; color:red;'>".$row2['time_in_out']. " ---- $aa</td>";
                                                        }else{
                                                        echo "<td style='width: 60px; color:black;'>".$row2['time_in_out']. " ---- $aa</td>";
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
                                                    }
                                                }
                                                
                                                }
                                            }
                                            
                                    echo '</tbody>
                                    </table>

';
                                        ?>