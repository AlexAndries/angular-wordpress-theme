<?php

/**
 * Created by Alex A.
 * Project: General
 * Date: 08/12/2015
 * Time: 10:46 AM
 */
class TwitterApi {
	public $method;
	public $oauth;
	public $url;
	public $oauth_access_token;
	public $oauth_access_token_secret;
	public $consumer_key;
	public $consumer_secret;
	public $header;
	public $count;
	public $screenName;

	public function __construct($oauth_access_token, $oauth_access_token_secret, $consumer_key, $consumer_secret,$screenName, $count = 1, $method = "GET") {
		$this->url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
		$this->oauth_access_token = $oauth_access_token;
		$this->oauth_access_token_secret = $oauth_access_token_secret;
		$this->consumer_key = $consumer_key;
		$this->consumer_secret = $consumer_secret;
		$this->method = $method;
		$this->count = $count;
		$this->screenName = $screenName;
		$this->oauth = array('count' => $this->count,
			'oauth_consumer_key' => $this->consumer_key,
			'oauth_nonce' => time(),
			'oauth_signature_method' => 'HMAC-SHA1',
			'oauth_token' => $this->oauth_access_token,
			'oauth_timestamp' => time(),
			'oauth_version' => '1.0');
		$this->baseInfo();
	}

	public function buildBaseString() {
		$r = array();
		ksort($this->oauth);
		foreach ($this->oauth as $key => $value) {
			$r[] = "$key=" . rawurlencode($value);
		}
		return $this->method . "&" . rawurlencode($this->url) . '&' . rawurlencode(implode('&', $r));
	}

	public function buildAuthorizationHeader() {
		$r = 'Authorization: OAuth ';
		$values = array();
		foreach ($this->oauth as $key => $value) $values[] = "$key=\"" . rawurlencode($value) . "\"";
		$r .= implode(', ', $values);
		return $r;
	}

	public function baseInfo() {
		$base_info = $this->buildBaseString();
		$composite_key = rawurlencode($this->consumer_secret) . '&' . rawurlencode($this->oauth_access_token_secret);
		$oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
		$this->oauth['oauth_signature'] = $oauth_signature;
		$this->header = array($this->buildAuthorizationHeader(),
			'Expect:');
	}

	public function getData($debug = false) {
		$options = array(CURLOPT_HTTPHEADER => $this->header,
			CURLOPT_HEADER => false,
			CURLOPT_URL => $this->url . '?count=' . $this->count,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false);

		$feed = curl_init();
		curl_setopt_array($feed, $options);
		$json = curl_exec($feed);
		curl_close($feed);
		if ($debug) {
			return json_decode($json);
		}
		return $this->generateContent(json_decode($json));
	}

	public function generateHashTag($string, $hashTag = array()) {
		if (!empty($hashTag)) {
			foreach ($hashTag as $tag) {
				$string = str_replace('#' . $tag->text, $this->createHashTag($tag->text), $string);
			}
		}
		return $string;
	}

	public function createHashTag($hashTag) {
		return '<a href="https://twitter.com/hashtag/' . $hashTag . '?src=hash" title="#' . $hashTag . '" target="_blank" rel="nofollow">#' . $hashTag . '</a>';
	}

	public function generateUserMentions($string, $users = array()) {
		if (!empty($users)) {
			foreach ($users as $user) {
				$string = str_replace('@' . $user->screen_name, $this->createUserMentions($user), $string);
			}
		}
		return $string;
	}

	public function createUserMentions($user) {
		return '<a href="https://twitter.com/' . $user->screen_name . '" title="@' . $user->screen_name . '" target="_blank" rel="nofollow">@' . $user->screen_name . '</a>';
	}

	public function generateUrls($string, $urls = array()){
		if (!empty($urls)) {
			foreach ($urls as $url) {
				$string = str_replace($url->url, $this->createUrls($url), $string);
			}
		}
		return $string;
	}
	public function createUrls($urls) {
		return '<a class="twitter-url" href="' . $urls->expanded_url . '" target="_blank" rel="nofollow">' . $urls->url . '</a>';
	}
	public function generateTwitter($string, $entities) {
		$string = $this->generateHashTag($string, $entities->hashtags);
		$string = $this->generateUserMentions($string, $entities->user_mentions);
		$string = $this->generateUrls($string,$entities->urls);
		return $string;
	}

	public function generateDateInfo($date, $user) {
		$date = new DateTime($date);

		$string = '<a href="https://twitter.com/' . $user . '" title="@' . $user . '" target="_blank" rel="nofollow">@' . $user . '</a> <span>' . date_format($date, 'M j') . '</span>';
		return $string;
	}

	public function generateContent($json) {
		$string = '';
		if (!empty($json) && empty($json->errors)) {
			foreach ($json as $tweet) {
				$string = '
					<li>
						<p class="tweet-info">' . $this->generateDateInfo($tweet->created_at, $tweet->user->screen_name) . '</p>
						<p class="tweet-content">' . $this->generateTwitter($tweet->text, $tweet->entities) . '</p>
					</li>'.$string;
			}
		}
		return '<ul class="list-unstyled owl-carousel">'. $string . '</ul>';
	}
	public function getFollowButton(){
		return '<a class="btn btn-twitter" href="https://twitter.com/intent/follow?screen_name=' . $this->screenName . '" title="Follow Us" target="_blank" rel="nofollow"><i class="fa fa-twitter"></i> Follow Us</a>';
	}
}
/**
 * Get tweets
 */
/*require_once("includes/twitter-api/twitter-api.php");
$oauth_access_token = get_field('oauth_access_token', 'options');
$oauth_access_token_secret = get_field('oauth_access_token_secret', 'options');
$consumer_key = get_field('consumer_key', 'options');
$consumer_secret = get_field('consumer_secret', 'options');
$screenName = get_field('screen_name', 'options');
$tweetCount = get_field('tweets_count', 'options') ? get_field('tweets_count', 'options') : 1;
$twitter = new TwitterApi($oauth_access_token, $oauth_access_token_secret, $consumer_key, $consumer_secret, $screenName, $tweetCount);*/