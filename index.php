<!DOCTYPE html>
<html lang="en-US" ng-app="mycounter">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Counter</title>
    <link rel="stylesheet" href="main.css" />
</head>

<body ng-controller="mainCtrl">
    <span ng-model="currCount">
        
        
        
<?php 

require_once 'login.php';
$conn = mysqli_connect($host_name, $user_name, $password, $db);
if ($conn->connect_error) die($conn->connect_error);

echo '<br><br>Connected successfully';

if (isset($_POST['countAdd']))
{
    $getQuery = "SELECT * FROM counts";
    $getResult = $conn->query($getQuery);
    if (!$getResult) echo "GET query failed";
    $getResult->data_seek(0);
    $row = $getResult->fetch_array(MYSQL_NUM);
    $curr_kyle_count = $row[1];
    $new_count = $row[1] + 1;
    echo "<br><br>new Count would be..." . $new_count;
    
    $updateQuery = 'UPDATE counts SET count = ' . $new_count . ' WHERE name="KyleCount"';
    $updateResult = $conn->query($updateQuery);
    if (!$updateResult) echo "update failed...";
}

$query = "SELECT * FROM counts";
$result = $conn->query($query);
if (!$result) echo "QUERY FAILED";
else 
{
    $result->data_seek(0);
    $row = $result->fetch_array(MYSQLI_NUM);
    echo "<br><br>" . "Current Count for " . "$row[0]" . " is: " . "$row[1]";
}
$result->close();
$conn->close();
?>
        
        
    </span>

    <h3>ADD MORE!</h3>
    <form action="index.php" method="post">
    <input name="countAdd" type="hidden" value="" ng-model="countAdd">
    <input type="submit" value="+1" ng-click="populateCountAdd()">
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.5/angular.js"></script>
</body>

</html>