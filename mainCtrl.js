var app = angular.module('mycounter');


app.controller('mainCtrl', function($scope){
    $scope.populateCountAdd = function() {
        $scope.countAdd = 1;
    }
})