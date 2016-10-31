<?php get_header(); ?>
<?php breadcrumb_init(); ?>
<div class="row">
	<div class="col-md-8">
	<div class="panel-group">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="panel panel-default">
				<div class="panel-body">
					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<span class="label label-default"><span class="glyphicon glyphicon-time">&nbsp<?php the_time('Y-m-d');?></span></span>&nbsp
					<span class="label label-default"><span class="glyphicon glyphicon-user"></span>&nbsp<span><?php the_author(); ?></span></span>&nbsp
				</div>
				<div class="panel-body">	
					<?php the_excerpt(); ?>
				</div>
			</div>
		<?php endwhile; ?>
	</div>
	</div>
	<div class="col-md-4 hidden-xs hidden-sm hidden-print">
	<?php get_sidebar(); ?>
	</div>
</div>
<?php wp_pagenavi(); ?>
<?php get_footer(); ?>

<!--彙整-->
