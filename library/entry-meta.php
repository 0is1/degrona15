<?php
if( ! function_exists( 'degrona15_entry_meta') ) :
    function degrona15_entry_meta() {
        echo '<time class="updated" datetime="'. get_the_time( 'c' ) .'">'. sprintf( __( 'Posted on %s at %s.', 'DeGrona15' ), get_the_date(), get_the_time() ) .'</time>';
        echo '<p class="byline author">'. __( 'Written by', 'DeGrona15' ) .' <a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ) .'" rel="author" class="fn">'. get_the_author() .'</a></p>';
    }
endif;
?>
