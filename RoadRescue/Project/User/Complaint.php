<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../Assets/Connection/Connection.php");

// Start session and check if user is logged in
session_start();
if (!isset($_SESSION["uid"])) {
    echo "<script>alert('User not logged in.'); window.location='Login.php';</script>";
    exit();
}

if (isset($_POST["btnsave"])) {
    $complaint_type = $_POST["selcomplaint_type"];
    $complaint = $_POST["txtcomplaint"];
    $workshop_id = $_POST["selworkshop"]; // Get the selected workshop ID

    // Insert the complaint into the database
    $insqry = "INSERT INTO tbl_complaint(complainttype_id, complaint_content, complaint_date, user_id, workshop_id) 
               VALUES ('".$complaint_type."', '".$complaint."', CURDATE(), '".$_SESSION["uid"]."', '".$workshop_id."')";

    if ($conn->query($insqry) === TRUE) {
        // Redirect with success message
        echo "<script>alert('Complaint submitted successfully!'); window.location='complaint.php';</script>";
        exit();
    } else {
        echo "<script>alert('Failed to submit complaint. Error: " . $conn->error . "');</script>";
    }
}

include("Head.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Complaint Details</title>
</head>
<body>
<div align="center" id="tab">
    <h1>Complaint</h1><br />

    <form id="form1" name="form1" method="post" action="">
        <table>
            <tr align="center">
                <td>Complaint Type</td>
                <td>
                    <label for="selcomplaint_type"></label>
                    <select name="selcomplaint_type" id="selcomplaint_type" required>
                        <option value="">----Select----</option>
                        <?php
                        $selqry = "SELECT * FROM tbl_complainttype";
                        $re = $conn->query($selqry);
                        while ($row = $re->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row["complainttype_id"]; ?>"><?php echo $row["complainttype_name"]; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr align="center">
                <td>Workshop</td>
                <td>
                    <label for="selworkshop"></label>
                    <select name="selworkshop" id="selworkshop" required>
                        <option value="">----Select----</option>
                        <?php
                        $workshop_qry = "SELECT * FROM tbl_workshop";
                        $workshop_res = $conn->query($workshop_qry);
                        while ($workshop_row = $workshop_res->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $workshop_row["workshop_id"]; ?>"><?php echo $workshop_row["workshop_name"]; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr align="center">
                <td>Complaint</td>
                <td>
                    <label for="txtcomplaint"></label>
                    <input type="text" name="txtcomplaint" id="txtcomplaint" required="required" autocomplete="off" />
                </td>
            </tr>
            <tr align="center">
                <td colspan="2">
                    <div align="center">
                        <input type="submit" name="btnsave" id="btnsave" value="Save" />&nbsp;&nbsp;
                        <input type="reset" name="btncal" id="btncal" value="Cancel" />
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
<?php
include("Foot.php");
?>
</html>