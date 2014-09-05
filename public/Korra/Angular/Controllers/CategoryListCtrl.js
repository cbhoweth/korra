'use strict';

angular.module('korra').controller('CategoryListCtrl', function($rootScope, $scope, $state, Restangular, CategoryService) {
    $scope.categories = CategoryService.list().$object;
    $scope.category = {};

    /*
     * Actions
     */
    $scope.delete = function(category) {
        CategoryService.delete(category);
    }

    $scope.edit = function(category) {
        var categoryCopy = Restangular.copy(category);
        $rootScope.$broadcast('category.edit', categoryCopy);
    }

    /*
     * Event Listeners
     */
    $scope.$on('category.update', function() {
        updateList();
    });

    $scope.$on('category.create', function() {
        updateList();
    });

    $scope.$on('category.delete', function() {
        updateList();
    });

    /*
     * Private Functions
     */
    var updateList = function() {
        $scope.categories = CategoryService.list().$object;
    }
});