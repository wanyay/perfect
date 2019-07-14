var app = angular.module('saytanar', []);

app.controller('angularMonthlyController',['$scope','$http','$location',function($scope,$http,$location){
		$scope.data = [];
		$scope.getFormData = function () {
			var month = $('#month').val();
			var year  = $('#year').val();

			$http({
				method : 'POST',
				url : '/api/monthly',
				data : {month : month , year : year}
			}).success(function(data) {
	          $scope.data = data;
	          console.log($scope.data);
	      	});
		}
}]);