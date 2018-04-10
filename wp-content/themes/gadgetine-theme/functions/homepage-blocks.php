<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/* -------------------------------------------------------------------------*
 * 								HOMEPAGE BUILDER							*
 * -------------------------------------------------------------------------*/
 
class OT_home_builder {

	private static $data;
	public static $duplicateArray = array();
	private static $counter = -1; 


	private function block_values($blocksContent,$values) {
		wp_reset_query();
		global $post;

		//asign them to strings with id name
		foreach ($blocksContent->blocksContent as $id => $value) {
			$c = self::counter();
			${substr($id, 0, strrpos($id, "_"))} = $value;
		}
		
		//shorter string name
		foreach ($values as $value){
			$array[$value] = (isset(${THEME_NAME."_".$value})) ? ${THEME_NAME."_".$value} : false ;
		}

		return $array;

	}

	private function ot_option($option) {
		return get_option(THEME_NAME."_".$option);
	}

	//check and remove duplicated posts if needed
	private function duplicate($args) {
		if($this->ot_option("duplicate") == "on") {
			$args['post__not_in'] = $this->get_double();
		}
		return $args;
	}

	/* -------------------------------------------------------------------------*
	 * 							HOMEPAGE LATEST NEWS						*
	 * -------------------------------------------------------------------------*/
	 
	public function homepage_news_block($blocks,$columnID) {
		global $post;
		//set variable short names
		$values = array("title", "count", "color", "offset", "cat");

		//extract the block variables
		extract($this->block_values($blocks,$values));


		if($cat) {
			$link = get_category_link($cat);
		} else {
			$link = get_page_link(get_option('page_for_posts'));
		}

		//set wp query
		$args = array(
			'post_type' => "post",
			'cat' => $cat,
			'offset' =>$offset,
			'showposts' => $count,
			'ignore_sticky_posts' => "1"
		);

		//check for duplicate posts
		$args = $this->duplicate($args);

		$my_query = new WP_Query($args);
	

		//set block attributes
		$attr = array(
			'count' =>$count,
			'cat' => $cat,
			'offset' =>$offset,
			'link' =>$link,
			'columnID' =>$columnID,
			'color' =>$color,
			'title' =>$title
		);

		//add all data in array
		$data = array($my_query, $attr);

		//set data
		$this->set_data($data);

		$block = "latest-news-1";
		get_template_part(THEME_HOME_BLOCKS.$block);
	}

	/* -------------------------------------------------------------------------*
	 * 						HOMEPAGE FEATURED NEWS BLOCK	 					*
	 * -------------------------------------------------------------------------*/
	 
	public function homepage_news_block_2($blocks,$columnID) {
		//set variable short names
		$values = array("count", "offset", "cat");

		//extract the block variables
		extract($this->block_values($blocks,$values));

		//set wp query
		$args = array(
			'post_type' => "post",
			'cat' => $cat,
			'offset' =>$offset,
			'showposts' => $count,
			'meta_key'	=> "_".THEME_NAME.'_featured',
			'meta_value'	=> 'on',
			'ignore_sticky_posts' => "1"
		);

		//check for duplicate posts
		$args = $this->duplicate($args);

		$my_query = new WP_Query($args);
	

		//set block attributes
		$attr = array(
			'cat' => $cat,
			'offset' =>$offset,
			'columnID' =>$columnID,
			'link' => false,
		);


		//add all data in array
		$data = array($my_query, $attr);

		//set data
		$this->set_data($data);
		$block = "featured";
		get_template_part(THEME_HOME_BLOCKS.$block);
	}
	/* -------------------------------------------------------------------------*
	 * 							HOMEPAGE VIDEO BLOCK		 					*
	 * -------------------------------------------------------------------------*/
	 
	public function homepage_news_block_3($blocks,$columnID) {
		//set variable short names
		$values = array("title", "count", "color", "offset", "cat");

		//extract the block variables
		extract($this->block_values($blocks,$values));

		//set wp query
		$args = array(
			'order' => 'DESC',
			'showposts' => $count,
			'cat' => $cat,
			'offset' =>$offset,
			'meta_query' => array(
			    array(
			        'key' => "_".THEME_NAME.'_video_code',
			        'value'   => array(''),
			        'compare' => 'NOT IN'
			    )
			),
			'post_type'=> 'post',
			'ignore_sticky_posts' => true
		);

		//check for duplicate posts
		$args = $this->duplicate($args);


		$my_query = new WP_Query($args);
	

		//set block attributes
		$attr = array(
			'title' =>$title,
			'cat' => $cat,
			'offset' =>$offset,
			'columnID' =>$columnID,
			'color' =>$color,
			'link' => false,
		);


		//add all data in array
		$data = array($my_query, $attr);

		//set data
		$this->set_data($data);
		$block = "latest-video";
		get_template_part(THEME_HOME_BLOCKS.$block);
	}

	/* -------------------------------------------------------------------------*
	 * 							HOMEPAGE LATEST NEWS						*
	 * -------------------------------------------------------------------------*/
	 
	public function homepage_news_block_4($blocks,$columnID) {
		global $post;
		//set variable short names
		$values = array("title", "count", "color", "offset", "cat");

		//extract the block variables
		extract($this->block_values($blocks,$values));


		if($cat) {
			$link = get_category_link($cat);
		} else {
			$link = get_page_link(get_option('page_for_posts'));
		}

		//set wp query
		$args = array(
			'post_type' => "post",
			'cat' => $cat,
			'offset' =>$offset,
			'showposts' => $count,
			'ignore_sticky_posts' => "1"
		);

		//check for duplicate posts
		$args = $this->duplicate($args);

		$my_query = new WP_Query($args);
	

		//set block attributes
		$attr = array(
			'count' =>$count,
			'cat' => $cat,
			'offset' =>$offset,
			'link' =>$link,
			'columnID' =>$columnID,
			'color' =>$color,
			'title' =>$title
		);

		//add all data in array
		$data = array($my_query, $attr);

		//set data
		$this->set_data($data);

		$block = "latest-news-2";
		get_template_part(THEME_HOME_BLOCKS.$block);
	}

	/* -------------------------------------------------------------------------*
	 * 							HOMEPAGE LATEST NEWS						*
	 * -------------------------------------------------------------------------*/
	 
	public function homepage_news_block_5($blocks,$columnID) {
		global $post;
		//set variable short names
		$values = array("title", "count", "color", "offset", "cat");

		//extract the block variables
		extract($this->block_values($blocks,$values));


		if($cat) {
			$link = get_category_link($cat);
		} else {
			$link = get_page_link(get_option('page_for_posts'));
		}

		//set wp query
		$args = array(
			'post_type' => "post",
			'cat' => $cat,
			'offset' =>$offset,
			'showposts' => $count,
			'ignore_sticky_posts' => "1"
		);

		//check for duplicate posts
		$args = $this->duplicate($args);

		$my_query = new WP_Query($args);
	

		//set block attributes
		$attr = array(
			'count' =>$count,
			'cat' => $cat,
			'offset' =>$offset,
			'link' =>$link,
			'columnID' =>$columnID,
			'color' =>$color,
			'title' =>$title
		);

		//add all data in array
		$data = array($my_query, $attr);

		//set data
		$this->set_data($data);

		$block = "latest-news-3";
		get_template_part(THEME_HOME_BLOCKS.$block);
	}
	/* -------------------------------------------------------------------------*
	 * 							HOMEPAGE LATEST NEWS						*
	 * -------------------------------------------------------------------------*/
	 
	public function homepage_news_block_6($blocks,$columnID) {
		global $post;
		//set variable short names
		$values = array("title", "count", "color", "offset", "cat");

		//extract the block variables
		extract($this->block_values($blocks,$values));


		if($cat) {
			$link = get_category_link($cat);
		} else {
			$link = get_page_link(get_option('page_for_posts'));
		}

		//set wp query
		$args = array(
			'post_type' => "post",
			'cat' => $cat,
			'offset' =>$offset,
			'showposts' => $count,
			'ignore_sticky_posts' => "1"
		);

		//check for duplicate posts
		$args = $this->duplicate($args);

		$my_query = new WP_Query($args);
	

		//set block attributes
		$attr = array(
			'count' =>$count,
			'cat' => $cat,
			'offset' =>$offset,
			'link' =>$link,
			'columnID' =>$columnID,
			'color' =>$color,
			'title' =>$title
		);

		//add all data in array
		$data = array($my_query, $attr);

		//set data
		$this->set_data($data);

		$block = "latest-news-4";
		get_template_part(THEME_HOME_BLOCKS.$block);
	}

	/* -------------------------------------------------------------------------*
	 * 							POPULAR VIDEO BLOCK		 						*
	 * -------------------------------------------------------------------------*/
	 
	public function homepage_news_block_7($blocks,$columnID) {
		//set variable short names
		$values = array("title", "count", "color", "offset", "cat");

		//extract the block variables
		extract($this->block_values($blocks,$values));

		//set wp query
		$args = array(
			'order' => 'DESC',
			'showposts' => $count,
			'cat' => $cat,
			'offset' =>$offset,
			'orderby'	=> 'meta_value_num',
			'meta_key'	=> "_".THEME_NAME.'_post_views_count',
			'meta_query' => array(
			    array(
			        'key' => "_".THEME_NAME.'_video_code',
			        'value'   => array(''),
			        'compare' => 'NOT IN'
			    )
			),
			'post_type'=> 'post',
			'ignore_sticky_posts' => true
		);

		//check for duplicate posts
		$args = $this->duplicate($args);


		$my_query = new WP_Query($args);
	

		//set block attributes
		$attr = array(
			'title' =>$title,
			'cat' => $cat,
			'offset' =>$offset,
			'columnID' =>$columnID,
			'color' =>$color,
			'link' => false,
		);


		//add all data in array
		$data = array($my_query, $attr);

		//set data
		$this->set_data($data);
		$block = "latest-video";
		get_template_part(THEME_HOME_BLOCKS.$block);
	}


	/* -------------------------------------------------------------------------*
	 * 						HOMEPAGE POPULAR NEWS BLOCK	 					*
	 * -------------------------------------------------------------------------*/
	 
	public function homepage_news_block_8($blocks,$columnID) {
		//set variable short names
		$values = array("count", "offset", "cat");

		//extract the block variables
		extract($this->block_values($blocks,$values));

		//set wp query
		$args = array(
			'post_type' => "post",
			'cat' => $cat,
			'offset' =>$offset,
			'showposts' => $count,
			'orderby'	=> 'meta_value_num',
			'meta_key'	=> "_".THEME_NAME.'_post_views_count',
			'ignore_sticky_posts' => "1"
		);

		//check for duplicate posts
		$args = $this->duplicate($args);

		$my_query = new WP_Query($args);
	

		//set block attributes
		$attr = array(
			'cat' => $cat,
			'offset' =>$offset,
			'columnID' =>$columnID,
			'link' => false,
		);


		//add all data in array
		$data = array($my_query, $attr);

		//set data
		$this->set_data($data);
		$block = "featured";
		get_template_part(THEME_HOME_BLOCKS.$block);
	}

	/* -------------------------------------------------------------------------*
	 * 							HOMEPAGE SHOP BLOCK							*
	 * -------------------------------------------------------------------------*/
	 
	public function homepage_news_block_10($blocks,$columnID) {
		global $post;
		//set variable short names
		$values = array("title", "count", "cat", "offset", "type", "color");

		//extract the block variables
		extract($this->block_values($blocks,$values));


		if(!$offset) {
			$offset = "0";
		}

		if($cat && $type=="1") {
			$link = get_term_link(intval($cat), 'product_cat');
		} else if($type=="1" && !$cat) {
			if(ot_is_woocommerce_activated()==true) {
				$link = get_page_link(woocommerce_get_page_id('shop'));
			} else {
				$link = false;
			}
		} else {
				$link = false;
		}

		//set block attributes
		$attr = array(
			'title' =>$title,
			'count' =>$count,
			'cat' => $cat,
			'offset' =>$offset,
			'link' =>$link,
			'color' =>$color,
		);

		if($type=="1") {
			if($cat) {
				//set wp query
				$args = array(
					'post_type' => "product",
					'tax_query' => array(
						array(
							'taxonomy' => 'product_cat',
							'field' => 'id',
							'terms' => $cat
						)
					),
					'showposts' => $count,
					'ignore_sticky_posts' => "1",
					'offset' =>$offset
				);
			} else {
				//set wp query
				$args = array(
					'post_type' => "product",
					'showposts' => $count,
					'ignore_sticky_posts' => "1",
					'offset' =>$offset
				);
			}
		} else {
			if($cat) {
				//set wp query
				$args = array(
					'post_type' => "product",
					'showposts' => $count,
					'ignore_sticky_posts' => "1",
					'offset' =>$offset,
					'post_status '	=> 'publish',
					'meta_key'	=> '_featured',
					'meta_value'	=> 'yes',
					'tax_query' => array(
						array(
							'taxonomy' => 'product_cat',
							'field' => 'id',
							'terms' => $cat
						)
					),
				);
			} else {
				//set wp query
				$args = array(
					'post_type' => "product",
					'showposts' => $count,
					'ignore_sticky_posts' => "1",
					'offset' =>$offset,
					'post_status '	=> 'publish',
					'meta_key'	=> '_featured',
					'meta_value'	=> 'yes',
				);
			}
		}

		//check for duplicate posts
		$args = $this->duplicate($args);

		$my_query = new WP_Query($args);

		//add all data in array
		$data = array($my_query, $attr);

		//set data
		$this->set_data($data);
		$block = "shop";
		get_template_part(THEME_HOME_BLOCKS.$block);

	}

	/* -------------------------------------------------------------------------*
	 * 							HOMEPAGE LATEST REWVIEWS						*
	 * -------------------------------------------------------------------------*/
	 
	public function homepage_news_block_11($blocks,$columnID) {
		global $post;
		//set variable short names
		$values = array("title", "cat", "offset", "type", "count", "color");

		//extract the block variables
		extract($this->block_values($blocks,$values));


		if(!$offset) {
			$offset = "0";
		}


		//set block attributes
		$attr = array(
			'title' =>$title,
			'cat' => $cat,
			'offset' =>$offset,
			'color' =>$color,
			'count' =>$count,
		);

		if($type=="top") {
			//set wp query
			$args = array(
				'post_type' => "post",
				'cat' => $cat,
				'showposts' => $count,
				'ignore_sticky_posts' => "1",
				'order' => 'DESC',
				'orderby'	=> 'meta_value_num',
				'meta_key'	=> "_".THEME_NAME.'_ratings_average',
				'meta_query' => array(
				    array(
				        'key' => "_".THEME_NAME.'_ratings_average',
				        'value'   => '0',
				        'compare' => '>='
				    )
				),
				'offset' =>$offset
			);
		} else {
			//set wp query
			$args = array(
				'post_type' => "post",
				'cat' => $cat,
				'showposts' => $count,
				'order' => 'DESC',
				'ignore_sticky_posts' => "1",
				'meta_query' => array(
				    array(
				        'key' => "_".THEME_NAME.'_ratings_average',
				        'value'   => '0',
				        'compare' => '>='
				    )
				),
				'offset' =>$offset
			);	
		}

		//check for duplicate posts
		$args = $this->duplicate($args);

		$my_query = new WP_Query($args);

		//add all data in array
		$data = array($my_query, $attr);

		//set data
		$this->set_data($data);
		$block = "reviews";
		get_template_part(THEME_HOME_BLOCKS.$block);

	}

	/* -------------------------------------------------------------------------*
	 * 							HOMEPAGE HTML BLOCK								*
	 * -------------------------------------------------------------------------*/
	 
	public function homepage_html($blocks,$columnID) {
		//set variable short names
		$values = array("html");

		//extract the block variables
		extract($this->block_values($blocks,$values));

		
		//set block attributes
		$attr = array(
			'code' =>wpautop(stripslashes(do_shortcode($html))),
		);


		//add all data in array
		$data = array($attr);

		//set data
		$this->set_data($data);
		$block = "html";
		get_template_part(THEME_HOME_BLOCKS.$block);

	}
	/* -------------------------------------------------------------------------*
	 * 							HOMEPAGE TEXT BLOCK								*
	 * -------------------------------------------------------------------------*/
	 
	public function text_block($blocks,$columnID) {
		//set variable short names
		$values = array("text");

		//extract the block variables
		extract($this->block_values($blocks,$values));

		
		//set block attributes
		$attr = array(
			'code' =>wpautop(stripslashes(do_shortcode($text))),
		);


		//add all data in array
		$data = array($attr);

		//set data
		$this->set_data($data);
		$block = "html";
		get_template_part(THEME_HOME_BLOCKS.$block);

	}
	/* -------------------------------------------------------------------------*
	 * 							HOMEPAGE BANNER BLOCK							*
	 * -------------------------------------------------------------------------*/
	 
	public function homepage_banner($blocks,$columnID) {
		global $post;
		//set variable short names
		$values = array("banner");

		//extract the block variables
		extract($this->block_values($blocks,$values));

		
		//set block attributes
		$attr = array(
			'code' =>stripslashes(do_shortcode($banner))
		);

		//add all data in array
		$data = array($attr);

		//set data
		$this->set_data($data);
		$block = "banner";
		get_template_part(THEME_HOME_BLOCKS.$block);

	}
	/* -------------------------------------------------------------------------*
	 * 							HOMEPAGE COLUMNS							*
	 * -------------------------------------------------------------------------*/
	 
	public function columRows($columRows) {
		$dataArray = array($columRows);
		//set data
		$this->set_data($dataArray);

		get_template_part(THEME_HOME_BLOCK_ROWS.'row');
	}

	public static function set_double($data) {
		self::$duplicateArray[] = $data;
	}

	public static function get_double() {
		return self::$duplicateArray;
	}

    private function counter() {
        return ++self::$counter;
    }

	private static function set_data($data) {
		self::$data = $data;
	}

	public static function get_data() {
		return self::$data;
	}


} 
?>