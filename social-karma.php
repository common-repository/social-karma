<?php
/*
Plugin Name: Social Karma
Plugin URI: http://mark.bloomfield.co.za/?p=364
Description: A winning shortcode to easily link to the social profiles/networks of people that you're writing about.
Version: 1.0
Author: Mark Bloomfield
Author URI: http://mark.bloomfield.co.za
License: GPL2


/*  Copyright 2011  Mark Bloomfield  (email : mark@bloomfield.co.za)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


/* the magic */

	function social($atts, $content = null) {  
		extract(shortcode_atts(array(  
			'blog' => '',  
			'facebook' => '',  
			'twitter' => '',  
			'flickr' => '',  
			'linkedin' => '',  
			'lastfm' => '',  
			'aboutme' => '',  
			'youtube' => '',  
			'vimeo' => '',  
			'delicious' => '',  
			'digg' => '',  
			'posterous' => '',  
			'tumblr' => '',  
			'dribbble' => '',  
		), $atts));
			
		$social_karma_line .= $atts['blog'] != ''  ? '<a href="'.$atts['blog'].'" class="social_blog" target="_blank">Blog</a>&nbsp' : '';	
		$social_karma_line .= $atts['facebook'] != ''  ? '<a href="http://facebook.com/'.$atts['facebook'].'" class="social_facebook" target="_blank">Facebook</a>&nbsp' : '';	
		$social_karma_line .= $atts['twitter'] != ''  ? '<a href="http://twitter.com/'.$atts['twitter'].'" class="social_twitter" target="_blank">Twitter</a>&nbsp' : '';	
		$social_karma_line .= $atts['flickr'] != ''  ? '<a href="http://flickr.com/'.$atts['flickr'].'" class="social_flickr" target="_blank">Flickr</a>&nbsp' : '';	
		$social_karma_line .= $atts['lastfm'] != ''  ? '<a href="http://www.linkedin.com/in/'.$atts['linkedin'].'" class="social_linkedin" target="_blank">LinkedIn</a>&nbsp' : '';	
		$social_karma_line .= $atts['aboutme'] != ''  ? '<a href="http://last.fm/user/'.$atts['lastfm'].'" class="social_lastfm" target="_blank">Last.fm</a>&nbsp' : '';	
		$social_karma_line .= $atts['youtube'] != ''  ? '<a href="http://about.me/'.$atts['aboutme'].'" class="social_aboutme" target="_blank">About.Me</a>&nbsp' : '';	
		$social_karma_line .= $atts['vimeo'] != ''  ? '<a href="http://www.youtube.com/user/'.$atts['youtube'].'" class="social_youtube" target="_blank">YouTube</a>&nbsp' : '';	
		$social_karma_line .= $atts['delicious'] != ''  ? '<a href="http://vimeo.com/'.$atts['vimeo'].'" class="social_vimeo" target="_blank">Vimeo</a>&nbsp' : '';	
		$social_karma_line .= $atts['digg'] != ''  ? '<a href="http://digg.com/'.$atts['digg'].'" class="social_digg" target="_blank">Digg</a>&nbsp' : '';	
		$social_karma_line .= $atts['posterous'] != ''  ? '<a href="http://'.$atts['posterous'].'.posterous.com/" class="social_posterous" target="_blank">Posterous</a>&nbsp' : '';	
		$social_karma_line .= $atts['tumblr'] != ''  ? '<a href="http://'.$atts['tumblr'].'.tumblr.com/" class="social_tumblr" target="_blank">Tumblr</a>&nbsp' : '';	
		$social_karma_line .= $atts['dribbble'] != ''  ? '<a href="http://dribbble.com/'.$atts['dribbble'].'" class="social_dribbble" target="_blank">Dribbble</a>&nbsp' : '';	
			
		return $content . '&nbsp;<span class="social_karma_links"><span class="social_karma_links_bracket1">'.get_option('social_bracket_1').'&nbsp;</span>' . $social_karma_line . '<span class="social_karma_links_bracket2">'.get_option('social_bracket_2').'</span></span> ';
	
	}  
	add_shortcode('social', 'social');

/* add the plugin styling to the header */

	function social_karma_styling() { echo "<link rel='stylesheet' type='text/css' href='".get_bloginfo('url')."/wp-content/plugins/social-karma/social-karma.css' />\n"; }
	add_action('wp_head', 'social_karma_styling');

/* add the admin panel */

	register_setting('social_karma_settings','social_bracket_1');
	register_setting('social_karma_settings','social_bracket_2');

	function social_karma_menu() { add_submenu_page("options-general.php", "Social Karma Settings", "Social Karma", 8, "social-karma", "social_karma_admin"); }
	
	function social_karma_admin() { ?>		
		
		<div class="wrap">
			<form method="post" action="options.php" enctype="multipart/form-data" id="social_karma_form">
			<?php settings_fields('social_karma_settings'); ?>
				<h2>Social Karma Settings</h2>
				<p>Very basic settings for now. If you'd like to suggest some more settings / options for this plugin, please add your comment <a href="http://mark.bloomfield.co.za/?p=364" target="_blank">here</a>: </p>
				<ul>
					<li><label for="social_bracket_1">What do you want to display <strong>before</strong> the icons (usually a bracket of some kind)</label>&nbsp;&nbsp;&nbsp;
					<input id="social_bracket_1" maxlength="5" size="10" name="social_bracket_1" value="<?php echo get_option('social_bracket_1'); ?>" /></li>   
				
					<li><label for="social_bracket_2">What do you want to display <strong>after</strong> the icons (usually a bracket of some kind)</label>&nbsp;&nbsp;&nbsp;
					<input id="social_bracket_2" maxlength="5" size="10" name="social_bracket_2" value="<?php echo get_option('social_bracket_2'); ?>" /></li>
					
					<li><input class='button-primary' type='submit' name='Save' value='<?php _e('Save Options'); ?>' id='submitbutton' /></li>
				</ul>			
			</form>
			
			<h2>How to use the plugin</h2>
			<p>Lets say you want to send some social karma to Mark Bloomfield (me) when you mention him in your blog post. You know his Twitter username is <a href="http://twitter.com/yellowllama">yellowllama</a> and he's on Flickr at <a href="http://www.flickr.com/the-yellow-llama">the-yellow-llama</a>. You'd insert the following shortcode:</p>
			<p><code>[social twitter=yellowllama flickr=the-yellow-llama]Mark Bloomfield[/social]</code></p>
			<p>That will display 'Mark Bloomfield' and then the two, correctly linked, 16x16 icons to his Twitter and Flickr pages.</p>
			<p>Supported shortcode options are:</p>
			<ul><li>
				<ul>
					<li>blog=</li>
					<li>facebook=</li>
					<li>twitter=</li>
					<li>flickr=</li>
					<li>linkedIn=</li>
					<li>lastfm=</li>
					<li>aboutme=</li>
					<li>youtube=</li>
					<li>vimeo=</li>
					<li>delicious=</li>
					<li>digg=</li>
					<li>posterous=</li>
					<li>tumblr=</li>
					<li>dribbble=</li>
				</ul>
			</li></ul>
			<p><strong>Note that only the 'blog' option must be the FULL URL TO THE SITE. All other items are username only.</strong></p>
			<p>Let me know what you think of this plugin <a href="http://mark.bloomfield.co.za/?p=364">here</a>.</p>
		</div>

	<?php  };

	add_action("admin_menu", "social_karma_menu");
	
?>