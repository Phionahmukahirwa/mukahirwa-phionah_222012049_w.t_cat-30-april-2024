<?php
// Connection details
include('db-connection.php');

// Check if Transaction_Id is set
if(isset($_REQUEST['TransactionID'])) {
    $transid = $_REQUEST['TransactionID'];
    $stmt = $connection->prepare("SELECT * FROM Transaction WHERE TransactionID=?");
    $stmt->bind_param("i", $transid);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['TransactionID'];
        $y = $row['CattleID'];
        $z = $row['TransactionType'];
        $g = $row['Price'];
      
    } else {
        echo "transaction id not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Form of transaction</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Form of transaction form -->
    <h2><u>Update Form of transaction</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="cattid">Cattle ID:</label>
        <input type="number" name="cattid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="transtype">Transaction Type:</label>
        <input type="text" name="transtype" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="price">Price:</label>
        <input type="number" name="price" value="<?php echo isset($g) ? $g : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $TCattleid = $_POST['cattid'];
    $TType = $_POST['transtype'];
    $TPrice = $_POST['price'];
    
    // Update the Transaction in the database
    $stmt = $connection->prepare("UPDATE Transaction SET CattleID=?, TransactionType=?, Price=? WHERE TransactionID=?");
    $stmt->bind_param("issi",$TCattleid, $TType, $TPrice, $transid);
    $stmt->execute();

    // Redirect to Transaction.php
    header('Location: transaction.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
