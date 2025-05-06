<!DOCTYPE html>
<html>
<head>
  <!-- Include jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <style>
    /* Style for the connection status */
    #connectionStatus {
      display: none; /* Hide initially */
      padding: 15px;
      background-color: #3498db;
      color: white;
      border-radius: 8px;
      margin: 20px auto;
      width: fit-content;
      font-family: Arial, sans-serif;
      animation: fadeInAnimation 1.5s ease-in-out; /* Animation */
    }

    @keyframes fadeInAnimation {
      0% { opacity: 0; transform: scale(0.5); }
      100% { opacity: 1; transform: scale(1); }
    }
  </style>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn) 
{
    echo "<span id='connectionStatus'>Connection OK</span>";
}
else
{
    echo "Connection Failed";
}
?>

<script>
  // Add animation to the connection status
  $(document).ready(function(){
    $('#connectionStatus').fadeIn(2000); // Adjust the duration as needed
  });
</script>

</body>
</html>
