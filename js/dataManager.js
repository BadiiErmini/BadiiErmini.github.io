var app = angular.module("dataManager", []);

app.controller('layoutController', function($scope, $http) {
    $http.get("services/dm_getResources.php?res=layout_contents")
    .then(function (response) {$scope.layouts = response.data;});
    $scope.toggle = function($id) {
    	$('#'+$id).collapse('toggle');
    };
});