'use strict';

angular.module('korra').controller('PostFormCtrl', function($scope, $stateParams, PostService, CategoryService, TagService) {

    $scope.post = {};

    // If Post Id Param is passed then grab the post and populate the form
    if (_.has($stateParams, 'id')) {
        updateFormWithCategoriesAndTags();
    }

    $scope.categories = CategoryService.list().$object;
    $scope.tags = TagService.list().$object;

    /*
     * Actions
     */
    $scope.create = function(post) {
        PostService.create(post);
    };

    $scope.update = function(post) {
        PostService.update(post);
    }

    /*
     * Event Listeners
     */
    $scope.$on('post.update', function() {
        $scope.postForm.$setPristine();
    });

    $scope.$on('post.category.delete', function() {
        updateFormWithCategoriesAndTags()
    });

    $scope.$on('post.tag.delete', function() {
        updateFormWithCategoriesAndTags()
    });

    /*
     * Private Functions
     */
    function updateFormWithCategoriesAndTags() {
        PostService.show($stateParams.id).then(function(post) {
            $scope.post = post;
            $scope.post.categories = _.pluck($scope.post.categories, 'id');
            $scope.post.tags = _.pluck($scope.post.tags, 'id');
        });
    }
});
