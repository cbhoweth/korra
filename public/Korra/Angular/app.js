'use strict';

angular.module('korra', ['ui.router', 'restangular', 'chieffancypants.loadingBar'])
    .config(function($stateProvider, $httpProvider, $urlRouterProvider, RestangularProvider) {

        RestangularProvider.setBaseUrl('http://korra.dev/api/v1');

        $urlRouterProvider.otherwise("/");
        //
        // Now set up the states
        $stateProvider
            .state('home', {
                abstract: true,
                views: {
                    'main': {
                        'templateUrl': '/Korra/Angular/Views/Layouts/home.html'
                    }
                }
            })
            .state('home.index', {
                url: "/",
                data: {
                    postLimit: 5
                },
                views: {
                    "posts": {
                        templateUrl: '/Korra/Angular/Views/Posts/list.html',
                        controller: "PostListCtrl"
                    }
                }
            })
            .state('posts', {
                url: "",
                abstract: true,
                views: {
                    'main': {
                        'templateUrl': '/Korra/Angular/Views/Layouts/posts.html'
                    }
                }
            })
            .state('posts.index', {
                url: "/posts",
                views: {
                    posts: {
                        templateUrl: '/Korra/Angular/Views/Posts/list.html',
                        controller: "PostListCtrl"
                    },
                    postForm: {
                        templateUrl: '/Korra/Angular/Views/Posts/form.html',
                        controller: "PostFormCtrl"
                    }
                }
            })
            .state('posts.detail', {
                url: "/posts/:id",
                views: {
                    posts: {
                        templateUrl: '/Korra/Angular/Views/Posts/detail.html',
                        controller: "PostDetailCtrl"
                    },
                    postForm: {
                        templateUrl: '/Korra/Angular/Views/Posts/form.html',
                        controller: "PostFormCtrl"
                    }
                }
            })
            .state('categories', {
                url: "",
                abstract: true,
                views: {
                    'main': {
                        'templateUrl': '/Korra/Angular/Views/Layouts/categories.html'
                    }
                }
            })
            .state('categories.index', {
                url: "/categories",
                views: {
                    categories: {
                        templateUrl: '/Korra/Angular/Views/Categories/list.html',
                        controller: "CategoryListCtrl"
                    },
                    categoryForm: {
                        templateUrl: '/Korra/Angular/Views/Categories/form.html',
                        controller: "CategoryFormCtrl"
                    }
                }
            })
            .state('tags', {
                url: "",
                abstract: true,
                views: {
                    'main': {
                        'templateUrl': '/Korra/Angular/Views/Layouts/tags.html'
                    }
                }
            })
            .state('tags.index', {
                url: "/tags",
                views: {
                    tags: {
                        templateUrl: '/Korra/Angular/Views/Tags/list.html',
                        controller: "TagListCtrl"
                    },
                    tagForm: {
                        templateUrl: '/Korra/Angular/Views/Tags/form.html',
                        controller: "TagFormCtrl"
                    }
                }
            })
    });