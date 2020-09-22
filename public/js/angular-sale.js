
  'use strict';
  var app = angular.module('saytanar',['barcodeScanner']);


  app.controller('angularSaleController',['$scope','$http','$location',function($scope,$http,$location){
      $scope.saledata = [];
      $scope.items = [ ];

      $scope.triggerChar = 9;
			$scope.separatorChar = 13;

      $http.get('/api/sale/items').success(function(data) {
          $scope.items = data;
      });

      $scope.total_profix = function(list){
        var profix=0;
        angular.forEach(list , function(newsaletemp){
            profix+= parseFloat((newsaletemp.price - newsaletemp.cost )* newsaletemp.qty);
        });
        return profix;
      }

      $scope.addSaleTemp = function(item) {
          if( $scope.saledata.length == 0){

              $scope.saledata.push({'id':item.id,'code':item.code,'name':item.name,'price':item.price,'cost':item.cost,'qty':1});
          }else{
              var index = $.map($scope.saledata,function(obj,index){
                if(obj.id == item.id){
                   return index;
                }
              });
              if(index.length == 0)
              {
                 $scope.saledata.push({'id':item.id,'code':item.code,'name':item.name,'price':item.price,'cost':item.cost,'qty':1});
                 console.log($scope.saledata);
              }else{
                $scope.saledata[index].qty = $scope.saledata[index].qty + 1 ;

              }

          }
      }

      $scope.getSaleItem = function(id){
        $http.get('/api/saleitem/' + id ).success(function(data) {
            $scope.saledata = data;
        });
      }

      $scope.updateSaleTemp = function(newsaletemp){
          var index = $.map($scope.saledata,function(obj,index){
              if(obj.id == newsaletemp.id){
                 return index;
              }
          });
          $scope.saledata[index].qty = newsaletemp.qty;
          console.log($scope.saledata);
      }

      $scope.removeSaleTemp = function(id) {
        var index = $.map($scope.saledata,function(obj,index){
            if(obj.id == id){
               return index;
            }
        });
         $scope.saledata.splice(index,1);
      }

      $scope.sum = function(list) {
            var total=0;
            angular.forEach(list , function(newsaletemp){
                total+= parseFloat(newsaletemp.price * newsaletemp.qty);
            });
            return total;
      }

      $scope.triggerCallback = function () {
				$scope.lastTrigger = 'Last trigger callback: ' + new Date().toISOString();
				$scope.$apply();
			};

			$scope.scanCallback = function (word) {
        var index = $.map($scope.items,function(obj,index){
            if(obj.code == word ){
               return index;
            }
        });
        var newitem = $scope.items[index];
        console.log(newitem);
        $scope.addSaleTemp(newitem);
        $scope.$apply();
      };

    $scope.customer = {};
    $http({
        method : 'GET',
        url   : '/api/customers',
        headers : {'Content-Type':'application/x-www-form-urlencoded'}
    }).success(function (response) {
        $scope.customers = response;
    }).error(function (response){
        console.log(response);
        alert('This is embarassing. An error has occured. Please check the log for details');
    });

    $scope.newCustomer = function() {
      console.log($scope.customer);
        $http({
        method : 'POST',
        url   : '/api/customers',
        data : $.param($scope.customer),
        headers : {'Content-Type':'application/x-www-form-urlencoded'}
        }).success(function (response) {
            $('.ui .modal').modal('hide');
            $scope.customers = response;
            $scope.selectedOption = $scope.customers[0];
        }).error(function (response){
            console.log(response);
            alert('This is embarassing. An error has occured. Please check the log for details');
        });
    }

  }]);