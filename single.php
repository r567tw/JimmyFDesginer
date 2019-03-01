<?php get_header(); ?>
<?php breadcrumb_init(); ?>
<div class="row">
	<div class="col-md-8">
		
		<?php while ( have_posts() ) : the_post(); ?>
		<!--判斷是不是有特色圖片，有則顯示無則不動作-->
		<?php if (has_post_thumbnail()){?>
			<img class="img-responsive" src="<?php bloginfo('template_url')?>/timthumb.php?src=<?php echo get_feature_image()?>&w=500&h=125&zc=1"/>
		<?php }; ?>
			<div class="panel panel-default">
				<div class="panel panel-heading">
					<h1><?php the_title(); ?></h1>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
						<p>
							<span class="label label-default hidden-print"><span class="fa fa-clock-o"> <?php the_time('Y-m-d');?></span></span>
							<!--<span class="label label-default hidden-print"><span class="glyphicon glyphicon-user"></span><span><?php the_author(); ?></span></span>-->
						</p>
						</div>
					</div>
					<?php the_content(); ?>
				</div>
				<div class="panel-footer hidden-print">
					<?php the_tags('<label>標籤:</lavel> &nbsp','&nbsp&nbsp&nbsp','');?>
				</div>
			</div>
			<!--存放相關文章-->
			<div class="panel hidden-print">
				<?php get_similar_post($post->ID); ?>
			</div>

			<?php 
				$history=wp_history_post(get_the_time('Y'), get_the_time('m'), get_the_time('j'));
				if (!empty($history))
				{
			?>

			<div class="panel panel-success hidden-print">
				<div class="panel-body">
					<?=$history; ?>
				</div>
			</div>
			<?php }?>
			
			<?php article_author(); ?>			

			<div class="col-md-12 hidden-print">
				<?php comments_template(); ?>
			</div>
		<?php endwhile; ?>
	</div>
	<div class="col-md-4 hidden-xs hidden-sm hidden-print">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>