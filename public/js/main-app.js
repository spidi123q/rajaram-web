/**
 * You must include the dependency on 'ngMaterial'
 */
var app = angular.module('BlankApp', ['ngMaterial']);
app.config(function($sceDelegateProvider) {
    $sceDelegateProvider.resourceUrlWhitelist([
        // Allow same origin resource loads.
        'self',
        // Allow loading from our assets domain.  Notice the difference between * and **.
        'http://127.0.0.1/**',
        'https://thoughtifies.com/**',
        'https://www.facebook.com/**'
    ]);

    // The blacklist overrides the whitelist so the open redirect here is blocked.
    $sceDelegateProvider.resourceUrlBlacklist([
        'http://myapp.example.com/clickThru**'
    ]);
});
app.controller('MainController', ['$scope', function($scope) {
}]);
app.controller('LiveStream', ['$scope','$http', function($scope,$http) {

    $http({
        method: 'GET',
        url: 'get-fb-stream'
    }).then(function successCallback(response) {
        console.log(response.data)
        $scope.url = response.data.stream_url;
        if(response.data.status === 'LIVE'){
            $scope.status = true
        }
        else {
            $scope.status = false;
        }
    }, function errorCallback(response) {
        // called asynchronously if an error occurs
        // or server returns response with an error status.
        console.log(response)
    });

}]);