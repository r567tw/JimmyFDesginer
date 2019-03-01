</div>	
<footer class="footer">
		<p>&nbsp</p>
		<?php
			wp_nav_menu( array('menu'=> 'footer1','menu_class' => 'list-inline hidden-print','before'=>'[','after'=>']'));
		?>
		<div class="copyright">Copyright © 2016 <?php bloginfo("name"); ?></div>
</footer>
<?php wp_footer(); ?>
</body>
	<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/all.js"></script>
</html>