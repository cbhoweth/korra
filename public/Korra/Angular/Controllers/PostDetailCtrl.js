'use strict';

angular.module('korra').controller('PostDetailCtrl', function($rootScope, $scope, $state, $stateParams, Restangular, PostService) {
    $scope.post = PostService.show($stateParams.id).$object;

    /*
     * Actions
     */
    $scope.deleteCategory = function(post, categoryId) {
        PostService.deleteCategory(post, categoryId);
    }

    $scope.deleteTag = function(post, tagId) {
        PostService.deleteTag(post, tagId);
    }

    /*
     * Event Listeners
     */
    $scope.$on('post.update', function() {
        $scope.post = PostService.show($stateParams.id).$object;
    });

    $scope.$on('post.category.delete', function() {
        $scope.post = PostService.show($stateParams.id).$object;
    });

    $scope.$on('post.tag.delete', function() {
        $scope.post = PostService.show($stateParams.id).$object;
    });
});
