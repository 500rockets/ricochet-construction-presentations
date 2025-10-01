<?php if ( $custom_query->max_num_pages > 1 ) : ?>

	<section class="module-sm module-gray">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">

					<?php
					/**
					 * Show posts pagination.
					 *
					 * @see core_paginate_links()
					 */
					core_paginate_links( paginate_links( array(
						'type'      => 'list',
						'prev_text' => '<span class="arrows arrows-arrows-slim-left"></span>',
						'next_text' => '<span class="arrows arrows-arrows-slim-right"></span>',
						'total'     => $custom_query->max_num_pages,
						'current'   => max( 1, $custom_query->get( 'paged' ) ),
					) ) ); ?>

				</div>
			</div>
		</div>
	</section>

<?php endif; ?>
