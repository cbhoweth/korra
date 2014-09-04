'use strict';

angular.module('korra').service('TagService', function($rootScope, Restangular) {

    // Build collection /posts URL
    var _tagService = Restangular.all('tags');

    // Fetch Posts
    this.list = function() {
        // GET /api/v1/tags
        return _tagService.getList();
    }

    this.create = function(tag) {
        // POST /api/v1/tags
        _tagService.post(tag).then(function() {
            $rootScope.$broadcast('tag.create');
        });
    }

    this.update = function(tag) {
        // PUT /api/v1/tags/:id
        tag.put().then(function() {
            $rootScope.$broadcast('tag.update');
        });
    }

    this.delete = function(tag) {
        // DELETE /api/v1/tags/:id
        tag.remove().then(function() {
            $rootScope.$broadcast('tag.delete');
        });
    }
});
