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
Breadcrumbs::for('admin.news.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.news.index');
    $trail->push('Add News', route('admin.news.create'));
});
Breadcrumbs::for('admin.news.edit', function (BreadcrumbTrail $trail, $news) {
    $trail->parent('admin.news.index');
    $trail->push($news->title, route('admin.news.edit', $news->id));
});
Breadcrumbs::for('admin.news-categories.edit', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('admin.news-categories.index');
    $trail->push($category->name, route('admin.news-categories.edit', $category->id));
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

// ---------------countries---------------
Breadcrumbs::for('admin.countries.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Countries', route('admin.countries.index'));
});
Breadcrumbs::for('admin.countries.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.countries.index');
    $trail->push('Add Country', route('admin.countries.create'));
});
Breadcrumbs::for('admin.countries.edit', function (BreadcrumbTrail $trail, $country) {
    $trail->parent('admin.countries.index');
    $trail->push($country->name, route('admin.countries.edit', $country->id));
});
// ---------------countries---------------

// ---------------cities---------------
Breadcrumbs::for('admin.cities.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Cities', route('admin.cities.index'));
});
Breadcrumbs::for('admin.cities.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.cities.index');
    $trail->push('Add City', route('admin.cities.create'));
});
Breadcrumbs::for('admin.cities.edit', function (BreadcrumbTrail $trail, $city) {
    $trail->parent('admin.cities.index');
    $trail->push($city->name, route('admin.cities.edit', $city->id));
});
// ---------------cities---------------

// ---------------Tours---------------

Breadcrumbs::for('admin.tours.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Tours', route('admin.tours.index'));
});
Breadcrumbs::for('admin.tours.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.tours.index');
    $trail->push('Add Tour', route('admin.tours.create'));
});
Breadcrumbs::for('admin.tours.edit', function (BreadcrumbTrail $trail, $item) {
    $trail->parent('admin.tours.index');
    $trail->push($item->title, route('admin.tours.edit', $item->id));
});
Breadcrumbs::for('admin.tour-categories.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.tours.index');
    $trail->push('Categories', route('admin.tour-categories.index'));
});
Breadcrumbs::for('admin.tour-categories.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.tour-categories.index');
    $trail->push('Add Category', route('admin.tour-categories.create'));
});
Breadcrumbs::for('admin.tour-categories.edit', function (BreadcrumbTrail $trail, $item) {
    $trail->parent('admin.tour-categories.index');
    $trail->push($item->name, route('admin.tour-categories.edit', $item->id));
});
// ---------------Tours---------------
