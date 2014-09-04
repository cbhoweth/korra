<!doctype html>
<html lang="en" ng-app="korra">
<head>
	<meta charset="UTF-8">
	<title>Korra - Fire | Water | Earth | Air</title>
    <base href="Korra/">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="libraries/loading-bar.min.css" type="text/css" rel="stylesheet" />
    <link href="css/app.css" type="text/css" rel="stylesheet" />
    <script>
        var csrf_token = "{{ csrf_token() }}";
    </script>
</head>
<body>

<header class="navbar navbar-inverse navbar-static-top" id="top" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a ui-sref="home.index" class="navbar-brand">Korra</a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <li ui-sref-active="active">
                    <a ui-sref="home.index">Home</a>
                </li>
                <li ui-sref-active="active">
                    <a ui-sref="posts.index">Posts</a>
                </li>
                <li ui-sref-active="active">
                    <a ui-sref="categories.index">Categories</a>
                </li>
                <li ui-sref-active="active">
                    <a ui-sref="tags.index">Tags</a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<!-- Main Content View used by AngularJS ui-router --->
<div class="Main" ui-view="main"></div>

<footer>
    <div class="container">
        Korra created by <a href="http://www.twitter.com/pathsofdesign">@pathsofdesign</a>
    </div>
</footer>

<script type="text/javascript" src="//cdn.jsdelivr.net/angular.all/1.3.0-beta.14/angular-all.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/restangular/latest/restangular.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/angular.ui-router/0.2.10/angular-ui-router.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/lodash/2.1.0/lodash.compat.min.js"></script>
<script type="text/javascript" src="libraries/loading-bar.min.js"></script>

<script type="text/javascript" src="/Korra/Angular/app.js"></script>

<!-- Post Files -->
<script type="text/javascript" src="/Korra/Angular/Controllers/PostListCtrl.js"></script>
<script type="text/javascript" src="/Korra/Angular/Controllers/PostFormCtrl.js"></script>
<script type="text/javascript" src="/Korra/Angular/Controllers/PostDetailCtrl.js"></script>
<script type="text/javascript" src="/Korra/Angular/Services/PostService.js"></script>

<!-- Tag Files -->
<script type="text/javascript" src="/Korra/Angular/Controllers/TagListCtrl.js"></script>
<script type="text/javascript" src="/Korra/Angular/Controllers/TagFormCtrl.js"></script>
<script type="text/javascript" src="/Korra/Angular/Services/TagService.js"></script>

<!-- Category Files -->
<script type="text/javascript" src="/Korra/Angular/Controllers/CategoryListCtrl.js"></script>
<script type="text/javascript" src="/Korra/Angular/Controllers/CategoryFormCtrl.js"></script>
<script type="text/javascript" src="/Korra/Angular/Services/CategoryService.js"></script>

</body>
</html>
