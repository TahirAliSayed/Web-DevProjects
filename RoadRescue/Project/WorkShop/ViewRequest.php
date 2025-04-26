
<?php

session_start(); // Ensure session is started
include("../Assets/Connection/Connection.php");		
include("Head.php");

$workshop_id = $_SESSION["wid"]; // Assuming workshop_id is stored in session

if(isset($_GET["ch"]))
{
    $up = "UPDATE tbl_request SET request_status='1' WHERE request_id='".$_GET["ch"]."'";
    if($conn->query($up))
    {
        echo "<script>alert('Updated');</script>";
        
    }
    else
    {
        echo "<script>alert('Failed');</script>";
    }
}

if(isset($_GET["mh"]))
{
    $up = "UPDATE tbl_request SET request_status='2' WHERE request_id='".$_GET["mh"]."'";
    if($conn->query($up))
    {
        echo "<script>alert('Updated');</script>";
        header("Location:ViewRequest.php");
    }
    else
    {
        echo "<script>alert('Failed');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>View Requests</title>
<style>
/* Button Styles */
.NbuttonA, .NbuttonR {
    padding: 8px 12px;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 14px;
    border-radius: 5px;
}

.NbuttonA {
    background-color: green;
}

.NbuttonR {
    background-color: red;
}

.NbuttonA:hover, .NbuttonR:hover {
    opacity: 0.8;
}

/* Table Styles */
table {
    width: 80%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid black;
    padding: 10px;
    text-align: center;
}

.thank-you {
    color: white;
    font-weight: bold;
    
}
</style>
</head>
<body>
<div id="tab" align="center">
<h1>View Requests</h1>
 <table>
    <tr>
      <th>Si.no</th> 
      <th>Name</th>
      <th>Date</th>
      <th>Details</th>
      <th>Status</th>
      <th>Actions</th>
      <th>Rating</th>
    </tr>
<?php
$i = 0;
$selqry = "SELECT r.*, u.user_name, u.user_id 
           FROM tbl_request r 
           INNER JOIN tbl_user u ON r.user_id = u.user_id 
           WHERE r.workshop_id = '$workshop_id'"; // Filter by workshop_id

$result = $conn->query($selqry);
while($row = $result->fetch_assoc())
{
    $i++;
?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row["user_name"]; ?></td>
        <td><?php echo $row["request_date"]; ?></td>
        <td><?php echo $row["request_details"]; ?></td>
        <td>
            <?php
            if($row["request_status"] == "0") {
                echo "Waiting";
            }
            elseif($row["request_status"] == "1") {
                echo "Accepted";
            }
            elseif($row["request_status"] == "2") {
                echo "Rejected";
            }
            elseif($row["request_status"] == "3") {
                $selQry = "SELECT * FROM tbl_mechanic WHERE mechanic_id='".$row["mechanic_id"]."'"; 
                $resulta = $conn->query($selQry);
                $rowa = $resulta->fetch_assoc();
                echo "Assigned To " .$rowa["mechanic_name"];
            }
            elseif($row["request_status"] == "4") {
                $selQry = "SELECT * FROM tbl_mechanic WHERE mechanic_id='".$row["mechanic_id"]."'"; 
                $resulta = $conn->query($selQry);
                $rowa = $resulta->fetch_assoc();
                echo $rowa["mechanic_name"]." Started Work";
            }
            elseif($row["request_status"] == "5") {
                echo "Work Completed, Waiting for Payment";
            }
            elseif($row["request_status"] == "6") {
                echo "Completed";
            }
            ?>
        </td>
        <td>
            <?php
            if($row["request_status"] == "0") {
                ?>
                <a href="ViewRequest.php?ch=<?php echo $row["request_id"]; ?>"><button class="NbuttonA">Accept</button></a>&nbsp;&nbsp;
                <a href="ViewRequest.php?mh=<?php echo $row["request_id"]; ?>"><button class="NbuttonR">Reject</button></a>
                <?php
            }
            elseif($row["request_status"] == "1") {
                ?>
                <a href="AssignMechanic.php?mh=<?php echo $row["request_id"]; ?>">Assign Mechanic</a> | 
                <?php
            }

            // Display chat link for all statuses except "6" (Completed)
            if ($row["request_status"] != "6") {
                ?>
                <a href="chat.php?user_id=<?php echo $row['user_id']; ?>">Chat</a>
                <?php
            } else {
                // Display "Thank You" when work is completed
                echo '<span class="thank-you">Thank You</span>';
            }
            ?>
        </td>
        <td>
            
            <?php
            if ($row["request_status"] == 6 && isset($row["request_rating"]) && $row["request_rating"] !== NULL) {
                echo $row["request_rating"] . " Stars";
            } else {
                echo "-";
            }
            ?>
        </td>
    </tr>
    <?php
}
?>    

</table>
</div>

</body>
<?php include("Foot.php"); ?>
</html>