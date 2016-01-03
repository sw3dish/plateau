<?php

class Post
{
    /**
     * File name
     * @var String
     */
    private $file_name;
    /**
     * Directory where the file is located
     * @var String
     */
    private $dir;
    /**
     * content of post IN MARKDOWN
     * @var String
     */
    private $content;
    /**
     * metadata relating to a post
     * @var Array
     */
    private $metadata;

    const POST_PATH = ROOT . '/application/content/posts';
    const DRAFT_PATH = ROOT . '/application/content/drafts';

    /**
     * Constructor
     * Sets up Post object
     * @param String $post: name of the post (derived from the file name)
     * @param String $dir: directory where posts are found
     * @return null
     */
    public function __construct($file_name, $dir)
    {
        $this->file_name = $file_name;
        $this->dir = $dir;
    }
    /**
     * getFileName
     * return the file name of the post
     * @return String : file name of the post
     */
    public function getFileName()
    {
        return $this->file_name;
    }
    /**
     * getDir
     * return the directory where the file is located
     * @return String : directory where file is located
     */
    public function getDir()
    {
        return $this->dir;
    }
    /**
     * getContent
     * return the content of the post
     * @return String: content of the post IN MARKDOWN
     */
    public function getContent()
    {
        return $this->content;
    }
    /**
     * getMetadata
     * return the metadata of the post
     * @return Array: metadata of the post
     */
    public function getMetadata()
    {
        return $this->metadata;
    }
    /**
     * createPostFromFile
     * set Post object properties from file
     * @return null
     */
    public function createPostFromFile()
    {
        // find the path to the file on the server
        $path = $this->dir . '/' . $this->file_name . '.md';

        // if the post doesn't exists, throw an exception back to the controller
        try {
            $data = file_get_contents($path);
        } catch (Exception $e) {
            throw $e;
        }
        // parse the file for its meta data
        $data = explode('---', $data);
        // move the meta data into its array, and decode the json data
        $this->metadata = json_decode(array_shift($data), true);
        // parse the markdown portion into HTML
        $this->content = $data[0];
    }
    /**
     * savePostToFile
     * save a Post object to a Markdown file
     * @return null
     */
    public function savePostToFile()
    {
        $post = "";
        $post .= json_encode($this->metadata);
        $post .= "---";
        $post .= $this->content();
        file_put_contents($this->dir . '/' . $this->file_name . '.md', $post);
    }
    /**
     * Return an array of all posts in param directory
     * @param  String $dir: directory where posts are found (usually POST_PATH)
     * @return Array: all posts in the specified directory
     */
    public static function getMarkdownPosts($dir)
    {
        // start a directory iterator
	    $files = new \DirectoryIterator($dir);
	    // create an array that will hold our posts
	    $posts = array();
	    // loop through our DirectoryIterator
	    foreach($files as $post) {
	        // only process .md file extensions
	        if($post->getExtension() === 'md') {
	            // get the post file's data
	            $post_data = file_get_contents($post->getPathname());
	            // parse the file for its meta data
	            $post_data = explode('---', $post_data);
	            // move the meta data into its array, and decode the json data
	            $post_meta_json = array_shift($post_data);
	            $post_meta = json_decode($post_meta_json, true);
	            // parse the markdown portion into HTML
	            $md = $app->config('md');
	            $post_html = $md->text($post_data[0]);
	            // save each post to our array, and store
	            // the post details as a new hash
	            $posts[strtotime($post_meta['date'])] = array(
	                    'title'     => $post_meta['title'],
	                    'desc'      => $post_meta['desc'],
	                    'date'      => $post_meta['date'],
	                    'link'      => $post->getBasename('.md'),
	                    'html'      => $post_html
	            );
	        }
	    }
	    // sort our posts (inversely) by created date (the key value)
	    krsort($posts);
	    // return our posts
	    return $posts;
    }
}
