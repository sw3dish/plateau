<?php
namespace plateau\models;

class Utility
{
	public static function include_all_files_in_directory($dir,$recursive=false){
		if(is_dir($dir)){
			if ($handle = opendir($dir)) {
			    while (false !== ($entry = readdir($handle))) {
			    	$file_type = filetype($dir . "/" . $entry);
			        if ($entry != "." && $entry != "..") {
			        	if($file_type == "file"){
			        		require_once $dir . "/" . $entry;
			        	}elseif($file_type == "dir"){
			        		if($recursive){
				        		self::include_all_files_in_directory($dir . "/" . $entry,true);
				        	}
			        	}
			        }
			    }
			    closedir($handle);
			}
		}
	}

	public function getMarkdownPosts($dir, $app)
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

    public static function getallheaders()
    {
    	$headers = '';
       	foreach ($_SERVER as $name => $value) {
        	if (substr($name, 0, 5) == 'HTTP_') {
        		$headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
        	}
		}
		return $headers;
	}
}
?>
