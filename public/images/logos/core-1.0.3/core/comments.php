<?php if ( post_password_required() ) { return; } ?>

<div id="comments" class="comments-area">

	<h5 class="comments-title">
		<?php
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
			esc_html_e( 'Comments are closed', 'core' );
		} else {
			comments_number();
		} ?>
	</h5>

	<?php if ( have_comments() ) : ?>

		<div class="comment-list">

			<?php wp_list_comments( array(
				'type'         => 'comment',
				'style'        => 'div',
				'callback'     => '_core_comment_callback',
				'end-callback' => '_core_comment_callback_end',
			) ); ?>

		</div>

	<?php endif; ?>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<div class="module-sm module-divider-top">

			<?php
			/**
			 * Show comments pagination.
			 *
			 * @see core_paginate_links()
			 */
			core_paginate_links( paginate_comments_links( array(
				'type'      => 'list',
				'prev_next' => false,
				'echo'      => false,
			) ) ); ?>

		</div>
	<?php endif; ?>

	<?php
	// Specifying the comment form settings.
	$commenter     = wp_get_current_commenter();
	$required      = get_option( 'require_name_email' );
	$aria_required = ( $required ? 'aria-required="true"' : '' );
	$html_required = ( $required ? 'required="required"' : '' );

	// Show comment forms.
	comment_form( array(
		'comment_field' =>
			'<div class="form-group col-sm-12">' .
				'<textarea id="comment" ' .
						  'name="comment" ' .
						  'cols="45" ' .
						  'rows="8" ' .
						  'maxlength="65525" ' .
						  'class="form-control"' .
						  'placeholder="' . esc_attr__( 'Comment', 'core' ) . '*"' .
						  'aria-required="true" ' .
						  'required="required">' .
				'</textarea>' .
			'</div>',
		'fields' => array(
			'author' =>
				'<div class="form-group col-sm-4">' .
					'<input id="author" ' .
						   'name="author" ' .
						   'type="text" ' .
						   'value="' . esc_attr( $commenter['comment_author'] ) . '" ' .
						   'size="30" ' .
						   'maxlength="245" ' .
						   'class="form-control" ' .
						   'placeholder="' . esc_attr__( 'Name', 'core' ) . ( $required ? '*' : '' ) . '" ' .
						   $aria_required . ' ' .
						   $html_required . '/>' .
				'</div>',
			'email' =>
				'<div class="form-group col-sm-4">' .
					'<input id="email" ' .
						   'name="email" ' .
						   'type="email" ' .
						   'value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' .
						   'size="30" ' .
						   'maxlength="100" ' .
						   'aria-describedby="email-notes" ' .
						   'class="form-control" ' .
						   'placeholder="' . esc_attr__( 'E-mail', 'core' ) . ( $required ? '*' : '' ) . '" ' .
						   $aria_required . ' ' .
						   $html_required . '/>' .
				'</div>',
			'url' =>
				'<div class="form-group col-sm-4">' .
					'<input id="url" ' .
						   'name="url" ' .
						   'type="url" ' .
						   'value="' . esc_attr( $commenter['comment_author_url'] ) . '" ' .
						   'size="30" ' .
						   'maxlength="200" ' .
						   'class="form-control" ' .
						   'placeholder="' . esc_attr__( 'Website', 'core' ) . '"/>' .
				'</div>',
		),
		'title_reply_before' => '<h5 class="comment-reply-title">',
		'title_reply_after'  => '</h5>',
		'class_submit'       => 'btn btn-round btn-brand',
		'submit_field'       => '<div class="form-submit col-sm-12">%1$s %2$s</div>',
		'class_form'         => 'comment-form row',
	) ); ?>

</div>
