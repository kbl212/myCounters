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
            echo "Current count is: ";
        ?>
    </span>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.5/angular.js"></script>
</body>
</html>
