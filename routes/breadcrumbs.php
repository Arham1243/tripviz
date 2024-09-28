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
Breadcrumbs::for('admin.blogs.edit', function (BreadcrumbTrail $trail, $blog) {
    $trail->parent('admin.blogs.index');
    $trail->push($blog->title, route('admin.blogs.edit', $blog->id));
});

Breadcrumbs::for('admin.blogs-categories.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.blogs.index');
    $trail->push('Categories', route('admin.blogs-categories.index'));
});
Breadcrumbs::for('admin.blogs-categories.edit', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('admin.blogs-categories.index');
    $trail->push($category->name, route('admin.blogs-categories.edit', $category->id));
});
Breadcrumbs::for('admin.blogs-tags.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.blogs.index');
    $trail->push('Tags', route('admin.blogs-tags.index'));
});
Breadcrumbs::for('admin.blogs-tags.edit', function (BreadcrumbTrail $trail, $tag) {
    $trail->parent('admin.blogs-tags.index');
    $trail->push($tag->name, route('admin.blogs-tags.edit', $tag->id));
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
Breadcrumbs::for('admin.news.edit', function (BreadcrumbTrail $trail, $news) {
    $trail->parent('admin.news.index');
    $trail->push($news->title, route('admin.news.edit', $news->id));
});
Breadcrumbs::for('admin.news-categories.edit', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('admin.news-categories.index');
    $trail->push($category->name, route('admin.news-categories.edit', $category->id));
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
Breadcrumbs::for('admin.news-tags.edit', function (BreadcrumbTrail $trail, $tag) {
    $trail->parent('admin.news-tags.index');
    $trail->push($tag->name, route('admin.news-tags.edit', $tag->id));
});
// ---------------News---------------
