
  'use strict';
  var app = angular.module('saytanar',['barcodeScanner']);


  app.controller('angularParchaseController',['$scope','$http','$location',function($scope,$http,$location){
      $scope.purchasedata = [];
      $scope.items = [ ];

      $scope.triggerChar = 9;
			$scope.separatorChar = 13;

      $http.get('/api/items').success(function(data) {
          $scope.items = data;
      });

      $scope.total_profix = function(list){
        var profix=0;
        angular.forEach(list , function(newpurchasetemp){
            profix+= parseFloat((newpurchasetemp.price - newpurchasetemp.cost )* newpurchasetemp.qty);
        });
        return profix;
      }

      $scope.newSupplier = function() {
        $http({
        method : 'POST',
        url   : '/api/suppliers',
        data : $.param($scope.supplier),
        headers : {'Content-Type':'application/x-www-form-urlencoded'}
        }).success(function (response) {
            $('.ui .modal').modal('hide');
            $scope.suppliers = response;
            $scope.selectedOption = $scope.suppliers[0];
        }).error(function (response){
            console.log(response);
            alert('This is embarassing. An error has occured. Please check the log for details');
        });
      }

      $scope.addPurchaseTemp = function(item) {
          if( $scope.purchasedata.length == 0){

              $scope.purchasedata.push({'id':item.id,'code':item.code,'name':item.name,'price':item.price,'cost':item.cost,'qty':1});

              console.log($scope.purchasedata);
          }else{
              var index = $.map($scope.purchasedata,function(obj,index){
                if(obj.id == item.id){
                   return index;
                }
              });
              if(index.length == 0)
              {
                 $scope.purchasedata.push({'id':item.id,'code':item.code,'name':item.name,'price':item.price,'cost':item.cost,'qty':1});
                 console.log($scope.purchasedata);
              }else{
                $scope.purchasedata[index].qty = $scope.purchasedata[index].qty + 1 ;
                console.log($scope.purchasedata);
              }

          }
      }

      $scope.getParchaseItem = function(id){
        $http.get('/api/purchaseitem/' + id ).success(function(data) {
            $scope.purchasedata = data;
        });
      }

      $scope.updatePurchaseTemp = function(newpurchasetemp){
          var index = $.map($scope.purchasedata,function(obj,index){
              if(obj.id == newpurchasetemp.id){
                 return index;
              }
          });
          $scope.purchasedata[index].qty = newpurchasetemp.qty;
          console.log($scope.purchasedata);
      }

      $scope.showupdatePurchaseTemp = function(newpurchasetemp){

        var index = $.map($scope.purchasedata,function(obj,index){
            if(obj.id == newpurchasetemp.id){
               return index;
            }
        });

        $scope.editpurchaseid = $scope.purchasedata[index].id;
        $scope.editpurchasecode = $scope.purchasedata[index].code;
        $scope.editpurchasename = $scope.purchasedata[index].name;
        $scope.editpurchaseprice = $scope.purchasedata[index].price;
        $scope.editpurchasecost = $scope.purchasedata[index].cost;
        $scope.editpurchaseqty = $scope.purchasedata[index].qty;
        $('.ui.item').modal('show');
      }

      $scope.updatePurchase = function(editpurchaseid,editpurchasecode,editpurchasename,editpurchaseprice,editpurchasecost,editpurchaseqty){
        var index = $.map($scope.purchasedata,function(obj,index){
            if(obj.id == editpurchaseid){
               return index;
            }
        });
        
        $scope.purchasedata[index].id   = editpurchaseid;
        $scope.purchasedata[index].code = editpurchasecode;
        $scope.purchasedata[index].name = editpurchasename;
        $scope.purchasedata[index].price = editpurchaseprice;
        $scope.purchasedata[index].cost = editpurchasecost;
        $scope.purchasedata[index].qty = editpurchaseqty;
         $('.ui.item').modal('hide');
      }


      $scope.removePurchaseTemp = function(id) {
        var index = $.map($scope.purchasedata,function(obj,index){
            if(obj.id == id){
               return index;
            }
        });
         $scope.purchasedata.splice(index,1);
      }

      $scope.sum = function(list) {
            var total=0;
            angular.forEach(list , function(newpurchasetemp){
                total+= parseFloat(newpurchasetemp.cost * newpurchasetemp.qty);
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
        $scope.addParchaseTemp(newitem);
        $scope.$apply();
      };

    $scope.supplier = {};
    $http({
        method : 'GET',
        url   : '/api/suppliers',
        headers : {'Content-Type':'application/x-www-form-urlencoded'}
    }).success(function (response) {
        $scope.suppliers = response;
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
