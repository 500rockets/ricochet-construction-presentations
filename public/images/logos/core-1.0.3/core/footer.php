				<!-- Footer-->
				<footer class="footer">
					<div class="container">
						<div class="row">
							<?php get_sidebar( 'footer' ); ?>
						</div>
					</div>
					<div class="footer-copyright">
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<?php core_footer_copyright_content(); ?>
								</div>
							</div>
						</div>
					</div>
				</footer>
				<!-- Footer end-->
				<a class="scroll-top" href="#top"><i class="fa fa-angle-up"></i></a>
			</div>
			<!-- Wrapper end-->
		</div>
		<!-- Layout end-->

		<!-- Off canvas-->
		<div class="off-canvas-sidebar">
			<div class="off-canvas-sidebar-wrapper">
				<div class="off-canvas-header">
					<a class="close-offcanvas" href="#">
						<span class="arrows arrows-arrows-remove"></span>
					</a>
				</div>
				<div class="off-canvas-content">
					<?php get_sidebar( 'extra' ); ?>
				</div>
			</div>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>
