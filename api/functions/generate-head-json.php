<?php

/**
 * Created by PhpStorm.
 * User: Alexandru
 * Date: 2/13/2016
 * Time: 4:39 PM
 */
class ApiHeadGenerate {
	/**
	 * @var
	 */
	private $postID;
	/**
	 * @var bool
	 */
	private $frontPage;
	/**
	 * @var array
	 */
	private $output = array();

	public function __construct($postID,$frontPage=false){
		$this->postID = $postID;
		$this->frontPage = $frontPage;
	}

	public function getJSON(){
		$this->generateTitle()
			->generateDescription()
			->generateMetaKeywords()
			->generateFocusKeywords()
			->generateMetaRobotsIndex()
			->generateMetaRobotsFollow()
			->generateMetaRobotsAdvanced()
			->generateCanonicalURL()
			->generateFacebookMeta()
			->generateTwitterMeta()
			->generateGoogleMeta();
		/**
		 * @todo Generate full graph SEO
		 */
		return $this->output;
	}

	private function generateTitle(){
		$this->output['title'] = get_field('seo_title',$this->postID)?get_field('seo_title',$this->postID):($this->frontPage?get_bloginfo('name'):get_the_title($this->postID));
		return $this;
	}

	private function generateFocusKeywords(){
		if(get_field('focus_keywords',$this->postID)){
			$this->output['focus_keywords'] = get_field('focus_keywords',$this->postID);
		}
		return $this;
	}

	private function generateDescription(){
		if(get_field('meta_description',$this->postID)){
			$this->output['meta_description'] = get_field('meta_description',$this->postID);
		}
		return $this;
	}

	private function generateMetaKeywords(){
		if(get_field('meta_keywords',$this->postID)){
			$this->output['meta_keywords'] = get_field('meta_keywords',$this->postID);
		}
		return $this;
	}

	private function generateMetaRobotsIndex(){
		if(get_field('meta_robots_index',$this->postID)){
			$this->output['meta_robots_index'] = get_field('meta_robots_index',$this->postID);
		}
		return $this;
	}

	private function generateMetaRobotsFollow(){
		if(get_field('meta_robots_follow',$this->postID)){
			$this->output['meta_robots_follow'] = get_field('meta_robots_follow',$this->postID);
		}
		return $this;
	}

	private function generateMetaRobotsAdvanced(){
		if(get_field('meta_robots_advanced',$this->postID)){
			$this->output['meta_robots_advanced'] = array();
			foreach(get_field('meta_robots_advanced',$this->postID) as $item){
				$this->output['meta_robots_advanced'][]=$item;
			}
		}
		return $this;
	}

	private function generateCanonicalURL(){
		$this->output['canonical_url'] = get_field('canonical_url',$this->postID)?get_field('canonical_url',$this->postID):get_the_permalink($this->postID);
		return $this;
	}

	private function generateFacebookMeta(){
		$this->output['facebook']=array(
			'title'=> get_field('facebook_title',$this->postID)?get_field('facebook_title',$this->postID):$this->output['title'],
			'descriptions'=>get_field('facebook_description',$this->postID)?get_field('facebook_description',$this->postID):($this->output['meta_description']?$this->output['meta_description']:''),
			'image'=>get_field('facebook_image',$this->postID)
		);
		return $this;
	}

	private function generateTwitterMeta(){
		$this->output['twitter']=array(
			'title'=> get_field('twitter_title',$this->postID)?get_field('twitter_title',$this->postID):$this->output['title'],
			'descriptions'=>get_field('twitter_description',$this->postID)?get_field('twitter_description',$this->postID):($this->output['meta_description']?$this->output['meta_description']:''),
			'image'=>get_field('twitter_image',$this->postID)
		);
		return $this;
	}

	private function generateGoogleMeta(){
		$this->output['google']=array(
			'title'=> get_field('google+_title',$this->postID)?get_field('google+_title',$this->postID):$this->output['title'],
			'descriptions'=>get_field('google+_description',$this->postID)?get_field('google+_description',$this->postID):($this->output['meta_description']?$this->output['meta_description']:''),
			'image'=>get_field('google+_image',$this->postID)
		);
		return $this;
	}
}