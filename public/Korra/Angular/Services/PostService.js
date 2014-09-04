'use strict';

angular.module('korra').service('PostService', function($rootScope, Restangular) {

    // Build collection /posts URL
    var _postService = Restangular.all('posts');

    this.list = function(params) {
        // GET /api/v1/posts
        $rootScope.$broadcast('post.list');
        return _postService.getList(params);
    }

    this.show = function(id) {
        // GET /api/v1/posts/:id
        $rootScope.$broadcast('post.show');
        return _postService.get(id);
    }

    this.create = function(post) {
        // POST /api/v1/posts/:id
        _postService.post(post).then(function() {
            $rootScope.$broadcast('post.create');
        });
    }

    this.update = function(post) {
        // PUT /api/v1/posts/:id
        post.put().then(function() {
            $rootScope.$broadcast('post.update');
        });
    }

    this.deleteCategory = function(post, categoryId) {
        // DELETE /api/v1/posts/:id/categories/:id
        post.one('categories', categoryId).remove().then(function() {
            $rootScope.$broadcast('post.category.delete');
        });
    }

    this.deleteTag = function(post, tagId) {
        // DELETE /api/v1/posts/:id/tags/:id
        post.one('tags', tagId).remove().then(function() {
            $rootScope.$broadcast('post.tag.delete');
        });
    }
});
