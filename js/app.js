var app = angular.module('AmDef', ['ngRoute']);

app.config(function($routeProvider) {
    $routeProvider
        .when("/", {
            templateUrl : "/Templates/homeTmpl.html",
            controller : "/Controllers/homeCtrl"
        })
        .when("/classes", {
            templateUrl : "/Templates/classesTmpl.html",
            controller : "/Controllers/classctrl"
        })
        .when("/instructors", {
            templateUrl : "/Templates/instructorsTmpl.html",
            controller : "/Controllers/instructorctrl"
        })
        .when("/contact", {
            templateUrl : "/Templates/contactTmpl.html",
            controller : "/Controllers/contactctrl"
        })
        .otherwise({
            redirectTo: '/'
        })
});