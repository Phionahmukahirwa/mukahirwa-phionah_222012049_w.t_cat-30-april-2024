<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Payment Page</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;

      background-color: green;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1300px; /* Adjust this value as needed */

      padding: 8px;
     
    }
  </style>
    <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
  
<header>
   

</head>

<body bgcolor="skyblue">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./image/blublogo.jpg" width="90" height="60" alt="Logo">
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
    <li style="display: inline; margin-right: 10px;"><a href="./About.html">ABOUT US</a>
      <li style="display: inline; margin-right: 10px;"><a href="./Contact.html">CONTACT US</a>

    <li style="display: inline; margin-right: 10px;"><a href="./animals_available.PHP">Animals_available</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./cattle.PHP">Cattle</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./customers.PHP">Customers</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./farmer.PHP">Farmer</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./payment.PHP">Payments</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./transaction.php">Transactions</a>
  </li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color:darkgreen; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Change Account</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>
 <title>Payment Form</title>
</head>
<body>

    <h1>Payment Form</h1>

    <form method="post" onsubmit="return confirmInsert();">
        <label for="Payment_id">Payment_id:</label>
        <input type="number" id="pyid" name="pyid"><br><br>

        <label for="TransactionID">TransactionID:</label>
        <input type="text" id="tid" name="tid" required><br><br>

        <label for="Payment_method">Payment_method:</label>
        <input type="text" id="pymth" name="pymth" required><br><br>

        <input type="submit" name="add" value="Insert">
    </form>

    <?php
    // Connection details
    include('db-connection.php');

 
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters with appropriate data types
        $stmt = $connection->prepare("INSERT INTO payment(Payment_id, TransactionID, Payment_method) VALUES (?, ?,?)");
        $stmt->bind_param("sss", $Payment_id, $TransactionID, $Payment_method);

        // Set parameters from POST data with validation (optional)
        $Payment_id = intval($_POST['pyid']); // Ensure integer for ID
        $TransactionID = intval($_POST['tid']); 
        $Payment_method = $_POST['pymth']; 
        // Execute prepared statement with error handling
        if ($stmt->execute()) {
            echo "New record has been added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $connection->close();
    ?>
<?php
// Connection details
include('db-connection.php');

// SQL query to fetch data from farmers table
$sql = "SELECT * FROM payment";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of payment</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Table of payment</h2></center>
    <table border="5">
        <tr>
            <th>Payment_id</th>
            <th>TransactionID</th>
            <th>Payment_method</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Define connection parameters
        include('db-connection.php');


        // Prepare SQL query to retrieve all products
        $sql = "SELECT * FROM payment";
        $result = $connection->query($sql);

        // Check if there are any payment
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $anid = $row['Payment_id']; // Fetch the Payment_id
                echo "<tr>
                    <td>" . $row['Payment_id'] . "</td>
                    <td>" . $row['TransactionID'] . "</td>
                    <td>" . $row['Payment_method'] . "</td>
                    <td><a style='padding:4px' href='delete_payment.php?Payment_id=$anid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_payment.php?Payment_id=$anid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
  </body>
    </section>

  
<footer>
  <center> 
    <b><h2>UR CBE BIT &copy, 2024 & reg, Designer by: @PHIONAH MUKAHIRWA</h2></b>
  </center>
</footer>
</body>
</html>