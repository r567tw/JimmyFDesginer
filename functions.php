<?php 

register_nav_menus(
	array(
		'primary-menu' => __('主選單'),
		'footer-menu'=>__('頁尾選單','THEMENAME')
	)
);

function wp_pagenavi() {
	global $wp_query;
	$max = $wp_query->max_num_pages;
	if ( !$current = get_query_var('paged') ) $current = 1;
	$args['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
	$args['total'] = $max;
	$args['current'] = $current;
	$args['prev_text'] = '<';
	$args['next_text'] = '>';
	if ( $max > 1 ){ $pages = '<div class="wp-pagenavi">';
		echo $pages . paginate_links($args) . '</div>';}
}

if ( function_exists('register_sidebar') ){
	register_sidebar(array(
		'name' => '側邊欄',
		'id' => 'sidebar',
		'description' => '顯示於每個網頁的右方。',
		'before_widget' => '<section id="%1$s" class="well">',
		'after_widget' => '</section>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}


function displaycomments($comment, $args, $depth){
	$GLOBALS['comment'] = $comment;
?>
<li class="comment-list-box">
	<div class="comment-author">
		<?php echo get_avatar( $comment, 40 ); ?>
	</div>
	<div class="comment-fn">
		<?php printf(__('<span class="fn">%s</span>'), get_comment_author_link()) ?>
	</div>
	<div class="comment-meta">
		<?php printf(__('%1$s @ %2$s'), get_comment_date(),  get_comment_time()) ?> <?php edit_comment_link() ?>
	</div>
	<?php if ($comment->comment_approved == '0') : ?>
		<em class="comment-approved">你的留言正在審核中。若有問題請聯絡<a href="mailto:r567tw@gmail.com">站長</a></em>
	<?php endif;?>
	<?php comment_text() ?>
	<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
<?php }


function breadcrumb_init(){
	global $post;
?>
	<ul class="breadcrumb hidden-print">
		<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
			<a href="<?php bloginfo('url');?>" itemprop="url" title="<?php bloginfo('name');?>">
			<span itemprop="title"><?php bloginfo('name');?></span></a> 
		</li>
		<?php
		if( is_single() ) {
			foreach ( get_the_category() as $category) {
				echo '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
				echo '<span class="divider"></span><a href="' . get_category_link($category -> term_id) . '" itemprop="url" title=' . $category -> cat_name . '><span itemprop="title">' . $category -> cat_name . '</span></a>';
				echo '</li>';
			}
		} else { ?>
		<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="active">
			<span itemprop="title">
			<?php
			if ( is_category() ) {
				echo single_cat_title();
			} elseif ( is_tag() ) {
				echo single_tag_title( '', true);
			} elseif ( is_day() ) {
				the_time( get_option('date_format') );
			} elseif ( is_month() ) {
				the_time( 'F, Y' );
			} elseif ( is_year() ) {
				the_time( 'Y' );
			} elseif ( is_page() ) {
				the_title();
			} ?></span>
		</li>
		<?php } ?>
	</ul>
<?php
}

function add_user_porfile( $contactmethods ) {
	$contactmethods['google'] = 'Google+ 個人網址';
	$contactmethods['facebook'] = 'Facebook 個人網址';
	$contactmethods['description_url'] = '個人介紹頁';
	$contactmethods['github']='Github';
	return $contactmethods;
}
add_filter('user_contactmethods','add_user_porfile',10,1);


function article_author(){
	global $post;
?>
	<section class="col-sm-12 well">
		<div class="col-sm-2 avatar hidden-xs hidden-sm hidden-print">
		<?php echo get_avatar( get_the_author_meta('ID'), 100);?>
		</div>
		<div class="col-sm-10">
			<h3><?php the_author();?></h3>	
			<p><?php the_author_meta('description');?></p>
		</div>
		<div class="row text-right hidden-sm hidden-xs hidden-print">
				<?php if ( get_the_author_meta( 'google' ) ): ?>
					<a href="<?php the_author_meta('google');?>?rel=author" title="我的 Google+">Google+</a>
				<?php endif; if ( get_the_author_meta( 'facebook' ) ): ?>
					 | <a href="<?php the_author_meta('facebook');?>" title="我的 Facebook">Facebook</a>
				<?php endif; if ( get_the_author_meta( 'github' ) ): ?>
					 | <a href="<?php the_author_meta('github');?>" title="<?php the_author();?> Github">Github</a>
				<?php endif; if ( get_the_author_meta( 'description_url' ) ): ?>
					 | <a href="<?php the_author_meta('description_url');?>" title="<?php the_author();?> 個人介紹">個人介紹</a>
				<?php endif;?>
		</div>				
	</section>
<?php
}

if ( function_exists( 'add_theme_support'  ) ) {
    add_theme_support( 'post-thumbnails' );
}

function get_feature_image(){
	global $post, $posts;
	$first_img = '';
	if (has_post_thumbnail()){
		$first_img  = wp_get_attachment_url( get_post_thumbnail_id() );
	} else {
		ob_start();
		ob_end_clean();
		$output = preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $post->post_content, $matches);
		$first_img = $matches[1];
	}
	return $first_img;
}

function insert_fb_in_head() {
	global $post;
	if ( is_home() ) {
		//echo '<meta property="fb:admins" content="管理員的 Facebook 帳號 ID" />';
		echo "\n";
        //echo '<meta property="fb:app_id" content="網站 Facebook APP 的 ID" />';
		echo "\n";
        echo '<meta property="og:type" content="website"/>';
		echo "\n";
        echo '<meta property="og:title" content="' . get_bloginfo('name') . '"/>';
		echo "\n";
        echo '<meta property="og:description" content="' . get_bloginfo('description'). '"/>';
		echo "\n";
        echo '<meta property="og:url" content="' . get_bloginfo('url'). '"/>';
		echo "\n";
        echo '<meta property="og:site_name" content="'. get_bloginfo('name'). '"/>';
		echo "\n";
		echo '<meta property="og:locale" content="zh_tw">';
		echo "\n";
	}
	if ( !is_singular() ) return;
	$post_excerpt =  ( $post->post_excerpt ) ? $post->post_excerpt : trim( str_replace( "\r\n", ' ', strip_tags( $post->post_content ) ) );
	$description = mb_substr( $post_excerpt, 0, 160, 'UTF-8' );
	$description .= ( mb_strlen( $post_excerpt, 'UTF-8' ) > 160 ) ? '…' : '';
        echo "\n";
		//echo '<meta property="fb:admins" content="管理員的 Facebook 帳號 ID" />';
		echo "\n";
       // echo '<meta property="fb:app_id" content="網站 Facebook APP 的 ID" />';
		echo "\n";
        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
		echo "\n";
        echo '<meta property="og:description" content="' . $description . '"/>';
		echo "\n";
        echo '<meta property="og:type" content="article"/>';
		echo "\n";
        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
		echo "\n";
        echo '<meta property="og:site_name" content="' . get_bloginfo('name'). '"/>';
		echo "\n";
		echo '<meta property="og:image" content="'.$img.'" />' ;
		echo "\n";
		echo '<link rel="image_src" type="image/jpeg" href="'.get_feature_image().'" />' ;
		echo "\n";
		echo '<meta property="og:locale" content="zh_tw">';
		echo "\n";
}
add_action( 'wp_head', 'insert_fb_in_head', 10 );


//移除不必要的meta
remove_action( 'wp_head', 'wp_generator' ) ; 
remove_action( 'wp_head', 'wlwmanifest_link' ) ; 
remove_action( 'wp_head', 'rsd_link' ) ;

//停用文章html功能
add_filter( 'pre_comment_content', 'wp_specialchars' );

//隱藏其他 WordPress Feeds 網址
remove_action( 'wp_head', 'feed_links', 2 ); 
remove_action( 'wp_head', 'feed_links_extra', 3 );

//隱藏wordpress登入錯誤消息
function no_errors_please(){
 return '登入錯誤';
}
add_filter( 'login_errors', 'no_errors_please' );


//停止 WordPress 猜測網址功能
add_filter('redirect_canonical', 'stop_guessing');
function stop_guessing($url) {
 if (is_404()) {
 return false;
 }
 return $url;
}


//顯示摘要文
function my_excerpt_length($length) {
return 200;
}

add_filter('excerpt_length', 'my_excerpt_length');

//摘要文[...]改造成繼續閱讀
function new_excerpt_more($more) {
global $post;
return '… <a href="'. get_permalink($post->ID) . '">繼續閱讀</a>';
}

add_filter('excerpt_more', 'new_excerpt_more');

//增加相關文章功能
	function get_similar_post($post_id){
	   $tags = wp_get_post_tags($post_id);
	   if ($tags) {
	      $first_tag = $tags[0]->term_id;
	      $args = array(
	        'tag__in' => array($first_tag),
	        'post__not_in' => array($post_id),
	        'showposts'=>4,
	        'caller_get_posts'=>1
	        );   
	        $my_query = new WP_Query($args);
	        if( $my_query->have_posts() ) : ?>
	        <label>以下文章歡迎您看看：</label>
	        <div class="row">
	        <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
	        	<?php $img=rand(1,100);
	        	$img=$img%5+1;  //relationship資料夾總照片數
	        	 ?>
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        	<a href="<?php the_permalink(); ?>" rel="nofollow"  rel="bookmark" title="閱讀：<?php the_title_attribute(); ?>">
	        	<img class="img-thumbnail img-responsive hidden-xs" src="<?php bloginfo('template_directory') ?>/imgages/relationship/<?=$img?>.jpg" width="100" height="100" alt="relationship"/><br/>
	           <?php the_title(); ?> </a>
	            </div>
	        <?php endwhile;?>
	        </div>
	        <?php  endif; ?>
	        
	        <?php wp_reset_query();
	        }
    }

	/* 歷史上的今天開始（改寫） */
	function wp_history_post_base($post_year, $post_month, $post_day){
		global $wpdb;
		$limit = 30;
		$order = "latest";
		if($order == "latest"){ $order = "DESC";} else { $order = '';}
		$sql = "select ID, year(post_date_gmt) as h_year, post_title, comment_count FROM 
		$wpdb->posts WHERE post_password = '' AND post_type = 'post' AND post_status = 'publish'
		AND year(post_date_gmt)!='$post_year' AND month(post_date_gmt)='$post_month' AND day(post_date_gmt)='$post_day'
		order by post_date_gmt $order limit $limit";
		$histtory_post = $wpdb->get_results($sql);
		return $histtory_post;
	}

	function wp_history_post($y,$m,$j){
		$wp_history_post_content_list = '<p>%YEAR%年：<a href="%LINK%" title="%TITLE%">%TITLE%</a></p>';
		$wp_history_post_content_title = '<label>過去的一樣時間也寫過...</label>';
		$histtory_post = wp_history_post_base($y,$m,$j);
		if($histtory_post){
			foreach( $histtory_post as $post ){
				$h_year = $post->h_year;
				$h_post_title = $post->post_title;
				$h_permalink = get_permalink( $post->ID );
				$h_comments = $post->comment_count;
				$h_post .= $wp_history_post_content_list;
				$h_post = str_replace("%YEAR%", $h_year, $h_post);
				$h_post = str_replace("%LINK%", $h_permalink, $h_post);
				$h_post = str_replace("%TITLE%", $h_post_title, $h_post);
			}
		}
		if($h_post){
			$result = $wp_history_post_content_title.$h_post;
		}
		return $result;
		wp_reset_query();
	}
	/*歷史的這一天結束*/

	function header_customize_image($wp_customize){
		$wp_customize->add_section('JimmyFDesinger_header_image', array(
			'title'    => __('header_image', 'JimmyFDesinger'),
			'description' => '頁首圖片',
			'priority' => 120,
		));
		$wp_customize->add_setting('header_image', array(
			'default'		 =>'imgages/header.jpg',
			'capability'     => 'edit_theme_options',
			'type'           => 'option',
		));
	 
		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'header_image', array(
			'label'    => __('上傳圖片', 'JimmyFDesinger'),
			'section'  => 'JimmyFDesinger_header_image',
			'settings' => 'header_image',
		)));
	}
	add_action('customize_register','header_customize_image');

	function header_customize_TitleColor($wp_customize){
		$wp_customize->add_section('JimmyFDesinger_title_color', array(
			'title'    => __('title_text_color', 'JimmyFDesinger'),
			'description' => '標題顏色',
			'priority' => 120,
		));
		$wp_customize->add_setting('title_text_color', array(
			'default'		 => '#FFF',
			'capability'     => 'edit_theme_options',
			'type'           => 'option',
		));
	 
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'title_text_color', array(
			'label'    => __('Title Color', 'JimmyFDesinger'),
			'section'  => 'JimmyFDesinger_title_color',
			'settings' => 'title_text_color',
		)));
	}
	add_action('customize_register','header_customize_TitleColor');


?>