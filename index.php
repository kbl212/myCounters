<!DOCTYPE html>
<html lang="en-US" ng-app="mycounter">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Counter</title>
    <link rel="stylesheet" href="main.css" />
</head>

<body>
    <span ng-model="currCount">
        
        
        
<?php 

$conn = mysqli_connect('localhost', 'root', 'Ma1rik23', 'mycounter');
if ($conn->connect_error) die($conn->connect_error);

echo '<br><br>Connected successfully';


$query = "SELECT * FROM counts";
$result = $conn->query($query);
if (!$result) echo "QUERY FAILED";
else 
{
    $result->data_seek(0);
    $row = $result->fetch_array(MYSQLI_NUM);
    echo "<br><br>" . "Current Count for " . "$row[0]" . " is: " . "$row[1]";
}
        
$conn->close();
?>
        
        
    </span>

    <h3>ADD MORE!</h3>
    <form action="index.php" method="post">
    <input name="countAdd" type="text">
    <input type="submit" value="ADD VALUE TO COUNT">
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.5/angular.js"></script>
</body>

</html>