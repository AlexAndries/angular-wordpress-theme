<?php
/**
 * API for home page template
 * Created by PhpStorm.
 * User: Alexandru
 * Date: 2/13/2016
 * Time: 12:49 PM
 * @todo Documentation for this API
 */
add_action('wp_ajax_home_template', 'home_template_api');
add_action('wp_ajax_nopriv_home_template', 'home_template_api');
function home_template_api(){
	global $TF;
	$data = array();
	$page = get_option('page_on_front');
	$head = new ApiHeadGenerate($page,true);
	$sliders = get_field('hero_slider', $page);
	if(!empty($sliders)){
		$info = array();
		foreach($sliders as $slider){
			if($slider['active_slider']){
				$currentSlider = array();
				if(!empty($slider['full_image'])){
					$currentSlider['fullImage'] = array(
						'url' => $slider['full_image']['url'],
						'width' => $slider['full_image']['width'],
						'height' => $slider['full_image']['height']
					);
				}
				if(!empty($slider['mobile_image'])){
					$currentSlider['mobileImage'] = array(
						'url' => $slider['mobile_image']['url'],
						'width' => $slider['mobile_image']['width'],
						'height' => $slider['mobile_image']['height']
					);
				}
				if(!empty($slider['thumbnail'])){
					$currentSlider['thumbnail'] = array(
						'url' => $slider['thumbnail']['url'],
						'width' => $slider['thumbnail']['width'],
						'height' => $slider['thumbnail']['height']
					);
				}
				if(!empty($currentSlider)){
					$info[] = $currentSlider;
				}
			}
		}
		$data['slider'] = $info;
	}
	$menu = get_field('menu_items', $page);
	if(!empty($menu)){
		$info = array();
		foreach($menu as $item){
			$currentMenu = array(
				'title' => $item->post_title,
				'image' => $TF->getFeaturedImage($item->ID)
			);
			$info[] = $currentMenu;
		}
		$data['menu'] = array(
			'title' => get_field('menu_title', $page) ? get_field('menu_title', $page) : false,
			'data' => $info
		);
	}
	$ourStory = get_field('our_story', $page);
	if($ourStory){
		$data['ourStory'] = $ourStory;
	}
	$instagramArg = array(
		'post_type' => 'instagram',
		'posts_per_page' => 10,
		'orderby' => 'date',
		'order' => 'desc'
	);
	$instagram = new WP_Query($instagramArg);
	if($instagram->have_posts()){
		$info = array();
		while($instagram->have_posts()){
			$instagram->the_post();
			$currentItem = array(
				'image' => get_field('image_url', get_the_ID()),
				'text' => get_field('instagram_text', get_the_ID())
			);
			$info[] = $currentItem;
		}
		wp_reset_postdata();
		$data['umamigrams'] = $info;
	}
	if(get_field('newsletter_title', $page)){
		$data['newsletter'] = array(
			'title' => get_field('newsletter_title', $page),
			'button' => get_field('newsletter_button_text', $page) ? get_field('newsletter_button_text', $page) : 'Submit'
		);
	}elseif(get_field('newsletter_button_text', $page)){
		$data['newsletter'] = array(
			'button' => get_field('newsletter_button_text', $page)
		);
	}
	$blogArg = array(
		'post_type' => 'blog',
		'posts_per_page' => 2,
		'orderby' => 'date',
		'order' => 'desc'
	);
	$blog = new WP_Query($blogArg);
	if($blog->have_posts()){
		$info = array();
		while($blog->have_posts()){
			global $post;
			$blog->the_post();
			$currentBlog = array(
				'title'=>$post->post_title,
				'description'=>get_field('short_description',$post->ID),
				'date'=>$post->post_date,
				'image'=>$TF->getFeaturedImage($post->ID),
				'postSlug'=>$post->post_name
			);
			$info[]=$currentBlog;
		}
		wp_reset_postdata();
		$data['blog']=array(
			'title'=>get_field('blog_title',$page),
			'data'=>$info
		);
	}
	$pressArg = array(
		'post_type' => 'press',
		'posts_per_page' => get_field('press_items_displayed',$page),
		'orderby' => 'date',
		'order' => 'desc'
	);
	$press = new WP_Query($pressArg);
	if($press->have_posts()){
		$info = array();
		while($press->have_posts()){
			global $post;
			$press->the_post();
			$currentPress = array(
				'title'=>$post->post_title,
				'description'=>get_field('article_excerpt',$post->ID),
				'date'=>get_field('article_date',$post->ID),
				'url'=>get_field('article_url',$post->ID),
				'source'=>get_field('article_source',$post->ID)
			);
			$info[]=$currentPress;
		}
		wp_reset_postdata();
		$data['news']=array(
			'title'=>get_field('press_title',$page),
			'data'=>$info
		);
	}
	/**
	 * Output information
	 */
	print_r(json_encode(array(
		'data' => $data,
		'head' => $head->getJSON()
	)));
	wp_die();
}