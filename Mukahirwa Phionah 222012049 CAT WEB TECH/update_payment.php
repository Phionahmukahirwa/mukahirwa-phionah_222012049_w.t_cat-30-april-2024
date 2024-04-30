<?php
// Connection details
include('db-connection.php');

// Check if Payment_Id is set
if(isset($_REQUEST['Payment_id'])) {
    $payid = $_REQUEST['Payment_id'];
    
    $stmt = $connection->prepare("SELECT * FROM payment WHERE Payment_id=?");
    $stmt->bind_param("i", $payid);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['Payment_id'];
        $y = $row['TransactionID'];
        $z = $row['Payment_method'];
      
    } else {
        echo "payment id not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Form of payment</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Form of payment form -->
    <h2><u>Update Form of payment</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="transid">TransactionID:</label>
        <input type="number" name="transid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="paymthd">Payment_method:</label>
        <input type="text" name="paymthd" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $transid = $_POST['transid'];
    $paymntmethod = $_POST['paymthd'];
    
    // Update the payment in the database
    $stmt = $connection->prepare("UPDATE payment SET TransactionID=?, Payment_method=? WHERE Payment_id=?");
    $stmt->bind_param("isi",$transid, $paymntmethod, $payid);
    $stmt->execute();
    
    // Redirect to payment.php
    header('Location: payment.PHP');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
