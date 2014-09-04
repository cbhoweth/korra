'use strict';

angular.module('korra').controller('TagFormCtrl', function($rootScope, $scope, $state, Restangular, TagService) {
    $scope.tag = {};

    /*
     * Actions
     */
    $scope.create = function(tag) {
        TagService.create(tag);
    }

    $scope.update = function(tag) {
        TagService.update(tag);
    }

    $scope.cancel = function(tag) {
        resetForm();
    }

    /*
     * Event Listeners
     */
    $scope.$on('tag.edit', function(scope, tag) {
        $scope.tag = tag;
    });

    $scope.$on('tag.create', function() {
        resetForm();
    });

    $scope.$on('tag.update', function() {
        resetForm();
    });

    /*
     * Private Functions
     */
    var resetForm = function() {
        $scope.tag = null;
        $scope.tagForm.$setPristine();
    }
});
