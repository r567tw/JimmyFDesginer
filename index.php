<?php get_header(); ?>
<div class="row">
	<div class="col-md-8">
	<div class="panel-group">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="panel panel-default">
				<div class="panel panel-heading">
					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				</div>
				<div class="panel-body">
					<span class="label label-default"><span class="glyphicon glyphicon-time"><?php the_time('Y-m-d');?></span></span>
					<!--<span class="label label-default"><span class="glyphicon glyphicon-user"></span>&nbsp<span><?php the_author(); ?></span></span>&nbsp-->
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