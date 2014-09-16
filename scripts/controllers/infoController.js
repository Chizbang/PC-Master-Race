app.factory("content", function($http, $location){
	var content = {};

	content.getPageContent = function(){
		var page = $location.path().substring(1, $location.path().length);

		return $http({
			method: "GET",
			url: "api/getcontent.php?page="+page
		});
	};

	content.getEditContent = function(){
		var page = $location.path().substring(1, $location.path().length);

		return $http({
			method: "GET",
			url: "api/getedit.php?page="+page
		});	
	}

	content.saveHeader = function(sendContent){
		var page = $location.path().substring(1, $location.path().length);

		return $http({
			method: "POST",
			url: "api/saveedit.php",
			data: $.param({"data":sendContent}),
			headers: {"Content-Type": "application/x-www-form-urlencoded"}
		});
	}

	content.saveContent = function(sendContent){
		var page = $location.path().substring(1, $location.path().length);

		return $http({
			method: "POST",
			url: "api/saveedit.php",
			data: $.param({"data": sendContent}),
			headers: {"Content-Type": "application/x-www-form-urlencoded"}
		});
	}

	return content;
});

app.controller("infoController", function($scope, $location, $http, $state, content){
	var infoCtrl = this;
	infoCtrl.page = $location.path().substring(1, $location.path().length);
	infoCtrl.content1 = [];
	infoCtrl.editContent = [];
	infoCtrl.headerText;
	infoCtrl.editTitle = false;
	infoCtrl.editContent = false;

	$scope.saveChanges = function(type){
		if(type == "head"){
			infoCtrl.post = {"where":"header", "content": infoCtrl.content1[0].header, "page":infoCtrl.page};
			content.saveHeader(infoCtrl.post).success(function(msg){
					$state.reload();
				});
		} else if(type == "content"){
			infoCtrl.post = {"where":"content", "content": infoCtrl.editContentContent[0].content, "page":infoCtrl.page};
			content.saveContent(infoCtrl.post).success(function(msg){
				$state.reload();
			});
		}
	};

	content.getPageContent().success(function(msg){
		infoCtrl.content1 = msg;
	});
	
	content.getEditContent().success(function(msg){
		infoCtrl.editContentContent = msg;
	});
});
