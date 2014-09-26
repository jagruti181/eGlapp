var navigationservice = angular.module('navigationservice', [])

.factory('NavigationService', function () {
    var navigation = [{
            name: "Home",
            classis: "active",
            link: "#/home",
            onsession: "0",
            subnav: []
    }, {
            name: "Create Events",
            active: "",
            link: "#/createevents",
            onsession: "1",
            subnav: []
    }, {
            name: "My Events",
            classis: "",
            link: "#/myevents",
            onsession: "1",
            subnav: []
    }, {
            name: "My Profile",
            classis: "",
            link: "#/myprofile",
            onsession: "1",
            subnav: []
    },
        {
            name: "My Tickets",
            classis: "",
            link: "#/mytickets",
            onsession: "1",
            subnav: []
     },
        {
            name: "My Contacts",
            classis: "",
            link: "#/mycontacts",
            onsession: "1",
            subnav: []
    }];

    return {
        getnav: function () {
            return navigation;
        },
        makeactive: function (menuname) {
            for (var i = 0; i < navigation.length; i++) {
                if (navigation[i].name == menuname) {
                    navigation[i].classis = "active";
                } else {
                    navigation[i].classis = "";
                }
            }
            return menuname;
        }

    }
});