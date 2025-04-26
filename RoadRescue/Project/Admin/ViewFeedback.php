<?php
include("Head.php");
include("../Assets/Connection/Connection.php");

// Fetch workshops for the dropdown
$workshop_query = "SELECT * FROM tbl_workshop";
$workshop_result = $conn->query($workshop_query);

$selected_workshop = isset($_GET['workshop']) ? $_GET['workshop'] : '';

// Fetch feedback data with workshop name
$selqry = "SELECT * FROM tbl_feedback f 
           INNER JOIN tbl_user u ON u.user_id = f.user_id 
           INNER JOIN tbl_workshop w ON w.workshop_id = f.workshop_id 
           WHERE ('$selected_workshop' = '' OR f.workshop_id = '$selected_workshop')
           ORDER BY f.feedback_date DESC"; // Order by date (newest first)

$res = $conn->query($selqry);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Feedback</title>
</head>
<body>
<div id="tab">
    <h1 align="center">View Feedback</h1><br /><br />
    <form id="form1" name="form1" method="get" action="">
        <table align="center" border="1" cellpadding="10">
            <tr align="center">
                <td>Workshop</td>
                <td>
                    <label for="workshop"></label>
                    <select name="workshop" id="workshop" onchange="this.form.submit()">
                        <option value="">-- All Workshops --</option>
                        <?php
                        while($workshop_row = $workshop_result->fetch_assoc())
                        {
                            ?>
                            <option value="<?php echo $workshop_row['workshop_id']; ?>" <?php echo ($selected_workshop == $workshop_row['workshop_id']) ? 'selected' : ''; ?>><?php echo $workshop_row['workshop_name']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
        </table>
    </form>
    <br /><br />
    <table align="center" border="1" cellpadding="10">
        <tr align="center">
            <th>Sl.No</th>
            <th>Name</th>
            <th>Feedback</th>
            <th>Reply</th>
            <th>Workshop</th>
        </tr>
        <?php
        if ($res->num_rows > 0) {
            $i = 0;
            while($row = $res->fetch_assoc())
            {
                $i++;
                ?>
                <tr align="center">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row["user_name"]; ?></td>
                    <td><?php echo $row["feedback_content"]; ?></td>
                    <td><?php echo $row["feedback_reply"]; ?></td>
                    <td><?php echo $row["workshop_name"]; ?></td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="5" align="center">No feedback found.</td>
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