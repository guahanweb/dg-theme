<?php
function theme_guide(){
add_theme_page( 'Theme guide','Theme documentation','edit_themes', 'theme-documentation', 'w2f_theme_guide');
}
add_action('admin_menu', 'theme_guide');

function w2f_theme_guide(){
		echo '
		
<div id="welcome-panel" class="about-wrap">

	<div class="wpbadge" style="float:left; margin-right:30px; "><img src="'. get_template_directory_uri() . '/screenshot.jpg" width="250" height="200" /></div>

	<div class="welcome-panel-content">
	
	<h1>Welcome to '.wp_get_theme().' WordPress theme!</h1>
	
		<p class="about-text"> '.wp_get_theme().' is a free responsive premium WordPress theme from fabthemes.com. This theme is suitable for photography websites. The homepage has a fullscreen image slider. The theme comes with options page to configure the logo, slideshow etc </p>
		

		<div class="changelog ">
			
			<h3>Required plugins </h3>
			<p>The theme often requires few plugins to work the way it is originally intended to. You will find a notification on the admin panel prompting you to install the required plugins. Please install and activate the plugins.  </p>
			<ol>
				<li><a href="http://wordpress.org/extend/plugins/options-framework/">Options framework</a></li>
			</ol>
		</div>

		<div class="changelog ">
			<h3>Setting up the theme. </h3>
			<p> Upload the theme to your themes folder and install it. You can import the sample data xml file to prefill your website. Use the custom background feature to set a background image for your website.</p>
		
		
			<h3> Fullscreen slideshow template</h3>
			<p> Shuttershot theme features a fullscreen slideshow template. Please follow the steps below to add slide items to the slideshow.</p>
			<img src="http://jinsona.files.wordpress.com/2014/02/shuttrslide.png" alt="" />
			<p>Go to Admin panel > Add new slide > Give a title > Upload a slide image > Add an external link if required > Publish</p>
			<p> You have the option to set the fullscreen slideshow as your homepage. You can use the "Homepage" template for this. For this just <b>Create a new page > Give it a title > select "Homepage"</b> from the template dropdown list. </p>
			<p><img src="http://jinsona.files.wordpress.com/2014/07/shutter-home.jpg" alt="" /></p>
			
			<h3> Setting your Homepage and Blog page</h3>
			<p> To set your Homepage and Blog page we will make use of the "static page" option available on WordPress reading setting. You can find it on your <b>Admin panel > Settings > Reading > Static page.</b> </p>
			<img src="https://jinsona.files.wordpress.com/2014/07/shutter-static.png" alt="" />
			
		</div>

	
	
		<div class="changelog ">
		
			
		<h3> Theme options </h3>
		<p><b>Logo image</b> - Upload your logo image to replace the text logo on the theme. </p>
		<p><b>Number of slides </b> - Set number of slides on homepage. </p>
		<p><b>Slide delay</b> - Time delay of slideshow animation </p>
		<p><b>Slider effect</b> - Animation effect for slideshow </p>
				
		<h3> Banner settings </h3>
		<p> Customize your sidebar banners </p>
		
		</div>
	
	
	
				
		<div class="changelog ">
		' . file_get_contents(dirname(__FILE__) . '/FB/license-html.php') . '
		</div>
	
				


	</div>
	</div>
		
		';
		

}
