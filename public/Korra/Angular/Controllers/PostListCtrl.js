'use strict';

angular.module('korra').controller('PostListCtrl', function($rootScope, $scope, $state, Restangular, PostService) {

    var params = {};

    // Loops through each data params
    _.each($state.current.data, function(val,key) {
       params[key] = val;
    });

    $scope.posts = PostService.list({ limit: params.postLimit }).$object;

    /*
     * Event Listemers
     */
    $scope.$on('post.create', function(post) {
        $scope.posts = PostService.list({ limit: params.postLimit }).$object;
    });
 });
