<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cattle Page</title>
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
 <title>cattle Form</title>
</head>
<body>
    <h1>cattle Form</h1>

    <form method="post" onsubmit="return confirmInsert();">
        <label for="CattleID">CattleID:</label>
        <input type="number" id="ctid" name="ctid"><br><br>

        <label for="FarmerID">FarmerID:</label>
        <input type="text" id="fmid" name="fmid" required><br><br>

        <label for="Breed">Breed:</label>
        <input type="text" id="brd" name="brd" required><br><br>

        <label for="Age">Age:</label>
        <input type="text" id="ag" name="ag" required><br><br>

        <input type="submit" name="add" value="Insert">
    </form>

    <?php
    // Connection details
    include('db-connection.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters with appropriate data types
        $stmt = $connection->prepare("INSERT INTO cattle (CattleID, FarmerID, Breed, Age) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $CattleID, $FarmerID, $Breed, $Age);

        // Set parameters from POST data with validation (optional)
        $CattleID = intval($_POST['ctid']); // Ensure integer for ID
        $FarmerID = intval($_POST['fmid']); 
        $Breed = $_POST['brd']; 
        $Age = $_POST['ag'];

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

// SQL query to fetch data from cattle table
$sql = "SELECT * FROM cattle";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of cattle</title>
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
    <center><h2>Table of cattle</h2></center>
    <table border="5">
        <tr>
            <th>CattleID</th>
            <th>FarmerID</th>
            <th>Breed</th>
            <th>Age</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Define connection parameters
        include('db-connection.php');

        // Prepare SQL query to retrieve all cattle
        $sql = "SELECT * FROM cattle";
        $result = $connection->query($sql);

        // Check if there are any cattle
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $fid = $row['CattleID']; // Fetch the aCustomerid
                echo "<tr>
                    <td>" . $row['FarmerID'] . "</td>
                    <td>" . $row['FarmerID'] . "</td>
                    <td>" . $row['Breed'] . "</td>
                    <td>" . $row['Age'] . "</td>
                    <td><a style='padding:4px' href='delete_cattle.php?FarmerID=$fid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_cattle.php?FarmerID=$fid'>Update</a></td> 
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