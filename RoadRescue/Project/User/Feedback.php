<?php
include("Head.php");
include("../Assets/Connection/Connection.php");

if(isset($_POST["btn_submit"]))
{
    $content = $_POST["txt_content"];
    $user_id = $_SESSION["uid"]; // Get user_id from session
    $workshop_id = $_POST["workshop"]; // Get workshop_id from the dropdown

    // Insert query with workshop_id
    $insqry = "INSERT INTO tbl_feedback(feedback_content, user_id, workshop_id, feedback_date) 
               VALUES ('".$content."', '".$user_id."', '".$workshop_id."', CURDATE())";

    if($conn->query($insqry))
    {
        ?>
        <script>
            alert('Feedback submitted successfully!');
            location.href='Feedback.php';
        </script>
        <?php  
    }
    else
    {
        ?>
        <script>
            alert('Failed to submit feedback.');
            location.href='Feedback.php';
        </script>
        <?php
    }
}

// Fetch workshops for the dropdown
$workshop_query = "SELECT * FROM tbl_workshop";
$workshop_result = $conn->query($workshop_query);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Feedback</title>
</head>
<body>
<div id="tab">
    <h1 align="center">Feedback</h1><br /><br />
    <form id="form1" name="form1" method="post" action="">
        <table align="center" border="1" cellpadding="10">
            <tr align="center">
                <td>Workshop</td>
                <td>
                    <label for="workshop"></label>
                    <select name="workshop" id="workshop" required>
                        <option value="">-- Select Workshop --</option>
                        <?php
                        while($workshop_row = $workshop_result->fetch_assoc())
                        {
                            ?>
                            <option value="<?php echo $workshop_row['workshop_id']; ?>"><?php echo $workshop_row['workshop_name']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr align="center">
                <td>Content</td>
                <td>
                    <label for="txt_content"></label>
                    <textarea name="txt_content" id="txt_content" cols="45" rows="5" required></textarea>
                </td>
            </tr>
            <tr align="center">
                <td colspan="2">
                    <div align="center">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />&nbsp;&nbsp;
                        <input type="reset" name="btn_reset" id="btn_reset" value="Cancel" />
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