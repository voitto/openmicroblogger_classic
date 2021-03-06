<?php 
get_header( ); 
$tag_obj = $wp_query->get_queried_object();
?>
<div class="sleeve_main">
<div id="main">
	<h2>Recent Updates: <?php single_tag_title( ); ?> <a class="rss" href="<?php echo get_tag_feed_link( $tag_obj->term_id ); ?>">RSS</a></h2>
	<ul id="postlist">

<?php
if( have_posts( ) ) {

	$previous_user_id = 0;
	while( have_posts( ) ) {
		the_post( );
?>


<li id="prologue-<?php the_ID(); ?>" class="user_id_<?php the_author_ID( ); ?>">

<?php
	$current_user_id = get_the_author_ID( );
	echo prologue_get_avatar( $current_user_id, get_the_author_email( ), 48 );
?>

	<h4>
		<?php the_author_posts_link( ); ?>
		<span class="meta">
			<?php the_time( ); ?> <em>on</em> <?php the_time( 'F j, Y' ); ?> |
			<?php comments_popup_link( __( '0' ), __( '1' ), __( '%' ) ); ?> |
			<a href="<?php the_permalink( ); ?>" class="thepermalink">#</a>
			<span class="actions">
			<?php if (function_exists('post_reply_link')) 
				echo post_reply_link(array('before' => ' | ', 'reply_text' => 'Reply', 'add_below' => 'prologue'), get_the_id()); ?>
			<?php if (current_user_can('edit_post', get_the_id())) { ?>
			|  <a href="<?php echo (get_edit_post_link( get_the_id() ))?>" class="post-edit-link" rel="<?php the_ID(); ?>">Edit</a>
			<?php } ?>
			</span>
			<br />
			<?php tags_with_count( '', __( 'Tags: ' ), ', ', ' ' ); ?>
		</span>
	</h4>
	<div class="postcontent<?php if (current_user_can( 'edit_post', get_the_id() )) {?> editarea<?}?>" id="content-<?php the_ID(); ?>"><?php the_content( __( '(More ...)' ) ); ?></div> <!-- // postcontent -->
	<div class="bottom_of_entry">&nbsp;</div>
	<?php 
		if (is_tag())  $withcomments = true; 
		comments_template('/inline-comments.php'); 
	?>
<?php
//Only append comment form to  first post with open comments
if( !$formvisible && 'open' == $post->comment_status ) {
$formvisible=1;
?>
<div id="wp-temp-form-div">
<div id="respond">

<h3>Reply <small id="cancel-comment-reply"><?php echo cancel_comment_reply_link() ?></small></h3>

<?php
if ( get_option('comment_registration') && !$user_ID ) {
?>

<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>" title="Log in">logged in</a> to post a comment.</p>

<?php
// if option comment_registration and not user_ID
} else { ?>

<form id="commentform" action="<?php echo get_option( 'siteurl' ); ?>/wp-comments-post.php" method="post">
	<div class="form"><textarea id="comment" name="comment" cols ="45" rows="3"></textarea></div>
	<label class="post-error" for="comment" id="commenttext_error"></label>
	<?php if( $user_ID ) { ?>
		<p>Logged in as <a href="<?php echo get_option( 'siteurl' ); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>.  <a href="<?php echo get_option( 'siteurl' ); ?>/wp-login.php?action=logout" title="Log out">Log out &rarr;</a></p>
<?php // if user_ID 
} else { ?>
<table>
	<tr>
		<td>
			<label for="author">Name <em>(required)</em></label>
			<div class="form"><input id="author" name="author" type="text" value="<?php echo $comment_author; ?>" /></div>
		</td>
		<td>
			<label for="email">Email <em>(required)</em></label>
			<div class="form"><input id="email" name="email" type="text" value="<?php echo $comment_author_email; ?>"  /></div>
		</td>
		<td class="last-child">
			<label for="url">Web Site</label>
			<div class="form"><input id="url" name="url" type="text" value="<?php echo $comment_author_url; ?>"  /></div>
		</td>
	</tr>
</table>
<?php } // else user_ID ?>

<div><input id="comment-submit" name="submit" type="submit" value="Post Comment"  /><?php comment_id_fields(); ?>&nbsp;<span class="progress"><img src="<?php bloginfo('template_directory'); ?>/i/indicator.gif" alt="Loading..." /></span></div>

</form>
</div>
</div>
<?php
} // else option comment_registration and not user_ID
} // if open comment_status
?>
</li>
<?php
	} // while have_posts

	echo '<div class="navigation"><p>' . posts_nav_link() . '</p></div>';
} // if have_posts
?>

	</ul>
</div> <!-- // main -->
</div> <!--sleeve_main" -->
<?php
get_footer( );
