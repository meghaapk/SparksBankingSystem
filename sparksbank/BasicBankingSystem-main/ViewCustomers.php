<?php
    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "bankingsystem"; 
    $conn = new mysqli($servername, $username, $password, $dbname); 
    if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
    } 
    
    $sql = "SELECT * FROM accountdetails" ;
    $result = $conn->query($sql);
?>
            
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>    
    
    <link rel="stylesheet" href="css/ViewCustomers.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Pacifico&family=Satisfy&family=Source+Code+Pro:wght@200&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <style>
body {
  background-image: url('img/web.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
</style>

</head>

<body>
  
  <?php include('navbar.php'); ?>
       <div class="container">
            <h2 style="text-align: center">Customer Details</h2>
            <br>                   
            <table id="Table">
                <thead>
                    <tr>
                    <th>S.No.</th>
                    <th>Account No.</th>
                    <th>Name</th>
                    <th>E-Mail</th>
                    <th>Balance</th>  
                    </tr>
                </thead>                     
                <?php
                while($row = $result->fetch_assoc()) { 
                ?> 
                <tr>
                    <td><?php echo $row['sno']; ?></td>
                    <td><?php echo $row['accID']; ?></td>
                    
                    <td ><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['balance']; ?></td>
                    
                </tr>
                <?php
                }
                $conn->close();
                ?> 
            </table>
        </div>
        <footer style="text-align: center">
            <p>Designed and Coded by: Megha P</p>
        </footer>
</body>
</html>


