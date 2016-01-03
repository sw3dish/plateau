<?php
// view home page (blog listing -- in this case)
$app->get('/', 'view_blog');
// view blog post
$app->get('/blog/:post', 'view_post');
// view admin page
// $app->get('/admin', 'view_admin');
// create new post
// $app->post('/admin(/:post)', 'modify_post');
// // preview a post
// $app->get('/admin/preview/:post', 'view_preview');
?>
