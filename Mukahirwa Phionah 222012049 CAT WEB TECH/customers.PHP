<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Customers Page</title>
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

<body bgcolor="GREEN">
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
 <title>customers
  Form</title>
</head>
<body>
  <h1>customers Form</h1>

    <form method="post" onsubmit="return confirmInsert();">
        <label for="CustomerID">CustomerID:</label>
        <input type="number" id="cuid" name="cuid"><br><br>

        <label for="Name">Name:</label>
        <input type="text" id="nm" name="nm" required><br><br>

        <label for="Contact">Contact:</label>
        <input type="text" id="cnt" name="cnt" required><br><br>

        <label for="Address">Address:</label>
        <input type="text" id="addr" name="addr" required><br><br>

        <input type="submit" name="add" value="Insert">
    </form>

    <?php
    // Connection details
    include('db-connection.php');


    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters with appropriate data types
        $stmt = $connection->prepare("INSERT INTO customers (CustomerID, Name, Contact, Address) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $CustomerID, $Name, $Contact, $Address);

        // Set parameters from POST data with validation (optional)
        $CustomerID = intval($_POST['cuid']); // Ensure integer for ID
        $Name = intval($_POST['nm']); 
        $Contact = $_POST['cnt']; 
        $Address = $_POST['addr'];

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

// SQL query to fetch data from customers table
$sql = "SELECT * FROM customers";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of customers</title>
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
    <center><h2>Table of customers</h2></center>
    <table border="5">
        <tr>
            <th>CustomerID</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Define connection parameters
        include('db-connection.php');
        
        // Prepare SQL query to retrieve all customers
        $sql = "SELECT * FROM customers";
        $result = $connection->query($sql);

        // Check if there are any customers
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $cid = $row['CustomerID']; // Fetch the aCustomerid
                echo "<tr>
                    <td>" . $row['CustomerID'] . "</td>
                    <td>" . $row['Name'] . "</td>
                    <td>" . $row['Contact'] . "</td>
                    <td>" . $row['Address'] . "</td>
                    <td><a style='padding:4px' href='delete_customers.php?CustomerID=$cid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_customers.php?CustomerID=$cid'>Update</a></td> 
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