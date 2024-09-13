<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Admin Dashboard
Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

// Blogs
Breadcrumbs::for('admin.blogs.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Blogs', route('admin.blogs.index'));
});

Breadcrumbs::for('admin.blogs.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.blogs.index');
    $trail->push('Add Blog', route('admin.blogs.create'));
});

// Blogs Categories
Breadcrumbs::for('admin.blogs-categories.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.blogs.index');
    $trail->push('Categories', route('admin.blogs-categories.index'));
});

// Blogs Tags
Breadcrumbs::for('admin.blogs-tags.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.blogs.index');
    $trail->push('Tags', route('admin.blogs-tags.index'));
});
