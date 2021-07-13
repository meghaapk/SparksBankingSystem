<?php


header("Cache-Control: private, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: Sat,26 Jul 1997 05:00:00 GMT");

    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "bankingsystem"; 
    
    $conn = new mysqli($servername, $username, $password, $dbname); 
    
    if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
    } 
?>

<html>
<head> 
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Pacifico&family=Satisfy&family=Source+Code+Pro:wght@200&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Pacifico&family=Satisfy&family=Source+Code+Pro:wght@200&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
<title>Transaction Page</title>
    <link rel="stylesheet" href="css/ResultPage.css">    
     <script type="text/javascript">
    
    if(window.history.replaceState){
        
        window.history.replaceState(null, null, window.location.href); 
    }
    
</script>
</head>

<body>

<?php include('navbar.php'); ?>

<?php 
  if(isset($_POST['form_submitted'])){

  
      $PAYER_ID = $_POST['payerID'];
      $PAYEE_ID = $_POST['payeeID'];
      $AMOUNT = $_POST['amount'];

      if(empty($PAYER_ID) || empty($PAYER_ID) || empty($AMOUNT)){
                 
        echo "<script> alert('Empty Fields !!');
        window.location.href='Transfer.php';
        </script>";  
        exit() ;           
      }

      
      if($AMOUNT <=0){
        echo "<script> alert('Amount must be greater than zero !!');
        window.location.href='Transfer.php';
        </script>";  
        exit() ;  
      }

      if(!ctype_digit($AMOUNT) || !ctype_digit($PAYER_ID) || !ctype_digit($PAYEE_ID)){
        echo "<script> alert('Entered value can only contain digit!!');
        window.location.href='Transfer.php';
        </script>";  
        exit() ;  
      }

      
      $sqlcount = "SELECT COUNT(1) FROM accountdetails where accID='$PAYER_ID'";
      $r =  $conn->query($sqlcount);
      $d = $r->fetch_row();
      if($d[0]<1){
        echo "<script> alert('Payer ID does not exists !!');
        window.location.href='Transfer.php';
        </script>";  
        exit() ;      
      }
   
      $sqlcount = "SELECT COUNT(1) FROM accountdetails where accID='$PAYEE_ID'";
      $r =  $conn->query($sqlcount);
      $d = $r->fetch_row();
      if($d[0]<1){
        echo "<script> alert('Payee ID does not exists !!');
        window.location.href='Transfer.php';
        </script>";  
        exit() ;      
      }
      
      
      $sql = "Select * from accountdetails where accID='$PAYER_ID'";       
          if($result = $conn->query($sql)){            
               $row1 = $result->fetch_array(); 
               if($row1['balance']<$AMOUNT){
                echo "<script> alert('Payer does not have required balance !!');
                window.location.href='Transfer.php';
                </script>";  
                exit() ; 
                }  
          }  

   

          echo "<div class ='center'>";
          echo "<div class ='center2'>";
          echo "<h1 style='text-align: center'>Transaction Successfully Completed</h1>
                <p  style='text-align: center; font-size:25px;'>Details of payer and payee are as follows<p>
                <table id = 'Table'>
                <tr>
                <th></th>
                <th>Account No</th>
                <th>Name</th>
                <th>Email</th>
               
                </tr>";

          
          $sql = "Select * from accountdetails where accID='$PAYER_ID'";       
          if($result = $conn->query($sql)){            
               $row1 = $result->fetch_array(); 
                
                       echo "<tr> 
                            <td> Payer </td>
                            <td>".$row1['accID']."</td>
                            <td>".$row1['name']."</td>
                            <td>".$row1['email']."</td>
                           
                            </tr>";                        
                       $PayerCurrentBalance = $row1['balance'];            
            }
        
          
          $sql2 = "Select * from accountdetails where accID='$PAYEE_ID'";
          if($result = $conn->query($sql2)){
                
                $row2 = $result->fetch_array();
                       echo "<tr> 
                            <td> Payee </td>
                            <td>".$row2['accID']."</td>
                            <td>".$row2['name']."</td>
                            <td>".$row2['email']."</td>
                           
                            </tr>"; 
                        $PayeeCurrentBalance = $row2['balance'];                       
               
               
            }               
            echo "</table>";
            $PayeeCurrentBalance += $AMOUNT;
            $PayerCurrentBalance -= $AMOUNT;
            echo "<br>";
            echo "<table id = 'Table' style='margin-bottom:15px;'>
                    <tr>
                        <th></th>
                        <th>Old Balance</th>
                        <th>New Balance</th>
                    </tr>
                    <tr>
                        <th>Payer</th>
                        <td style='color:black'>".$row1['balance']."</td>                        
                        <td style='color:black'>".$PayerCurrentBalance."</td>
                    </tr>
                    <tr>
                        <th>Payee</th>
                        <td style='color:black'>".$row2['balance']."</td>                        
                        <td style='color:black'>".$PayeeCurrentBalance."</td>
                    </tr>";
            echo "</table>";
            

           
           $updatepayer ="Update accountdetails set balance='$PayerCurrentBalance' where accID='$PAYER_ID'";
           
           $updatepayee ="Update accountdetails set balance='$PayeeCurrentBalance' where accID='$PAYEE_ID'";

           
           if($conn->query($updatepayer)==true){
                ?>         
                <script>console.log("PAYER DETAILS UPDATED!!")</script>
                <?php
           }
           else{
                ?>        
                <script>alert("PAYER DETAILS NOT UPDATED!!")</script>
                <?php
           }

            
           if($conn->query($updatepayee)==true){
                    ?>         
                    <script>console.log("PAYEE DETAILS UPDATED! ")</script>
                    <?php
            }
            else{
                    ?>        
                    <script>alert("PAYEE DETAILS NOT UPDATED! ERROR OCCURED!")</script>
                    <?php
            }

            
            date_default_timezone_set('Asia/Kolkata');           
            $date = date('Y-m-d H:i:s',time());
            
            $InsertTransactTable ="Insert into history (payer, payerAcc, payee, payeeAcc, amount, time) values ('$row1[name]','$row1[accID]','$row2[name]','$row2[accID]','$AMOUNT','$date')";
            
            if($conn->query($InsertTransactTable)==true){
                    ?>         
                    <script>console.log("Record of this transaction saved! ")</script>
                    <?php
            }
            else{
                    ?>        
                    <script>alert("Record of this transaction saved! ERROR OCCURED!")</script>
                    <?php
            }


            echo "<br>";
        echo "</div>";
        echo "</div>";
          
  }else{
      ?>
      <h1>All transactions are up to date</h1>
      <?php
  }
  
  $conn->close();
  
?>
 
             

         

</body>
</html>

