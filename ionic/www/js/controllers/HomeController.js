angular.module('starter.controllers', [])
    .controller('HomeCtrl', ['$scope', '$cookies', '$http', function ($scope, $cookies, $http) {

        $http({
            method: 'GET',
            url: 'http://localhost:8000/api/user/authenticated',
        }).then(function successCallback(response) {
            console.log(response);
            $scope.user = {
                name: response.data.name,
                email: response.data.email,
            };
        }, function errorCallback(response) {
            console.log(response);
        });
    }]);