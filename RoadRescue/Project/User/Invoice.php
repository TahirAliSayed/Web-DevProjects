<?php
include("SessionValidator.php");
ob_start();
include("../Assets/Connection/Connection.php");

// Fetch request details from database
if(isset($_SESSION["rid"])) {
    $request_id = $_SESSION["rid"];
    $selQry = "SELECT * FROM tbl_request WHERE request_id='$request_id'";
    $result = $conn->query($selQry);
    $request_data = $result->fetch_assoc();
    
    // Fetch user details if needed
    $userQry = "SELECT * FROM tbl_user WHERE user_id='".$request_data['user_id']."'";
    $userResult = $conn->query($userQry);
    $user_data = $userResult->fetch_assoc();
}

// Get payment details from session
$payment_details = $_SESSION['payment_details'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Payment Receipt</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
        }
        .invoice-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 30px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .header h1 {
            color: #7ed321;
            margin-bottom: 10px;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            background: #7ed321;
            color: white;
            border-radius: 20px;
            font-size: 14px;
            margin-top: 10px;
        }
        .details-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .detail-box {
            flex: 1;
            padding: 0 15px;
        }
        .detail-box h3 {
            color: #7ed321;
            margin-bottom: 15px;
            font-size: 18px;
        }
        .detail-item {
            margin-bottom: 10px;
            display: flex;
        }
        .detail-label {
            font-weight: bold;
            min-width: 120px;
        }
        .payment-method {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .thank-you {
            text-align: center;
            padding: 20px;
            background: #f5f7fa;
            border-radius: 8px;
            margin-top: 30px;
        }
        .btn-print {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 12px;
            background: #7ed321;
            color: white;
            text-align: center;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }
        .btn-print:hover {
            background: #6bbf1a;
        }
        @media print {
            .btn-print {
                display: none;
            }
            body {
                background: white;
            }
            .invoice-card {
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="invoice-card">
            <div class="header">
                <h1>Payment Receipt</h1>
                <div class="status-badge">Payment Successful</div>
            </div>
            
            <div class="details-section">
                <div class="detail-box">
                    <h3>Customer Details</h3>
                    <div class="detail-item">
                        <span class="detail-label">Name:</span>
                        <span><?php echo $payment_details['name']; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Email:</span>
                        <span><?php echo $payment_details['email']; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Request ID:</span>
                        <span><?php echo $request_id; ?></span>
                    </div>
                </div>
                
                <div class="detail-box">
                    <h3>Payment Details</h3>
                    <div class="detail-item">
                        <span class="detail-label">Date:</span>
                        <span><?php echo date('F j, Y, g:i a', strtotime($payment_details['date'])); ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Amount:</span>
                        <span>$XX.XX</span> <!-- Replace with actual amount from your database -->
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Status:</span>
                        <span>Completed</span>
                    </div>
                </div>
            </div>
            
            <div class="payment-method">
                <h3>Payment Method</h3>
                <div class="detail-item">
                    <span class="detail-label">Type:</span>
                    <span><?php echo $payment_details['card_type']; ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Card ending with:</span>
                    <span>**** **** **** <?php echo $payment_details['card_last4']; ?></span>
                </div>
            </div>
            
            <!-- Add request details here if needed -->
            <h3>Request Details</h3>
            <div class="detail-item">
                <span class="detail-label">Service Type:</span>
                <span><?php echo $request_data['service_type'] ?? 'N/A'; ?></span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Description:</span>
                <span><?php echo $request_data['request_details'] ?? 'N/A'; ?></span>
            </div>
            
            <div class="thank-you">
                <h3>Thank you for your payment!</h3>
                <p>Your transaction has been completed successfully. A receipt has been sent to your email.</p>
            </div>
            
            <button class="btn-print" onclick="window.print()">Print Receipt</button>
            <button class="btn-print" onclick="window.location.href='ViewRequest.php'">Back to Requests</button>
        </div>
    </div>
</body>
</html>
<?php
ob_end_flush();
?>