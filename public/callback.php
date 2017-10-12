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
            'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjE5YzNiYmRiMDU1ODJlOGE3NTNiYTUxNjkxMjcyMWEyNjE0NjI3NDE2ZTc2ZWMzZTY4MTFlNWIyZWM4Yjg2M2RhMTU0ODhlZjdmMjZjMmM5In0.eyJhdWQiOiIyIiwianRpIjoiMTljM2JiZGIwNTU4MmU4YTc1M2JhNTE2OTEyNzIxYTI2MTQ2Mjc0MTZlNzZlYzNlNjgxMWU1YjJlYzhiODYzZGExNTQ4OGVmN2YyNmMyYzkiLCJpYXQiOjE1MDc4MDA5OTMsIm5iZiI6MTUwNzgwMDk5MywiZXhwIjoxNTM5MzM2OTkzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.ehTDX3JkLwyXluZyy_HSwTzFBhcDs7A5ma3O7Ry169QOzk9MKDXnE0sFy0xMA-YC3j9GUbeHbP9FuiKRMn1zF7uIGUM2tSfvE7kjrF0-AeLBnHPcVx1jIcYiWfHOHdIcVh5Yy_ELe8iFcSiDvgC1qqy2Kn37np04hx0c5Hx2MaqA69O1yrPUWVObCs5QgoKub6KRL-C-IJR3ex-NpVLrlmBQS8Qt-HSVz3b0jQOnOLFyJaLcMjogd-Mu6z6JNqr_TvUfyvhZpTUgHs3GB_jeC9hzePGUAZ-ls84-l9zP6Clz6H2RKIMluhnv692JdC9AT12QMvrDfouerP5IrhwZaJT7Z15IYWePn1p9dN2ClgVOFoWH_wQxbXl6RODV82OKaICr7hlLqBFeLlORv5uTEfX7ClWvEzwzNQObX86UMTkS8a4I41bxjdnFLHLdLbet6MNSQ5YWfhzi3cTc6xXD2Viz8GUweSnWPEYY8dPA0dzrtHf4JQJP3K5HPFO44YYRRgE9k8_DyskAyRCZGvyfkCESq90yCJnXZu0eLEf6d-3zFiutKbisGQt4h1veVJPMcaPlBvdm_YPjrcKZp-2wAEtbvchfloixVQzmVtZyJEOFycXgyDb38soQfs6CieOOxXTG9ZLQX4JehDO6-Jm9UKcnta_V6qGpJxUIohCj6tQ'
        },
        data: {}
        }).then(function(response) { $scope.data = response.data; });
    }

    $scope.input = [];
    $scope.apis = [
        {
            'url': '/me/visit/plays',
            'method': 'GET'
        },
        {
            'url': '/me/plays',
            'method': 'GET'
        },
        {
            'url': '/me/visit/play/{play_id}',
            'method': 'POST',
            'options': [
                'play_id'
            ],
            'setter': function(api) {
                console.log($scope.input);
                 return '/me/visit/play/' + $scope.input[this.options[0]]
            }
        }
    ];
});
    </script>
</head>
<body ng-controller="mainController">
    <select ng-model="api">
        <option ng-repeat="api in apis" ng-value="api">{{ api.url }}</option>
    </select>
    <button ng-click="test(api)">送出</button>
    <label ng-repeat="option in api.options"><input type="text" ng-model="input[option]">{{ option }}</label>
    <json-formatter json="data" open="3"></json-formatter>
</body>
</html>