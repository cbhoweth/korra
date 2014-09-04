'use strict';

angular.module('korra').controller('CategoryFormCtrl', function($rootScope, $scope, $state, Restangular, CategoryService) {
    $scope.category = {};

    /*
     * Actions
     */
    $scope.create = function(category) {
        CategoryService.create(category);
    }

    $scope.update = function(category) {
        CategoryService.update(category);
    }

    $scope.cancel = function(category) {
        resetForm();
    }

    /*
     * Event Listeners
     */
    $scope.$on('category.edit', function(scope, category) {
        $scope.category = category;
    });

    $scope.$on('category.create', function() {
        resetForm();
    });

    $scope.$on('category.update', function() {
        resetForm();
    });

    /*
     * Private Functions
     */
    var resetForm = function() {
        $scope.category = null;
        $scope.categoryForm.$setPristine();
    }
});
