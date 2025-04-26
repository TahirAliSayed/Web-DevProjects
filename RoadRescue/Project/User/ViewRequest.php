<?php
include("Head.php");
include("../Assets/Connection/Connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["rate"])) {
        // Handle rating submission
        $request_id = $_POST["request_id"];
        $rating = $_POST["rating"];
        
        // Update the request with the rating
        $updateQry = "UPDATE tbl_request SET request_rating = $rating WHERE request_id = $request_id";
        if ($conn->query($updateQry)) {
            echo "<script>alert('Rating submitted successfully!');</script>";
        } else {
            echo "<script>alert('Failed to submit rating.');</script>";
        }
    } elseif (isset($_POST["cancel_request"])) {
        // Handle cancel request
        $request_id = $_POST["request_id"];
        
        // Delete the request from the database
        $deleteQry = "DELETE FROM tbl_request WHERE request_id = $request_id AND request_status = 0";
        if ($conn->query($deleteQry)) {
            echo "<script>alert('Request canceled successfully!');</script>";
        } else {
            echo "<script>alert('Failed to cancel request.');</script>";
        }
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Request</title>

<style>
/* From Uiverse.io by ForzDz */ 
.rating {
  display: inline-block;
  opacity: 1;
}

.rating input {
  display: none;
  opacity: 1;
}

.rating label {
  float: right;
  cursor: pointer;
  color: #ccc;
  transition: color 0.3s, transform 0.3s, box-shadow 0.3s;
}

.rating label:before {
  content: '\2605';
  font-size: 30px;
  transition: color 0.3s;
}

.rating input:checked ~ label,
.rating label:hover,
.rating label:hover ~ label {
  color: #ffc300;
  transform: scale(1.2);
  transition: color 0.3s, transform 0.3s, box-shadow 0.3s;
  animation: bounce 0.5s ease-in-out alternate;
}

@keyframes bounce {
  to {
    transform: scale(1.3);
  }
}

/* Style for the Cancel button */
.cancel-button {
    background: none;
    border: none;
    color: #ccc; /* Default text color */
    cursor: pointer;
    font-size: 17px; /* Small font size */
    padding: 0; /* Remove padding */
    margin: 0; /* Remove margin */
    transition: color 0.3s; /* Smooth transition for hover effect */
}

.cancel-button:hover {
    color: red; /* Red text on hover */
}

/* Simple modal styles - added only for bill viewing */
.bill-modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.4);
}

.bill-modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 700px;
}

.close-modal {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close-modal:hover {
    color: black;
}
</style>

</head>
<body>
<div id="tab" align="center">
<h1 align="center">View Request</h1><br />
 <table border="1" align="center" cellpadding="5">
    <tr align="center">
      <th>Si.no</th> 
      <th>Name</th>
      <th>Date</th>
      <th>Detail</th>
      <th>Workshop</th>
      <th colspan="2"><div align="center">Action</div></th>
    </tr>
<?php
$i = 0;

$selqry = "SELECT r.*, u.user_name, w.workshop_name 
           FROM tbl_request r 
           INNER JOIN tbl_user u ON r.user_id = u.user_id 
           INNER JOIN tbl_workshop w ON r.workshop_id = w.workshop_id 
           WHERE u.user_id = '".$_SESSION["uid"]."'"; 

$result = $conn->query($selqry);

while($row = $result->fetch_assoc()) {
    $i++;
?>
    <tr align="center">
        <td><?php echo $i; ?></td>
        <td><?php echo $row["user_name"]; ?></td>     
        <td><?php echo $row["request_date"]; ?></td>     
        <td><?php echo $row["request_details"]; ?></td>     
        <td><?php echo $row["workshop_name"]; ?></td>
        <td>
        
            <?php    
            if ($row["request_status"] == "0") {
                echo "Waiting |";
                ?>
                <!-- Cancel Request Form -->
                <form method="post" action="" style="display:inline;">
                    <input type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>">
                    <button type="submit" name="cancel_request" class="cancel-button" onclick="return confirm('Are you sure you want to cancel this request?');">Cancel</button>
                </form>
                <?php
            } elseif ($row["request_status"] == "1") {
                echo "Accepted |";
            } elseif ($row["request_status"] == "2") {
                echo "Rejected";
            } elseif ($row["request_status"] == "3") {
                $selQry = "SELECT * FROM tbl_mechanic WHERE mechanic_id = '".$row["mechanic_id"]."'"; 
                $resulta = $conn->query($selQry);
                $rowa = $resulta->fetch_assoc();
                echo "Assigned To " . $rowa["mechanic_name"];
            } elseif ($row["request_status"] == "4") {
                $selQry = "SELECT * FROM tbl_mechanic WHERE mechanic_id = '".$row["mechanic_id"]."'"; 
                $resulta = $conn->query($selQry);
                $rowa = $resulta->fetch_assoc();
                echo $rowa["mechanic_name"] . " Started Work";
            // [Previous PHP code remains exactly the same until the table row for status 5]
        } elseif ($row["request_status"] == "5") {
            echo "Work Completed Waiting For Payment";
            ?>
            <br />
            <?php
            // Check if bill exists and is an image
            $billPath = "../Assets/File/Bill/".$row['request_bill'];
            $isImage = false;
            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            
            if(file_exists($billPath)) {
                $fileExt = pathinfo($row['request_bill'], PATHINFO_EXTENSION);
                $isImage = in_array(strtolower($fileExt), $imageExtensions);
            }
            
            if($isImage) {
                // For images, open in new window with proper content type
                echo '<a href="view_bill.php?bill='.$row['request_bill'].'" target="_blank">View Bill</a> | ';
            } 
            ?>
            <a href="Payment.php?rid=<?php echo $row["request_id"] ?>">Payment</a>
            <?php
        } elseif ($row["request_status"] == "6") {
// [Rest of the code remains exactly the same]
                echo "Completed";
                
                if (!isset($row["request_rating"]) || $row["request_rating"] === NULL) {
                    // Display the rating stars if the request has not been rated yet
                    ?>
                    
                    <form method="post" action="">
                        <div class="rating">
                            <input type="radio" id="star5-<?php echo $row['request_id']; ?>" name="rating" value="5">
                            <label for="star5-<?php echo $row['request_id']; ?>"></label>
                            <input type="radio" id="star4-<?php echo $row['request_id']; ?>" name="rating" value="4">
                            <label for="star4-<?php echo $row['request_id']; ?>"></label>
                            <input type="radio" id="star3-<?php echo $row['request_id']; ?>" name="rating" value="3">
                            <label for="star3-<?php echo $row['request_id']; ?>"></label>
                            <input type="radio" id="star2-<?php echo $row['request_id']; ?>" name="rating" value="2">
                            <label for="star2-<?php echo $row['request_id']; ?>"></label>
                            <input type="radio" id="star1-<?php echo $row['request_id']; ?>" name="rating" value="1">
                            <label for="star1-<?php echo $row['request_id']; ?>"></label>
                        </div>
                        <input type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>">
                        <input type="submit" name="rate" value="Rate">
                    </form>
                    <?php
                } else {
                    // Display the rating if it has already been rated
                    echo "<br>Rated: " . $row["request_rating"] . " stars";
                }
            }
            ?>
            
            <!-- Chat Link (Available until status is 6) -->
            <?php if ($row["request_status"] != "6") { ?>
                | <a href="chat.php?workshop_id=<?php echo $row['workshop_id']; ?>">Chat</a>
            <?php } ?>
            
        </td>      
    </tr>
    <?php
}
?>    

</table>
</div>

<!-- Simple modal for viewing bill - added at the bottom -->
<div id="billModal" class="bill-modal">
  <div class="bill-modal-content">
    <span class="close-modal" onclick="closeBillModal()">&times;</span>
    <div id="billContent" style="text-align: center;"></div>
  </div>
</div>

<script>
// Function to view the bill
function viewBill(billFilename) {
    const modal = document.getElementById("billModal");
    const billContent = document.getElementById("billContent");
    
    // Determine file type
    const fileExt = billFilename.split('.').pop().toLowerCase();
    
    if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExt)) {
        // Display image
        billContent.innerHTML = '<img src="../Assets/File/Bill/' + billFilename + '" style="max-width: 100%;">';
    } else if (fileExt === 'pdf') {
        // Display PDF
        billContent.innerHTML = '<embed src="../Assets/File/Bill/' + billFilename + '" type="application/pdf" width="100%" height="600px">';
    } else {
        // For other file types, provide download link
        billContent.innerHTML = '<p>Bill document: <a href="../Assets/File/Bill/' + billFilename + '" download>Download Bill</a></p>';
    }
    
    modal.style.display = "block";
}

// Function to close the bill modal
function closeBillModal() {
    document.getElementById("billModal").style.display = "none";
}

// Close modal when clicking outside of it
window.onclick = function(event) {
    const modal = document.getElementById("billModal");
    if (event.target == modal) {
        closeBillModal();
    }
}
</script>

</body>
<?php
include("Foot.php");
?>
</html>