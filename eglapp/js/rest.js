
var apiServer ="http://localhost/eglapp/admin/index.php/";
var adminurl="http://localhost/eglapp/admin/index.php/";
var restservicemod = angular.module('restservicemod', [])

/*$scope.submit = function submit() {
  return $http({
    method: 'POST',
    url: '/your/url',
    headers: {
      'Content-Type': 'multipart/form-data'
    },
    data: {
  file: $scope.file
    },
    transformRequest: formDataObject
  });
};
*/
.factory('RestService', function ($http) {
    

    return {
        authenticate: function(){
            return $http.get(adminurl+"user/authenticate",{});
        },
        getmydetails: function () {
            return $http.get("https://graph.facebook.com/v2.0/me?fields=id%2Cname%2Cpicture&method=GET&format=json&suppress_http_code=1&access_token=CAACEdEose0cBAL2bfrHZAnZBCxmFoqssVWP3cijyPOHHfQ3MZAd1oZCSQZBZARjnZAxK6tzT9xNZBo2yZCQThBCXpTQva1ZCXi2BmLNF7kAXCu274JKcpZBIfwqLhZBnZBC74lmmZBcNdew4ZBDXTICyQ5Fj6cifyxKPi7olLtT0ZA6Ll0A6qOzssyZBHwFTZCI2L79iBQAcoZD",{})
        },
        signup:function(data){
            return $http.get(adminurl+"user/signup",{params:data});
        },
        login:function(data){
            return $http.get(adminurl+"user/login",{params:data});
        },
        createevent: function (data) {
            console.log(data);
            return $http.get(adminurl+"event/create",{params:data});
        },
        update: function (data) {
            return $http.get(adminurl+"event/update",{params:data});
        },
        findoneuser: function (data) {
            return $http.get(adminurl+"user/findone",{params: {id:data}});
        },
        findone: function (data) {
            return $http.get(adminurl+"event/findone?id="+data,{});
        },
        find: function (data) {
            return $http.get(adminurl+"event/showalleventsbyuserid",{params: {id:data}});
        },
        logout: function () {
            return $http.get(adminurl+"user/logout",{});
        },
        findcategoryevent: function (id) {
            return $http.get(adminurl+"category/findalleventbycategory",{params: {category:id}});
        },
        findalleventbysearch: function (search) {
            return $http.get(adminurl+"category/findalleventbysearch",{params: {search:search}});
        },
        saveorganizer: function (data) {
            return $http.get(adminurl+"user/update",{params:data});
        }
    }
});

restservicemod.factory('TopicService', function ($http) {


    return {
        getmydetails: function () {
            return $http.get(apiServer+"topic/find",{})
        },
        createevent: function (data) {
            return $http.get(adminurl+"event/create",{params:data});
        }
    }
});

restservicemod.factory('CategoryService', function ($http) {


    return {
        getmydetails: function () {
            return $http.get(apiServer+"category/find",{})
        },
        findone: function(data){
            return $http.get(adminurl+"category/findone?id="+data,{});
        }
    }
});