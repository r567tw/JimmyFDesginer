<?php
if ( post_password_required() )
	return;
?>

<h3><?php comments_number('沒有回應', '回應 (1)', '回應 (%)' );?></h3>
<?php if ( have_comments() ) : ?>

	<ol>
		<?php wp_list_comments('type=comment&callback=displaycomments'); ?>
	</ol>
	<div class="clearfix"></div>
	<div class="pagenavi">
		<?php paginate_comments_links('prev_text=Prev Comments&next_text=Next Comments');?>
	</div>

<?php else :  ?>

	<?php if ( comments_open() ) : ?>
		<p>本文還沒有回應，快來搶頭香！你來你來</p>
	<?php else : ?>
		<p class="well">本文不開放回應。</p>
	<?php endif; ?>

<?php endif; ?>

<!--自定義留言表單-->
<?php
	$args = array(
		'label_submit'=>'留言',
        'title_reply'=>'<p>凡走過必留下痕跡，泡個茶聊個天嘛^_^</p><br/>',
        'comment_notes_after' => '<i>謝謝您的回應，願上帝的恩惠慈愛常與您同在喔,呵呵</i><br/>',
        'comment_notes_before'=>'',
		'comment_field' => '<p><label for="comment">' . _x( '請於底下回應：', 'themetext' ) . '</label><textarea class="form-control" name="comment" required="true"></textarea></p>',
		'fields' =>array(
			'author' =>
				'<span class="glyphicon glyphicon-user"></span>' .
				'<label class="control-lebel" for="author">' . __( '您的大名：<span class="required">*</span>', 'themetext' ) . '</label> ' .
				'<input class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
				'" size="30"' . $aria_req . ' /></span>',
			'email' =>
				'<span class="glyphicon glyphicon-envelope"></span><label class="control-lebel" for="email">' . __( '電子信箱：<span class="required">*</span>', 'themetext' ) . '</label> ' .
				'<input class="form-control" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="30"' . $aria_req . ' /></span>'	
		)
		
	);
	comment_form( $args ); 
?>

