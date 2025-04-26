<?php
include("../Assets/Connection/Connection.php");
include("Head.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Fetch workshops for the dropdown
$workshop_query = "SELECT * FROM tbl_workshop";
$workshop_result = $conn->query($workshop_query);

// Get the selected workshop ID from the form (if any)
$selected_workshop = isset($_GET['workshop']) ? $_GET['workshop'] : '';

// Fetch complaints based on the selected workshop
$selqry = "SELECT c.*, u.user_name, u.user_email, m.complainttype_name, w.workshop_name 
           FROM tbl_complaint c 
           INNER JOIN tbl_user u ON c.user_id = u.user_id 
           INNER JOIN tbl_complainttype m ON c.complainttype_id = m.complainttype_id 
           LEFT JOIN tbl_workshop w ON c.workshop_id = w.workshop_id 
           WHERE ('$selected_workshop' = '' OR c.workshop_id = '$selected_workshop')
           ORDER BY c.complaint_date DESC"; // Order by date (newest first)

$result = $conn->query($selqry);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Complaint</title>
<style>
    .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
    .loader {
        border: 5px solid #f3f3f3;
        border-top: 5px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
</head>
<body>
<div class="preloader">
    <div class="loader"></div>
</div>
<div id="tab" align="center">
    <h1 align="center">User</h1>

    <!-- Workshop Filter Dropdown -->
    <form method="get" action="">
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
                            <option value="<?php echo $workshop_row['workshop_id']; ?>" <?php echo ($selected_workshop == $workshop_row['workshop_id']) ? 'selected' : ''; ?>>
                                <?php echo $workshop_row['workshop_name']; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
        </table>
    </form>

    <br /><br />

    <table width="80%" border="1" align="center" cellpadding="5">
        <tr align="center">
            <th>Sl.no</th>
            <th>Name</th>
            <th>Email</th>
            <th>Content</th>
            <th>Type</th>
            <th>Workshop</th>
        </tr>
        <?php
        $i = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $i++;
                ?>
                <tr align="center">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row["user_name"]; ?></td>
                    <td><?php echo $row["user_email"]; ?></td>
                    <td><?php echo $row["complaint_content"]; ?></td>
                    <td><?php echo $row["complainttype_name"]; ?></td>
                    <td><?php echo $row["workshop_name"]; ?></td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="6" align="center">No complaints found.</td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
<script>
    window.addEventListener('load', function() {
        document.querySelector('.preloader').style.display = 'none';
    });
</script>
</body>
<?php
include("Foot.php");
?>
</html>