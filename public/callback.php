<!DOCTYPE html>
<html ng-app="app">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="/js/angular.min.js"></script>
    <script src="/js/json-formatter.min.js"></script>
    <link rel="stylesheet" href="/js/json-formatter.min.css">
    <script>
app = angular.module('app', ['jsonFormatter'])

.controller('mainController', function($scope, $http) {
    $scope.test = function(api) {
        var url = api.setter instanceof Function ? api.setter() : api.url;
        $http({
        method: api.method,
        url: '/api' + url,
        headers: {
            'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImY0N2I2NzZkMDRiNmNmMGRiNmNhNTY1ZTdjOTY1ZDI2ZjEyMzM5OWIyMjI0MjAwNzZmYTlhZjk5ZDQ5YTZiM2Y3ZjY5YTJiNGQ0ODA5N2ZhIn0.eyJhdWQiOiIyIiwianRpIjoiZjQ3YjY3NmQwNGI2Y2YwZGI2Y2E1NjVlN2M5NjVkMjZmMTIzMzk5YjIyMjQyMDA3NmZhOWFmOTlkNDlhNmIzZjdmNjlhMmI0ZDQ4MDk3ZmEiLCJpYXQiOjE1MDc4NjM3NTMsIm5iZiI6MTUwNzg2Mzc1MywiZXhwIjoxNTM5Mzk5NzUyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.XLZxLtMIsAGa5MdIG5FJERe5XolBV01NsuQOfz1F-4uJmFj0CrwblRDMj7ERhPpCkYFvDcMoA5utIYgB0VIFAtZ8VSd5qeBplp8XWnnl-HZ2TXi_NN0eA58Ue3bgvGsJqCAjzE-IhMFCttxgwnP753BrV_-tgAxaHqkUkYkbRbxIW-neNhcNLonpQXgAro5lkW7dBegw6sPhrlJRtqUB0s-L_bOsxhxVt0-iqDSBoWEupWhIsTfZJ7q3pDq1pFZmYNmWkXWng8INlTRCR05EkWOsKPDbuYYcmYNTE2EGYLxmMJMbmk82hnIQgocKLHuG_Nhj63sYZN7Y6h-SG_TQjgxskDFE2APXDrHENG0e-x9jiol7mpjXrFK8eqHoFyIu6K27Wl3w0PRGr77xcSqKcFM5Z1uXFlEs2ctkwmDqxbpHR36loD_V__zi0DuAJb4JpZ8oHw9eF5B1irSc2lxHkmIHX-jOC8eeSD9Zt_ZvD0FQvqqqvpwNze-546E28fq-vWbkaIo7bPpXpE-D6rAv0MWetuUin1wHNhnmk9-r7vW5QfQgthTfdlHLsXRO3P8E3U2LHV8_-pHXpEAY-Zs3v0IOohluTIILirDRWuhBkeToLwdgu6KRUmD6ZP72G1I6GSEz0iBqnuJKxUzWT6Mj4EY4ce9dtz8iTmw1LWpvUYI'
        },
        data: {}
        }).then(function(response) { $scope.data = response.data; });
    }

    $scope.input = [];
    $scope.apis = [
        {
            'url': '/my/games',
            'method': 'GET'
        },
        {
            'url': '/my/visit/games',
            'method': 'GET'
        },
        {
            'url': '/my/game/{game_id}',
            'method': 'DELETE',
            'options': [
                'game_id'
            ],
            'setter': function(api) {
                 return '/my/game/' + $scope.input[this.options[0]]
            }
        },
        {
            'url': '/my/visit/game/{game_id}',
            'method': 'POST',
            'options': [
                'game_id'
            ],
            'setter': function(api) {
                console.log($scope.input);
                 return '/my/visit/game/' + $scope.input[this.options[0]]
            }
        },
        {
            'url': '/region/{region_id}/games',
            'method': 'GET',
            'options': [
                'region_id'
            ],
            'setter': function(api) {
                 return '/region/' + $scope.input[this.options[0]] + '/games'
            }
        },
        {
            'url': '/my/region/{region_id}/games',
            'method': 'POST',
            'options': [
                'region_id'
            ],
            'setter': function(api) {
                 return '/my/region/' + $scope.input[this.options[0]] + '/games'
            }
        },

    ];
});
    </script>
</head>
<body ng-controller="mainController">
    <?=1?>
    <select ng-model="api">
        <option ng-repeat="api in apis" ng-value="api">{{ api.method + '  ' + api.url }}</option>
    </select>
    <button ng-click="test(api)">送出</button>
    <label ng-repeat="option in api.options"><input type="text" ng-model="input[option]">{{ option }}</label>
    <json-formatter json="data" open="3"></json-formatter>
</body>
</html>