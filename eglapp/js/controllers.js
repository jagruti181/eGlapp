	
var phonecatControllers = angular.module('phonecatControllers', ['templateservicemod', 'navigationservice', 'restservicemod', 'ngRoute', 'textAngular', 'ngSanitize']);

phonecatControllers.controller('home', ['$scope', 'TemplateService', 'NavigationService', 'RestService','CategoryService',
  function ($scope, TemplateService, NavigationService, RestService, CategoryService) {
        $scope.template = TemplateService;
        $scope.menutitle = NavigationService.makeactive("Home");
        TemplateService.title = $scope.menutitle;
        TemplateService.content = "views/home.html";
        $scope.navigation = NavigationService.getnav();
        //console.log($scope.navigation);
        $scope.data="jagruti";
        //$scope.demo="working header";
        $scope.flag="0";
        $scope.isloggedin=0;   
        
        $scope.headerarray={'signuplogout':'Signup','loginuser':'Login','userprofile':'login','logout':'signup','preview':'0'};
      var authenticate=function(data, status){
          if(data!="false")
          {
            $scope.isloggedin=1;
            $scope.headerarray={'signuplogout':'Logout','loginuser':data.email,'userprofile':'userprofile','logout':'logout','preview':'0'};
          }
        };
        RestService.authenticate().success(authenticate);
      
      
        var ondetails = function (data, status) {
            $scope.facebook = data;

        };
        RestService.getmydetails().success(ondetails);
      
        var category = function (data, status) {
            console.log(data);
            $scope.cat = data;

        };
        CategoryService.getmydetails().success(category);
      
        $scope.showcategory=function(){
            if($scope.flag=="1")
            {
                $scope.flag="0";
                $scope.visible=true;
            }else{
                $scope.flag="1";
                $scope.visible=false;
            }
        };
       
        var onecategory = function (data, status) {
            console.log(data);
            $scope.search=data.name;
            $scope.heading=data.name;
            //$scope.cat = data;

        };
      
        var categotyevent=function(data, status){
            console.log(data);
            $scope.gatcategoryevent=data;
        };
      
        $scope.categoryclick=function(id){
           CategoryService.findone(id).success(onecategory);
            RestService.findcategoryevent(id).success(categotyevent);
        };
      
      var typesearch=function(data, status){
            console.log(data);
            $scope.gatcategoryevent=data;
        };
      
      $scope.changesearch=function(search){
           $scope.heading=search;
           RestService.findalleventbysearch(search).success(typesearch);
        };
      

  }]);

phonecatControllers.controller('login',
    function ($scope, TemplatService, NavigationService, RestService) {
        $scope.demo = "hello";
        $scope.pass = function (login) {
            $scope.demo = "login";
        };

    });
phonecatControllers.controller('createevents',
 function ($scope, TemplateService, NavigationService, TopicService, CategoryService, RestService, $location) {
        $scope.template = TemplateService;
        $scope.menutitle = NavigationService.makeactive("Create Events");
        TemplateService.title = $scope.menutitle;
        TemplateService.content = "views/create.html";
        $scope.navigation = NavigationService.getnav();
        $scope.disabled = false;
     
        $scope.title=1;
        $scope.changetitle=function(){
            $scope.title=0;
        };
        //######################authentication#####################3
        
       $scope.isloggedin=0;    
        $scope.headerarray={'signuplogout':'Signup','loginuser':'Login','userprofile':'login','logout':'signup','preview':'1'};
        var user=function(data,status){
            console.log(data);
            $scope.organizername=data.firstname;
            $scope.form.organizer=data.id;
        };
      var authenticate=function(data, status){
          console.log(data.id);
          RestService.findoneuser(data.id).success(user);
          if(data!="false")
          {
            $scope.isloggedin=1;
            $scope.headerarray={'signuplogout':'Logout','loginuser':data.email,'userprofile':'userprofile','logout':'logout','preview':'1'};
          }/*else{
              $location.url("/home");
          }*/
        };
        RestService.authenticate().success(authenticate);
        //######################authentication#####################3
     //########################################################################################
     $scope.tickets=[];
      //$scope.total=0;
      $scope.visible=false;
     $scope.addticket=function(type){
         $scope.visible=true;
        
         $scope.userfreeticket={"name":"","qty":"","price":0,"pricetype":type};
         
        // $scope.emptyjson.push({"three":"valuethree"});
         $scope.tickets.push($scope.userfreeticket);
          $scope.total=$scope.tickets.qty;
     };
  
     
     $scope.remove=function(index){
        $scope.tickets.splice(index, 1);
     };
     //########################################################################################
        
         $scope.form={};
        // $scope.form=data;
             var topics = function (data, status) {
                $scope.topics = data;

            };
            TopicService.getmydetails().success(topics);

         var categories = function (data, status) {
             $scope.categories = data;

         };

         CategoryService.getmydetails().success(categories);
     
     

        var created = function (data, state) {
            //console.log(data);
            $scope.form.id=data;
            alert("Event Saved");
             $location.url("/viewevents/"+data);
        };
        $scope.onsubmit = function (form) {
            // console.log(form);
            form.category=form.category.join();
            form.topic=form.topic.join();
            console.log(form);
            RestService.createevent(form).success(created);
            // TopicService.createevent(form).success(consoledata);
        };

  });

phonecatControllers.controller('updateevents', 
 function ($scope, TemplateService, NavigationService, TopicService, CategoryService, RestService, $location, $routeParams) {
        $scope.id = $routeParams.id;
        $scope.value = $routeParams.id;
        $scope.template = TemplateService;
        $scope.menutitle = NavigationService.makeactive("My Events");
        TemplateService.title = $scope.menutitle;
        TemplateService.content = "views/update.html";
        $scope.disabled = false;
        
        $scope.navigation = NavigationService.getnav();
        $scope.isloggedin=0;    
        $scope.headerarray={'signuplogout':'Signup','loginuser':'Login','userprofile':'login','logout':'signup','preview':'1'};
     var user=function(data,status){
            console.log(data);
            $scope.organizername=data.firstname;
            $scope.form.organizer=data.id;
        };
      var authenticate=function(data, status){
          if(data!="false")
          {
            RestService.findoneuser(data.id).success(user);
            $scope.isloggedin=1;
            $scope.headerarray={'signuplogout':'Logout','loginuser':data.email,'userprofile':'userprofile','logout':'logout','preview':'1'};
          }else{
              $location.url("/home");
          }
        };
        RestService.authenticate().success(authenticate);
     $scope.form={};
        //$scope.form.startdate="2014-07-08";
    // $scope.form=data;
         var event=function(data,status){
            $scope.form = {};
            $scope.form = data;
            $scope.form.categoty=data.categoty;
           };
     
         var topics = function (data, status) {
            $scope.topics = data;
            RestService.findone($scope.value).success(event)

        };
         var categories = function (data, status) {
             $scope.categories = data;
            TopicService.getmydetails().success(topics);
         };

         CategoryService.getmydetails().success(categories);

     

        var updated = function (data, state) {
            console.log(data);
            alert("Event Updated");
            $location.url("/viewevents/"+$scope.value);
        };
        $scope.onsubmit = function (form) {
            // console.log(form);
            form.category=form.category.join();
            form.topic=form.topic.join();
            console.log(form);
            RestService.update(form).success(updated);
            // TopicService.createevent(form).success(consoledata);
        };

  });
phonecatControllers.controller('myevents',
  function ($scope, TemplateService, NavigationService, RestService, $location) {
        $scope.template = TemplateService;
        $scope.menutitle = NavigationService.makeactive("My Events");
        TemplateService.title = $scope.menutitle;
        TemplateService.content = "views/myevents.html";
        $scope.navigation = NavigationService.getnav();
      
       //######################authentication#####################3
       $scope.isloggedin=0;    
        $scope.headerarray={'signuplogout':'Signup','loginuser':'Login','userprofile':'login','logout':'signup','preview':'0'};
      var myevent=function(data,status){
          console.log(data);
          // $scope.find=data;
          if(data=="false")
          {
              $scope.usermessage="No data found";
              $scope.visibletable=false;
            
          }else
          {
              $scope.find=data;
          }
      };
      var authenticate=function(data, status){
            
           RestService.find(data.id).success(myevent);
          if(data!="false")
          {
            $scope.isloggedin=1;
            $scope.headerarray={'signuplogout':'Logout','loginuser':data.email,'userprofile':'userprofile','logout':'logout','preview':'0'};
          }else{
              $location.url("/home");
          }
        };
        RestService.authenticate().success(authenticate);
        //######################authentication#####################3
        
     
  });
phonecatControllers.controller('myprofile',
  function ($scope, TemplateService, NavigationService, RestService, $location) {
        $scope.template = TemplateService;
        $scope.menutitle = NavigationService.makeactive("My Profile");
        TemplateService.title = $scope.menutitle;
        TemplateService.content = "views/myprofile.html";
        $scope.navigation = NavigationService.getnav();
      $scope.orightml = '<h2>Try me!</h2><p>textAngular is a super cool WYSIWYG Text Editor directive for AngularJS</p><p><b>Features:</b></p><ol><li>Automatic Seamless Two-Way-Binding</li><li>Super Easy <b>Theming</b> Options</li><li style="color: green;">Simple Editor Instance Creation</li><li>Safely Parses Html for Custom Toolbar Icons</li><li class="text-danger">Doesn&apos;t Use an iFrame</li><li>Works with Firefox, Chrome, and IE8+</li></ol><p><b>Code at GitHub:</b> <a href="https://github.com/fraywing/textAngular">Here</a> </p>';
		$scope.htmlcontent = $scope.orightml;
		$scope.disabled = false;
      
        //$scope.test={"one":"valueone","two":"valuetwo"};
       //$scope.demo=$scope.test.push{"three":"valuethree"};
      
      
        //######################authentication#####################3
       $scope.isloggedin=0;    
        $scope.headerarray={'signuplogout':'Signup','loginuser':'Login','userprofile':'login','logout':'signup','preview':'0'};
      var user=function(data,status){
          console.log(data);    
          $scope.organizer={};
          $scope.organizer=data;
      };
      var authenticate=function(data, status){
          console.log(data.id);
          $scope.organizer={'id':data.id};
          RestService.findoneuser(data.id).success(user);
          if(data!="false")
          {
            $scope.isloggedin=1;
            $scope.headerarray={'signuplogout':'Logout','loginuser':data.email,'userprofile':'userprofile','logout':'logout','preview':'0'};
          }else{
              $location.url("/home");
          }
        };
        RestService.authenticate().success(authenticate);
        //######################authentication#####################3
     
      var saved=function(data,status){
          console.log(data);
          alert("Organizer Updated");
      };
      $scope.saveorganizer=function(data){
          console.log(data);
          RestService.saveorganizer(data).success(saved);
      };
  });
phonecatControllers.controller('mycontacts',
  function ($scope, TemplateService, NavigationService, RestService, $location) {
        $scope.template = TemplateService;
        $scope.menutitle = NavigationService.makeactive("My Contacts");
        TemplateService.title = $scope.menutitle;
        TemplateService.content = "views/mycontacts.html";
        $scope.navigation = NavigationService.getnav();
        //######################authentication#####################3
        $scope.isloggedin=0;    
        $scope.headerarray={'signuplogout':'Signup','loginuser':'Login','userprofile':'login','logout':'signup','preview':'0'};
      var authenticate=function(data, status){
          if(data!="false")
          {
            $scope.isloggedin=1;
            $scope.headerarray={'signuplogout':'Logout','loginuser':data.email,'userprofile':'userprofile','logout':'logout','preview':'0'};
          }else{
              $location.url("/home");
          }
        };
        RestService.authenticate().success(authenticate);
        //######################authentication#####################3
});
phonecatControllers.controller('login',
  function ($scope, TemplateService, NavigationService, RestService, $location) {
        $scope.template = TemplateService;
        TemplateService.title = $scope.menutitle;
        TemplateService.content = "views/login.html";
        $scope.navigation = NavigationService.getnav();
        //######################authentication#####################3
        $scope.isloggedin=0;    
        $scope.headerarray={'signuplogout':'Signup','loginuser':'Login','userprofile':'login','logout':'signup','preview':'0'};
      var authenticate=function(data, status){
          if(data!="false")
          {
            $scope.isloggedin=1;
            $scope.headerarray={'signuplogout':'Logout','loginuser':data.email,'userprofile':'userprofile','logout':'logout','preview':'0'};
          }
        };
        RestService.authenticate().success(authenticate);
        //######################authentication#####################3
        var getlogin = function (data, status) {
            console.log(data);
            if (data == "false") {
                $location.url("/login");
                $scope.msg="Wroung User name Or Password";
            } else {
                $location.url("/home");
               // $scope.msg = "Welcome";
            }
        };
        $scope.loginfunc = function (login) {
            //$scope.demo=login.email;
            RestService.login(login).success(getlogin);
        };
});
phonecatControllers.controller('signup',
  function ($scope, TemplateService, NavigationService, RestService, $location) {
        $scope.template = TemplateService;
        TemplateService.title = $scope.menutitle;
        TemplateService.content = "views/signup.html";
        $scope.navigation = NavigationService.getnav();
        //######################authentication#####################3
        $scope.isloggedin=0;    
        $scope.headerarray={'signuplogout':'Signup','loginuser':'Login','userprofile':'login','logout':'signup','preview':'0'};
      var authenticate=function(data, status){
          console.log(data);
          if(data!="false")
          {
            $scope.isloggedin=1;
            $scope.headerarray={'signuplogout':'Logout','loginuser':data.email,'userprofile':'userprofile','logout':'logout','preview':'0'};
          }
        };
        RestService.authenticate().success(authenticate);
        //######################authentication#####################3

        var saved = function (data, status) {
            console.log(data);
            if (data == "false") {
                $scope.demo = "Email Already Exist";
            } else {
                //$scope.demo = "Login Successful";
                $location.url("/home");
            }
            //$scope.demo="Record saved";
        };
        $scope.signupfunc = function (login) {
            // $scope.demo=login.email;
            RestService.signup(login).success(saved);

        };

});
phonecatControllers.controller('viewevents',  function ($scope, RestService, TemplateService, NavigationService, $location, $routeParams) {

        $scope.template = TemplateService;
        TemplateService.title = $scope.menutitle;
        TemplateService.content = "views/viewevents.html";
        $scope.navigation = NavigationService.getnav();
        $scope.myhtml="<h1>hello</h1>";
        //######################authentication#####################3
        $scope.isloggedin=0;    
        $scope.headerarray={'signuplogout':'Signup','loginuser':'Login','userprofile':'login','logout':'signup','preview':'0'};
      var authenticate=function(data, status){
          if(data!="false")
          {
            $scope.isloggedin=1;
            $scope.headerarray={'signuplogout':'Logout','loginuser':data.email,'userprofile':'userprofile','logout':'logout','preview':'0'};
          }
        };
        RestService.authenticate().success(authenticate);
        //######################authentication#####################3
        console.log($routeParams);
        $scope.id = $routeParams.eventId;
        $scope.value = $routeParams;
        $scope.demo = $scope.value;
    
         var find= function (data, status) {
            //  $scope.area.city=data.city;
            console.log(data);
             
            // $scope.area.city="3";
             $scope.event = data;
             $scope.name=data.title;
             $scope.start=data.startdate;
             $scope.end=data.enddate;
             $scope.dis=data.description;
             $scope.alldata = data;
            //$scope.demo=$scope.alldata[{id}];
        };
        
            RestService.findone($routeParams.eventId).success(find);
  });
phonecatControllers.controller('mytickets',
   function ($scope, TemplateService, NavigationService, RestService) {
        $scope.template = TemplateService;
        $scope.menutitle = NavigationService.makeactive("My Tickets");
        TemplateService.title = $scope.menutitle;
        TemplateService.content = "views/mytickets.html";
        $scope.navigation = NavigationService.getnav();
        //######################authentication#####################3
        $scope.isloggedin=0;    
        $scope.headerarray={'signuplogout':'Signup','loginuser':'Login','userprofile':'login','logout':'signup','preview':'0'};
      var authenticate=function(data, status){
          if(data!="false")
          {
            $scope.isloggedin=1;
            $scope.headerarray={'signuplogout':'Logout','loginuser':data.email,'userprofile':'userprofile','logout':'logout','preview':'0'};
          }
        };
        RestService.authenticate().success(authenticate);
        //######################authentication#####################3
});
phonecatControllers.controller('logout',
   function ($scope, TemplateService, NavigationService, RestService, $location) {
        
        //######################authentication#####################3
        var logout=function(data, status){
            //console.log(data);
            $scope.headerarray={'signuplogout':'Signup','loginuser':'Login','userprofile':'login','logout':'signup','preview':'0'};
            $scope.isloggedin=0;
            $location.url("/home");
        };
        RestService.logout().success(logout);
        //######################authentication#####################3
});
phonecatControllers.controller('discover', ['$scope', 'TemplateService', 'NavigationService',
  function ($scope, TemplateService, NavigationService) {
        $scope.template = TemplateService;
        TemplateService.title = $scope.menutitle;
        TemplateService.content = "views/discover.html";
        $scope.navigation = NavigationService.getnav();
}]);
phonecatControllers.controller('orderform', ['$scope', 'TemplateService', 'NavigationService',
  function ($scope, TemplateService, NavigationService) {
        $scope.template = TemplateService;
        TemplateService.title = $scope.menutitle;
        TemplateService.content = "views/orderform.html";
        $scope.navigation = NavigationService.getnav();
}]);
phonecatControllers.controller('myaccount', ['$scope', 'TemplateService', 'NavigationService',
  function ($scope, TemplateService, NavigationService) {
        $scope.template = TemplateService;
        TemplateService.title = $scope.menutitle;
        TemplateService.content = "views/myaccount.html";
        $scope.navigation = NavigationService.getnav();
}]);
phonecatControllers.controller('orderconfirm', ['$scope', 'TemplateService', 'NavigationService',
                                             function ($scope, TemplateService, NavigationService) {
        $scope.template = TemplateService;
        TemplateService.title = $scope.menutitle;
        TemplateService.content = "views/orderconfirm.html";
        $scope.navigation = NavigationService.getnav();
                                             }]);
phonecatControllers.controller('eventtype', ['$scope', 'TemplateService', 'NavigationService',
                                             function ($scope, TemplateService, NavigationService) {
        $scope.template = TemplateService;
        TemplateService.title = $scope.menutitle;
        TemplateService.content = "views/eventtype.html";
        $scope.navigation = NavigationService.getnav();
                                             }]);
phonecatControllers.controller('waitlist', ['$scope', 'TemplateService', 'NavigationService',
                                             function ($scope, TemplateService, NavigationService) {
        $scope.template = TemplateService;
        TemplateService.title = $scope.menutitle;
        TemplateService.content = "views/waitlist.html";
        $scope.navigation = NavigationService.getnav();
                                             }]);
phonecatControllers.controller('discount', ['$scope', 'TemplateService', 'NavigationService',
                                             function ($scope, TemplateService, NavigationService) {
        $scope.template = TemplateService;
        TemplateService.title = $scope.menutitle;
        TemplateService.content = "views/discount.html";
        $scope.navigation = NavigationService.getnav();
        $scope.demo="hello";
                                             }]);
phonecatControllers.controller('headerctrl', ['$scope', 'TemplateService',
 function ($scope, TemplateService) {
        $scope.template = TemplateService;
  }]);

