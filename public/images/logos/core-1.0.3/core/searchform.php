<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search"
		   class="search-field form-control"
		   placeholder="<?php echo __( 'Search', 'core' ) . '...'; ?>"
		   value="<?php echo get_search_query(); ?>"
		   name="s"/>
	<button class="search-button" type="submit">
		<span class="fa fa-search"></span>
	</button>
</form>
