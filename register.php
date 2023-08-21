<?php

    // Connect to the MySQL database
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $dbname = "tatcshop";

    $conn = new mysqli($servername, $username_db, $password_db, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register Member</title>
        <link rel="stylesheet" href="tatc.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <style>
            @media only screen and (min-width: 600px) {
  /* For tablets: */
  .col-s-1 {width: 8.33%;}
  .col-s-2 {width: 16.66%;}
  .col-s-3 {width: 25%;}
  .col-s-4 {width: 33.33%;}
  .col-s-5 {width: 41.66%;}
  .col-s-6 {width: 50%;}
  .col-s-7 {width: 58.33%;}
  .col-s-8 {width: 66.66%;}
  .col-s-9 {width: 75%;}
  .col-s-10 {width: 83.33%;}
  .col-s-11 {width: 91.66%;}
  .col-s-12 {width: 100%;}
}
@media only screen and (min-width: 768px) {
  /* For desktop: */
  .col-1 {width: 8.33%;}
  .col-2 {width: 16.66%;}
  .col-3 {width: 25%;}
  .col-4 {width: 33.33%;}
  .col-5 {width: 41.66%;}
  .col-6 {width: 50%;}
  .col-7 {width: 58.33%;}
  .col-8 {width: 66.66%;}
  .col-9 {width: 75%;}
  .col-10 {width: 83.33%;}
  .col-11 {width: 91.66%;}
  .col-12 {width: 100%;}
}
 body {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    margin: 0;
  }

  /* Center the header */
  .header {
    text-align: center;
  }

  /* Center the menu */
  .menu {
    text-align: center;
  }

  /* Center the footer */
  .footer {
    text-align: center;
  }

  /* Center the "The City" content in col-6 col-s-9 */
  .col-6.col-s-9 {
    text-align: center;
  }

        </style>
    </head>
    <body>
        <?php
// Check if the form was submitted

$real = date('Y-m-d h:i:s a', time());
$sql_latestCustid = "select max(Cust_id) as Cust_id from customer;";
$result_latestCustid = $conn->query($sql_latestCustid);
$row_lastestCustId = mysqli_fetch_array($result_latestCustid );
$latest_CustId = $row_lastestCustId['Cust_id'];
if ($latest_CustId == null) {
  $latest_CustId = 'ไม่มีรหัสการลุกค้าก่อนหน้า';
}
else {
    $new_cust_id = preg_replace('/\D/', '', $latest_CustId) + 1;
    $latest_CustId_AutoGenerate = "C" . str_pad($new_cust_id, 4, '0', STR_PAD_LEFT); 

  //  echo $latest_CustId_AutoGenerate;
}




if (isset($_POST["Register"])){
     // Get the form data
     $name = $_POST["Cust_name"];
     $last_name = $_POST["Cust_lastName"];
     $address = $_POST["Cust_address"];
     $provinid = $_POST["Province"];
     $phone = $_POST["Cust_tel"];
     //$daterealtime = $_POST["Admit_date"];
     //$picture = $_POST["Cust_picture"];
     //$status = $_POST["Cust_status"];
//     // Validate and sanitize the data (You should implement proper validation and sanitation)


//     // Prepare and execute the SQL query
     $sql = "INSERT INTO customer VALUES ('$latest_CustId_AutoGenerate','$name', '$last_name','$address', '$provinid', '$phone', '$real',NULL,'1')";

     if ($conn->query($sql) === TRUE) {
        // echo "yes";
     } else {
         // Error inserting data
         echo "Error: " . $sql . "<br>" . $conn->error;
    }

     // Close the database connection
     //$conn->close();
 }
   

?>
        <div class="container">
        <div class="row">
            <div class="col-md-10 offset=md-1">
              <div class="row">
                  <div class="col-md-5 register-left">
                      <img src="image/TATC.png" width="300" alt="Logo / Banner" class="img-fluid Title-img">
                  </div>
                  <div class="col-md-7 register-right">
                      <h2>Register Member</h2>
                      <div class="register-form">
                           <div class="form-group">
                           <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                               <input type="text" class="form-control" name="Cust_name" placeholder="Name"  required>
                           </div>
                            <div class="form-group">
                               <input type="text" class="form-control" name="Cust_lastName" placeholder="Last-Name"  required>
                           </div>
                           
                           <div class="form-group">
                               <input type="text" class="form-control" name="Cust_address" placeholder="Address"  required>
                           </div>
                           <div class="form-group">
                               <input type="text" class="form-control" name="Cust_tel" placeholder="Phone"  required>
                           </div>
                         
                           
                            <div class="form-group">
                            <select name="Province" class="form-select"  required>
                                  <option value="">- จังหวัด -</option>
                                  <?php
                                    $sql = "SELECT * FROM Province";
                                    $query = $conn->query($sql);

                                    while ($row = $query->fetch_array()) {
                                      ?>
                                      <option value="<?php echo $row['Province_id'] ?>">
                                        <?php echo $row['Province_name'] ?>
                                      </option>
                                      <?php
                                    }
                                  ?>
                                </select>
                           </div>
                        <input type="submit" value="Register" class="btn btn-primary" name="Register">
                        <a href="login.php"  class="btn btn-primary">Login</a>
                        </form>
                           
                          
                      </div>
                      
                      
                  </div>
                  
              </div>   
                
                
            </div>
            
        </div>
            
        </div>
        
        
    </body>
  
</html>
