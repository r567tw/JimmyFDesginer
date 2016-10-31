<?php get_header(); ?>
<?php breadcrumb_init(); ?>
<div class="row">
	<div class="col-md-8">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="panel panel-primary">
				<div class="panel panel-heading"><h1><?php the_title(); ?></h1></div>
				<div class="panel panel-body">
				<?php the_content(); ?>
				</div>
				<div class="clearfix"></div>
			</div>
		<?php endwhile; ?>
	</div>
	<div class="col-md-4 hidden-xs hidden-sm hidden-print">
	<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>