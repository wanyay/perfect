
var app = angular.module('saytanar', []);

app.controller('angularDailyController',['$scope','$http','$location',function($scope,$http,$location){
		$scope.data = [];
		var today = new Date();
		var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
		$http.get('/api/daily/' + date).success(function(data) {
          $scope.data = data;
          console.log($scope.data);
      	});

      	$scope.change = function(){
  			var date = $('#date-input').val();
	  		$http.get('/api/daily/'+ date ).success(function(data) {
	          $scope.data = data;
	          console.log($scope.data);
	      	});
      	}
}]);