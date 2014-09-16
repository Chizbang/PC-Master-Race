app.controller("admin", function($scope, $location, $http, $state){
	$http.get("api/getTemplates.php").success(function(msg){
		adminController.availableTemplates = msg;
	});

	this.page = $location.path().substring(1, $location.path().length);
	var adminController = this;
	var adminScope = $scope;
	adminController.availablePages;
	adminController.availableTemplates;

	adminScope.stageIndex = 0;
	$scope.wizardSteps = [];

	$http.get("api/getpages.php").success(function(msg){
		adminController.availablePages = msg;
	});
	$http.get("api/getTemplates.php").success(function(msg){
		adminController.availableTemplates = msg;

	});

	$scope.addNewPage = function(){
		adminController.newPageData = {"dispname":adminScope.dispname, "path":adminScope.path, "type":adminScope.pageType, "header":adminScope.header, "content":adminScope.pageContent, "extra":JSON.stringify(adminScope.wizardSteps)};
		$http({
			method: "POST",
			url: "api/newpage.php",
			data: $.param({"data": adminController.newPageData}),
			headers: {"Content-Type": "application/x-www-form-urlencoded"}
		}).success(function(msg){
			alert(msg);
		});
	};

	$scope.addNewStage = function(){
	};

});

app.directive('newinfo', function(){
	return{
		restrict: 'E',
		templateUrl: 'template/admin/newInfo.html'
	};
});
/*
app.directive('newstage', function(){
	return function(scope, element, attrs){

		element.click(function($scope){
			scope.wizardSteps.push({content:""});
		});
	}
});
*/