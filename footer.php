<?php
	/*-----------------------------------------------------------------------------------*/
	/* This template will be called by all other template files to finish 
	/* rendering the page and display the footer area/content
	/*-----------------------------------------------------------------------------------*/
?>
<div class="clear"></div>
</main><!-- / end page container, begun in the header -->

<footer class="site-footer">
	<div class="site-info container">
        <div class="footer-container">
            <div class="first-footer">
                <h4>First Title</h4>
                <p><a href="#">Pellentesque</a></p>
                <p><a href="#">Habitant Morbi</a></p>
                <p><a href="#">Tristique Senectus</a></p>
                <p><a href="#">Netus et Malesuada</a></p>
                <p><a href="#">Fames ac turpis</a></p>
                <p><a href="#">Egestas</a></p>  
            </div>
            <div class="second-footer">
                <h4>Second Title</h4>
                <p><a href="#">Tristique Senectus</a></p>
                <p><a href="#">Netus et Malesuada</a></p>
                <p><a href="#">Fames ac turpis</a></p>
                <p><a href="#">Egestas</a></p>
            </div>
            <div class="third-footer">
                <h4>Third Title</h4>
                <p><a href="#">Pellentesque</a></p>
                <p><a href="#">Habitant Morbi</a></p>
                <p><a href="#">Tristique Senectus</a></p>
                <p><a href="#">Netus et Malesuada</a></p>
            </div>
            <div class="fourth-footer">
                <h4>Fourth Title</h4>
                <p><a href="#">Pellentesque</a></p>
                <p><a href="#">Habitant Morbi</a></p>
                <p><a href="#">Tristique Senectus</a></p>
                <p><a href="#">Netus et Malesuada</a></p>
                <p><a href="#">Fames ac turpis</a></p>
                <p><a href="#">Egestas</a></p>  
            </div>
            <div class="clear"></div>
        </div>
        <div class="bottom-footer">
            <div class="bottom-left">
                &COPY; Copyright <?=date("Y");?>
            </div>
            <div class="bottom-center">
                <?php bloginfo( 'name' ); // Display the blog name ?>
            </div>
            <div class="bottom-right">
                By <a href="javascript:void(0);" rel="designer">Robert Dabu</a>
            </div>
        </div>
		<?php if (show_posts_nav()) : ?>
            <!-- pagintation -->
			<div id="pagination" class="clearfix">
				<div class="past-page"><?php previous_posts_link( 'Next Page >>' ); // Display a link to  newer posts, if there are any, with the text 'newer' ?></div>
				<div class="next-page"><?php next_posts_link( '<< Previous Page' ); // Display a link to  older posts, if there are any, with the text 'older' ?></div>
			</div><!-- pagination -->
        <?php endif; ?>
	</div><!-- .site-info -->
</footer><!-- #colophon .site-footer -->

<?php wp_footer(); 
// This fxn allows plugins to insert themselves/scripts/css/files (right here) into the footer of your website. 
// Removing this fxn call will disable all kinds of plugins. 
// Move it if you like, but keep it around.
?>
</div>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/skrollr.min.js"></script>

<script type="text/javascript">
    var $ = jQuery.noConflict(); //Work around to use the $ sign instead of 'jquery'.  Wordpress uses $, this is to avoid conflict 
    $("#menu-menu-2").children().clone().appendTo("#nav");
    $( "#nav" ).append( "<li class='website-title'><?php bloginfo( 'name' ); // Display the blog name ?></li>" );
    //$( ".parallax-image-wrapper" ).insertAfter( $( "#masthead" ) );  
    $(".social-media").fadeIn();
    // winows load makes sure parallax is initialized after everything is loaded
    $(window).load(function() {
        skrollr.init({
    		smoothScrolling: false,
    		mobileDeceleration: 0.004,
            forceHeight: false
    	});
        
        
        // code above cancels side menu scrolling on mobile.  This will put it back.
        if ($(window).width() < 767) {
            $('.expand-sidebar').click(function(){
                if($('#sidebar').css('display') == 'none' ) {
                    skrollr.init().destroy();
                } else {
                    skrollr.init({
                		smoothScrolling: false,
                		mobileDeceleration: 0.004,
                        forceHeight: false
            	   });
                }
            });
        }
        
    });
    
</script>

</body>
</html>
