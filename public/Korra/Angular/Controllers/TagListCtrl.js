'use strict';

angular.module('korra').controller('TagListCtrl', function($rootScope, $scope, $state, Restangular, TagService) {
    $scope.tags = TagService.list().$object;
    $scope.tag = {};

//  Can also be written
//  PostService.getPosts({ limit: params.tagLimit }).then(function(posts) {
//      $scope.categories = categories;
//  });

    /*
     * Actions
     */
    $scope.delete = function(tag) {
        TagService.delete(tag);
    }

    $scope.edit = function(tag) {
        var tagCopy = Restangular.copy(tag);
        $rootScope.$broadcast('tag.edit', tagCopy);
    }

    /*
     * Event Listeners
     */
    $scope.$on('tag.update', function() {
        updateList();
    });

    $scope.$on('tag.create', function() {
        updateList();
    });

    $scope.$on('tag.delete', function() {
        updateList();
    });

    /*
     * Private Functions
     */
    var updateList = function() {
        $scope.tags = TagService.list().$object;
    }
});