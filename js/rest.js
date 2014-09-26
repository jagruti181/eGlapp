
var apiServer ="http://digi/eglapp/admin/index.php/";
var adminurl="http://localhost/eglapp/admin/index.php/";
var restservicemod = angular.module('restservicemod', [])

.factory('RestService', function ($http) {
    

    return {
        savesponsor: function(form){
            return $http.get(adminurl+"sponsor/create",{params:form});
        },
        saveticket: function(tickets){
            return $http.get(adminurl+"event/ticket?ticket="+tickets,{});
        },
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
        },
        updateuser: function (data) {
            return $http.get(adminurl+"user/updateuser",{params:data});
        },
        getorder: function (id,uid) {
            return $http.get(adminurl+"order/create?user="+uid+"&event="+id,{});
        },
        getorderdetail: function (id,uid) {
            return $http.get(adminurl+"order/view?user="+uid+"&event="+id,{});
        },
        saveticket: function (user,event,ticketid,ticketquantity) {
            return $http.get(adminurl+"order/create?user="+user+"&event="+event+"&ticketid="+ticketid+"&ticketquantity="+ticketquantity,{});
        },
        getuserticket: function (user) {
            return $http.get(adminurl+"order/viewalleventsbookedbyuser?user="+user,{});
        },
        printticket: function (id,eid) {
            return $http.get(adminurl+"order/viewticket?user="+id+"&event="+eid,{});
        },
        getuserstatus: function (id) {
            return $http.get(adminurl+"user/getuserstatus?id="+id,{});
        },
        getprivateevents: function (email) {
            return $http.get(adminurl+"event/getprivateevents?email="+email,{});
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