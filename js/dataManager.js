var app = angular.module("dataManager", []);

app.controller('layoutController', function($scope, $http) {
    $http.get("services/dm_getLayout.php")
    .then(function (response) {$scope.layouts = response.data;});
});