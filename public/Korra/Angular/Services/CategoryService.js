'use strict';

angular.module('korra').service('CategoryService', function($rootScope, Restangular) {

    // Build collection /categories URL
    var _categoryService = Restangular.all('categories');

    this.list = function() {
        // GET /api/v1/categories
        return _categoryService.getList();
    }

    this.create = function(category) {
        // POST /api/v1/categories
        _categoryService.post(category).then(function() {
            $rootScope.$broadcast('category.create');
        });
    }

    this.update = function(category) {
        // PUT /api/v1/categories/:id
        console.log(category);
        category.put().then(function() {
            $rootScope.$broadcast('category.update');
        });
    }

    this.delete = function(category) {
        // DELETE /api/v1/categories/:id
        category.remove().then(function() {
            $rootScope.$broadcast('category.delete');
        });
    }
});
