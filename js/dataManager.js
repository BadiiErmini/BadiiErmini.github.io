var app = angular.module("dataManager", []);

app.controller('layoutController', function($scope, $http) {
    $http.get("services/dm_getLayout.php")
    .then(function (response) {$scope.layouts = response.data;});
    $scope.toggle = function($id) {
    	$('#'+$id).collapse('toggle');
    };
    
});
app.controller('structureController',function($scope, $http) {
	$scope.init = function($id){
		$scope.id = $id;
		$http.get("services/dm_getStructure.php?id="+$scope.id)
		.then(function (response) {$scope.structure = response.data;});
	};
});