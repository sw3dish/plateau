<?php
function view_post($post)
{
    require_once ROOT . '/application/models/Post.php';

    $app = \Slim\Slim::getInstance();

    // get the posts directory, and post filename
    $dir = POST::POST_PATH;
    $post = new Post($path, $dir);
    $post->createPostFromFile();

    $post_metadata = $post->getMetadata();
    // parse the markdown portion into HTML
    $post_html = $app->config('md')->text($post->getContent());
    // build the final post object
    $post_result = array(
        'title'     => $post_metadata['title'],
        'date'      => $post_metadata['date'],
        'desc'      => $post_metadata['desc'],
        'html'      => $post_html,
    );
    // render the post view
    $app->render('blog_post.php', array('post' => $post_result));
}
?>
