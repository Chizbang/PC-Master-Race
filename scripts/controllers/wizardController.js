app.factory("wizardFactory", function($http){
	var wizard = {};

	wizard.getPageContent = function(){
		var page = $location.path().substring(1, $location.path().length);
		return $http({
			method:"GET",
			url:'api/getcontent.php?page=' + page
		}); 
	};

	return wizard;
});

app.controller("wizardController", function($scope, $location, $http, $state, wizardFactory){
	var wizCtrl = this;
	wizCtrl.page = $location.path().substring(1, $location.path().length); // Put this into a class.
	wizCtrl.content1 = [];
	wizCtrl.headerText;

	wizardFactory.getPageContent().success(function(msg){
		wizCtrl.content1 = msg;
		wizCtrl.content1[0]['extra'] = JSON.parse(wizCtrl.content1[0]['extra']);
	});

});

app.directive("steps", function($timeout){
		return function(scope, element, attr){
			if(scope.$last){
				$timeout(function(){
					$('#wizard').smartWizard();
				});
			}
		};
	});