<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Admin Dashboard
Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

// ---------------Blogs---------------
Breadcrumbs::for('admin.blogs.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Blogs', route('admin.blogs.index'));
});
Breadcrumbs::for('admin.blogs.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.blogs.index');
    $trail->push('Add Blog', route('admin.blogs.create'));
});
Breadcrumbs::for('admin.blogs-categories.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.blogs.index');
    $trail->push('Categories', route('admin.blogs-categories.index'));
});
Breadcrumbs::for('admin.blogs-tags.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.blogs.index');
    $trail->push('Tags', route('admin.blogs-tags.index'));
});
// ---------------Blogs---------------

Breadcrumbs::for('admin.recovery.index', function (BreadcrumbTrail $trail, $resource) {
    $trail->parent("admin.$resource.index"); // Dynamically set the parent breadcrumb
    $trail->push('Recovery', route('admin.recovery.index', ['resource' => $resource]));
});

// ---------------News---------------
Breadcrumbs::for('admin.news.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('News', route('admin.news.index'));
});
Breadcrumbs::for('admin.news.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.news.index');
    $trail->push('Add News', route('admin.news.create'));
});
Breadcrumbs::for('admin.news-categories.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.news.index');
    $trail->push('Categories', route('admin.news-categories.index'));
});
Breadcrumbs::for('admin.news-tags.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.news.index');
    $trail->push('Tags', route('admin.news-tags.index'));
});
// ---------------News---------------
