<?php
function view_blog()
{
    require_once ROOT . '/application/models/Post.php';

    $app = \Slim\Slim::getInstance();

    $posts = Post::getMarkdownPosts(Post::POST_PATH);

    return $app->render('view_blog.php', array(
            'posts'         => $posts,
            'pagination'    => 4
    ));
}
?>
