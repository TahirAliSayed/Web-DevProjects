<?php
include("../Assets/Connection/Connection.php");

if (isset($_GET["ch"])) {
    $up = "UPDATE tbl_request SET request_status='4' WHERE request_id='".$_GET["ch"]."'";
    if ($conn->query($up)) {
        header("Location: ViewAssignedWork.php");
    } else {
        echo "<script>alert('Failed')</script>";
    }
}

if (isset($_POST["btn_update"])) {
    $file = $_FILES["file_bill"]["name"];
    $temp = $_FILES["file_bill"]["tmp_name"];
    move_uploaded_file($temp, '../Assets/File/Bill/'.$file);

    $up = "UPDATE tbl_request SET request_status='5', request_bill='".$file."' WHERE request_id='".$_POST["txt_id"]."'";
    if ($conn->query($up)) {
        header("Location: ViewAssignedWork.php");
    } else {
        echo "<script>alert('Failed')</script>";
    }
}

include("Head.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Assigned Work</title>
</head>
<body>
<div id="tab">
<h1 align="center">View Assigned Work</h1>

<p>&nbsp;</p>
<p>&nbsp;</p>

<table border="1" align="center" cellpadding="5">
    <tr align="center">
        <td>Si.no</td> 
        <td>User Name</td>
        <td>Contact</td>
        <td>Details</td>
        <td>Action</td>
        <td>Location</td>
        <td>Rating</td>
    </tr>

<?php
$i = 0;

$selqry = "SELECT * FROM tbl_request r 
           INNER JOIN tbl_user u ON r.user_id = u.user_id  
           WHERE r.mechanic_id = '".$_SESSION["mid"]."' AND request_status > 2"; 

$result = $conn->query($selqry);
while ($row = $result->fetch_assoc()) {
    $i++;
?>
    <tr align="center">
        <td><?php echo $i; ?></td>
        <td><?php echo $row["user_name"]; ?></td>     
        <td><?php echo $row["user_contact"]; ?></td>     
        <td><?php echo $row["request_details"]; ?></td>     
        <td align="center">
            <?php
            if ($row["request_status"] == "3") {
                ?>
                <a href="ViewAssignedWork.php?ch=<?php echo $row["request_id"]; ?>">Start</a>
                <?php
            } else if ($row["request_status"] == "4") {
                if (isset($_GET["mh"]) && $_GET["mh"] == $row["mechanic_id"]) {
                    ?>
                    <form id="form1" name="form1" enctype="multipart/form-data" method="post" action="">
                        <input type="file" name="file_bill" id="file_bill" required />
                        <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $row["request_id"]; ?>" />
                        <input type="submit" name="btn_update" id="btn_update" value="Upload Bill" />
                    </form>
                    <?php
                } else {
                    ?>
                    <a href="ViewAssignedWork.php?mh=<?php echo $row["mechanic_id"]; ?>">Finish</a>
                    <?php
                }
            } else if ($row["request_status"] == 5) {
                echo "Waiting for Payment";
            } else if ($row["request_status"] == 6) {
                echo "Completed";
            }					
            ?>
        </td>
        <td>
            <?php
            if ($row["request_status"] == 6) {
                echo "Thank You";
            } else {
                ?>
                <a href="locationView.php?request_id=<?php echo $row["request_id"]; ?>">View Location</a>
                <?php
            }
            ?>
        </td>
        <td>
            <?php
            if ($row["request_status"] == 6 && isset($row["request_rating"]) && $row["request_rating"] !== NULL) {
                echo "Rated: " . $row["request_rating"] . " stars";
            } else {
                echo "Not Rated";
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

<?php
include("Foot.php");
?>

</html>