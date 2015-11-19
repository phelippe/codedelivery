angular.module('starter.controllers', [])
    .controller('LoginCtrl', ['$scope', 'OAuth', '$ionicPopup', '$state', function ($scope, OAuth, $ionicPopup, $state) {
        //$scope.state = $state.current;
        //$scope.nome = $stateParams.nome;

        $scope.user = {
            username: '',
            password: ''
        };

        $scope.login = function () {

            OAuth.getAccessToken($scope.user)
                .then(function (data) {
                    console.log(data);
                    $state.go('home');
                }, function (responseError) {
                    //console.log('deu xabú');
                    console.log(responseError);
                    $ionicPopup.alert({
                        title: 'Advertência',
                        template: 'Login e/ou senha inválidos',
                    });
                })
        };
    }]);