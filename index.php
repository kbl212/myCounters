<!DOCTYPE html>
<html lang="en-US" ng-app="mycounter">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Counter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

    <link rel="stylesheet" href="main.css" />
</head>

<body ng-controller="mainCtrl">
    <span>
        
        
        
<?php 

require_once 'login.php';
$conn = mysqli_connect($host_name, $user_name, $password, $db);
if ($conn->connect_error) die($conn->connect_error);

//echo '<br><br>Connected successfully';

        
if (isset($_POST['delete']) && isset($_POST['countAdd']))
{
    echo "SURPRISE!";
    $id = get_post($conn, 'countAdd');
    $query = "DELETE FROM counts WHERE id='$id'";
    $result = $conn->query($query);
    if (!$result) echo "DELETE failed: $query<br>" .
        $conn->error . "<br><br>";
}
if (isset($_POST['countAdd']))
{
    $getQuery = "SELECT * FROM counts";
    $getResult = $conn->query($getQuery);
    if (!$getResult) echo "GET query failed";
    $rows = $getResult->num_rows;
    
    for ($j = 0; $j < $rows; ++$j)
    {
    $getResult->data_seek($j);
    $row = $getResult->fetch_array(MYSQL_NUM);
    $new_count = $row[1] + 1;
    $updateQuery = 'UPDATE counts SET count = ' . $new_count . ' WHERE id = ' . $row[2];
    if ($row[2] == $_POST['countAdd'])
    {
    $updateResult = $conn->query($updateQuery);
    if (!$updateResult) echo "update failed...";
    }
    }
}
if (isset($_POST['newCountName']))
{
    $new_count_name = get_post($conn, 'newCountName');
    $postQuery = "INSERT INTO counts(name, count) VALUES" . "('$new_count_name', '0')";
    $result = $conn->query($postQuery);
    if (!$result) echo "INSERT failed: $postQuery<br>" .
        $conn->error . "<br><br>";
}
echo <<<_END
    <form action="index.php" method="post">
    New Count Name: <input name="newCountName" style="{width: 200px; height: 50px}">
    <input type="submit" value="ADD NEW COUNT">
    </form

_END;
        

$query = "SELECT * FROM counts";
$result = $conn->query($query);
if (!$result) echo "QUERY FAILED";
else 
{
    $rows = $result->num_rows;
    
    for ($j = 0; $j < $rows; ++$j)
    {
        
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);
    $currId = $row[2];
    echo "<br><br>" . "Current Count for " . "$row[0]" . " is: " . "<span>" . $row[1] . "</span>" . '
    <form action="index.php" method="post">
        <input name="countAdd" type="text" value="' . $currId . '">
        <input type="submit" value="+1">
    </form>' . '
    <form action="index.php" method="post">
    <input type="hidden" name="countAdd" value="' . $currId . '">
    <input type="hidden" name="delete" value="yes">
    <!--<i name="delete" class="fa fa-minus-square"></i>-->
    <input type="submit" value="DELETE">
    </form>
        
    '; } 
}      
        
        $result->close(); $conn->close(); function get_post($conn, $var) { return $conn->real_escape_string($_POST[$var]); } ?>


    </span>
    <div id="progress-bar-container">
        <div id="progress-bar" ng-style="{'width': '{{currCount}}%' }"> </div>
    </div>
    </div>
    <h3>ADD MORE!</h3>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.5/angular.js"></script>
    <script src="app.js"></script>
    <script src="mainCtrl.js"></script>
</body>

</html>