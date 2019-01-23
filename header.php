<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset');?>" />
		<title><?php
				if (is_home()) {
					bloginfo('name');
				} else {
					wp_title(' - ', true, 'right');
					bloginfo('name');
				} ?></title>
		<?php wp_head(); ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<link rel="shortcut icon" href="<?php bloginfo('template_directory')?>/img/favicon.ico" type="image/x-icon" />		
		<link href="<?php bloginfo('template_directory') ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php bloginfo('template_directory') ?>/style.css" media="screen" rel="stylesheet" type="text/css" />
	</head>
	<body>
	<header class="hidden-print">
		<div class="jumbotron">
		<div class="container">
			<div class="col-md-4">
				<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
				<ins><?php bloginfo('description'); ?></ins>
			</div>
		</div>
		</div>

		<nav class="navbar navbar-default nav"  data-spy="affix" data-offset-top="192">
	  				<div class="container">
	  				<a class="navbar-brand visible-xs visible-sm" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
	    				<div class="navbar-header">
	      					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span> 
						    </button>
	    				</div>

		    			<div class="collapse navbar-collapse" id="myNavbar">
		     				<?php
					           wp_nav_menu( array(
								    'theme-location'=> 'primary-menu',
								    'menu_class' => 'nav navbar-nav'
								    )
								);
					           date_default_timezone_set("Asia/Taipei");
					           $history=wp_history_post(date("Y"), date("m"), date("d"));
							if (!empty($history)){
							$modal=true;								
				        	?>
				        	<div class="nav navbar-right  hidden-xs"><button type="button" class="btn btn-success history" data-toggle="modal" data-target="#myModal">歷史的這一天</button></div>
				        	
				        	<ul class="nav navbar-nav visible-xs"><li><a data-toggle="modal" data-target="#myModal">歷史的這一天</a></li></ul>
				        	<?php } ?>
	  					</div>
	  				</div>
		</nav>
			
	</header>
			<div id="gotop">^</div>

			<?php if (!empty($history)){	?>
				<!-- Modal -->
				<div id="myModal" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">本站歷史的這一天....也寫過了....</h4>
				      </div>
				      <div class="modal-body">
				        <?php
				        $history= str_replace("<label>過去的一樣時間也寫過...</label>", "", $history);
				        echo $history; 
				        ?>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
				      </div>
				    </div>
				  </div>
				</div>
				<?php }?>
	<div class="container">
	<?php //echo date("Y")."/".date("m")."/".date("d"); ?>

