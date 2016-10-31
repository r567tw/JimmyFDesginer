<?php get_header(); ?>
<div class="row">
	<div class="col-md-8">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article>
					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<div>
						<span class="glyphicon glyphicon-time"><?php the_time('Y-m-d');?></span>&nbsp
					<span class="glyphicon glyphicon-user"></span>
					<span><?php the_author(); ?></span>
					</div>
					<?php  the_excerpt(); ?>
					<div class="clearfix"></div>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<article>
				<h1>搜尋結果</h1>
				<p>很抱歉，找不到你所搜尋的文章，你可以試著用其他關鍵字再次搜尋。</p>
				<?php get_search_form(); ?>
			</article>
			<iframe src="http://404page.missingkids.org.tw/api?key=aZSrsUTv43m79VshB3zE" width="100%" height="635" frameborder="0"></iframe>
		<?php endif; ?>
	</div>
	<div class="col-md-4 hidden-xs hidden-sm hidden-print">
	<?php get_sidebar(); ?>
	</div>
</div>
<?php wp_pagenavi(); ?>
<?php get_footer(); ?>