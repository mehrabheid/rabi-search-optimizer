<?php

if (! defined('ABSPATH')){
    exit;
}


add_filter('posts_search', 'exclude_post_types_from_search', 10, 2);
function exclude_post_types_from_search($search, $query) {
    global $wpdb;
    if ($query->is_search()) {
		$userSearch_string=$query->query['s'];
        if(str_ends_with($userSearch_string,' ')){
            $userSearch_string=substr($userSearch_string,1);
        }
		$userSearch_array=explode(' ',$userSearch_string);
		$stopWords_array=array('و','در','به','که','از','این','را','است','با','برای','آن','نیز','بر','یا','یک','دو','بود','تا','دارد','دیگر','شد','هر','دارند','باید','آنان');

		$wrongWord='ا';
		$targetWord='آ';
		$userSearch_newString='';
		foreach ($userSearch_array as $userSearch_word){

            $userSearch_newWord=$userSearch_word;
            if(str_starts_with($userSearch_word,$wrongWord) && !in_array($userSearch_word,$stopWords_array)){

                $userSearch_newWord=substr_replace($userSearch_word,$targetWord,0,2);

            }    
            $userSearch_newString=$userSearch_newString.' '.$userSearch_newWord;
			
		}
		$userSearch_newString=substr($userSearch_newString,1);
	
		if($userSearch_newString != $userSearch_string)	{
			$search .= "AND {$wpdb->posts}.post_type = 'product' OR ((({$wpdb->posts}.post_title LIKE '%".$userSearch_newString."%' ) AND( {$wpdb->posts}.post_type = 'product') ))"; 
		}	
	}
    return $search;
}
