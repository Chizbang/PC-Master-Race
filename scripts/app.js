var app = angular.module("myApp", ['dotjem.routing']);

app.service('menuBar', function(){
	var self = this;

	self.register = function(title, state){
		self.items.push({title: title, state: state});
	}
})

app.service('admin', function($http, $q){
	var self = this;

	self.adminOrNot = function(){
		var defer = $q.defer();
		var promise = $http.get("api/user.php");
		return promise;
	}
});

app.service('pages', function($http){
	var self = this;
	var promise = null;

	self.getPages = function(){
		if(!promise){
			promise = $http.get("api/getpages.php");
		}
		return promise;
	}
});

app.config(function($locationProvider, $routeProvider, $stateProvider){
	$locationProvider.html5Mode(true)
	$routeProvider.otherwise({redirectTo: '/home'});

	$stateProvider.state('home', {
		route: '/home',
		views: {
			"main": {
				template:"template/standardview.html"
			}
		}
	});
	
	$stateProvider.state('admin', {
		route: '/admin',
		views: {
			"main": {
				template:"template/admin.html"
			}
		}
	});
	
	$stateProvider.state(['$register', '$http', 'pages', function(register, http, pages){
		return pages.getPages().then(function(data){
			for(state in data.data){
				register(data.data[state].stateName, {
					route: data.data[state].path,
					views: { "main": { template: data.data[state].templateUrl } }
				});
			}
		});
	}]);

});

app.controller("mainController", function($scope, admin){
	var self = this;
	var scope = $scope;

	admin.adminOrNot().then(function(data){
		if(data.data.error == "204"){
			scope.adminStatus = false;
		} else if(data.data.steamid != null){
			scope.adminStatus = true;
		}
	});
});

app.controller("menuBar", function($scope, $http, pages){ // Make a service for the menuBer which is reliant on the stateproviders JSON which is the same as this. Saves making 2 of the same requests....
	var menu = this;
	menu.list = [];

	pages.getPages().then(function(data){
		menu.list = data.data;
	});
});

app.filter('unsafe', function($sce) {
	return function(val) {
		return $sce.trustAsHtml(val);
	};
});

app.directive('header', function() {
	return {
		restrict: 'E',
		templateUrl: 'template/head.html'
	};
});
