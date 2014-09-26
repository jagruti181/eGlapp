// JavaScript Document
var firstapp = angular.module('firstapp', [
  'ngRoute',
  'phonecatControllers',
  'templateservicemod',
    'navigationservice',
    'restservicemod'
]);

firstapp.config(['$routeProvider',
  function ($routeProvider,$routeParams) {
        $routeProvider.
        when('/home', {
            templateUrl: 'views/template.html',
            controller: 'home'
        }).
        when('/createevents', {
            templateUrl: 'views/template.html',
            controller: 'createevents'
        }).
        when('/updateevents/:id', {
            templateUrl: 'views/template.html',
            controller: 'updateevents'
        }).
        when('/myevents', {
            templateUrl: 'views/template.html',
            controller: 'myevents'
        }).
        when('/myprofile', {
            templateUrl: 'views/template.html',
            controller: 'myprofile'
        }).
        when('/userprofile', {
            templateUrl: 'views/template.html',
            controller: 'myprofile'
        }).
        when('/mycontacts', {
            templateUrl: 'views/template.html',
            controller: 'mycontacts'
        }).
        when('/login', {
            templateUrl: 'views/template.html',
            controller: 'login'
        }).
        when('/logout', {
            templateUrl: 'views/template.html',
            controller: 'logout'
        }).
        when('/signup', {
            templateUrl: 'views/template.html',
            controller: 'signup'
        }).
        when('/myaccount', {
            templateUrl: 'views/template.html',
            controller: 'myaccount'
        }).
        when('/viewevents/:eventId', {
            templateUrl: 'views/template.html',
            controller: 'viewevents'
        }).
        when('/mytickets', {
            templateUrl: 'views/template.html',
            controller: 'mytickets'
        }).
        when('/discover', {
            templateUrl: 'views/template.html',
            controller: 'discover'
        }).
        when('/orderform', {
            templateUrl: 'views/template.html',
            controller: 'orderform'
        }).
        when('/orderconfirm', {
            templateUrl: 'views/template.html',
            controller: 'orderconfirm'
        }).
        when('/eventtype', {
            templateUrl: 'views/template.html',
            controller: 'eventtype'
        }).
        when('/waitlist', {
            templateUrl: 'views/template.html',
            controller: 'waitlist'
        }).
        when('/discount', {
            templateUrl: 'views/template.html',
            controller: 'discount'
        }).
        otherwise({
            redirectTo: '/home'
        });
  }]);