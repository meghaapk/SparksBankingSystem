<?php



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
    <title>Transaction Page</title>
   
    <link rel="stylesheet" href="css/Transfer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Pacifico&family=Satisfy&family=Source+Code+Pro:wght@200&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <script type="text/javascript">
    
        if(window.history.replaceState){
            
            window.history.replaceState(null, null, window.location.href); 
        }
       
    </script>
       <style>
body {
  background-image: url('img/d1.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
</style>
     
</head>

<body>

<?php include('navbar.php'); ?>

<div class = 'transferMoney'>
    <h1>Transfer Money</h1>
    
    <form name="myForm" action="ResultPage.php"  onsubmit="return validateForm()" method="post">
    
        <table id="table1">
        
        <tr>
            <td>Payer Account No</td>
            <td><input type="number" name="payerID"  min=100 required><td>
        </tr>
        
        <tr>
            <td>Payee Account No</td>
            <td><input type="number" name="payeeID" min=100 required ><td>
        </tr>
        
        <tr>
            <td>Amount (in Rupees)</td>
            <td><input type="number" name="amount" min=1 required><td>
        </tr>
        
        <tr>
            <td><input type= "hidden" name= "form_submitted" value="1"></td>
            <td> <input class="proceed" type="submit" value="Proceed"><td>
        </tr>
       
        </table>
    </form>
</div>
 
 <script>
 
 function validateForm() {
            var x = document.forms["myForm"]["payerID"].value;
            var y = document.forms["myForm"]["payeeID"].value;
            var z = document.forms["myForm"]["amount"].value;
            var regex=/^[0-9]+$/;

            
            if (x == "" || y=="" || z=="") {
                alert("Fill it!!");
                return false;
            }

            
            if((Math.sign(z)==-1)||(Math.sign(z)==-0)||z==0){
                alert("Enter a valid amount to do transaction");
                return false;
            }
            if(isNaN(z)|| !x.match(regex)|| !y.match(regex) ||!z.match(regex)){
                alert("Enter correct input!");
                return false;
            }
            
           
        }
            
 </script>
</body>
</html>
<!--HTML CODE ENDS HERE-->
<!--MADE BY SWATI TRIPATHI-->
