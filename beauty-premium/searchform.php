<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div><label class="screen-reader-text" for="s"><?php _e( 'Search for', TEXTDOMAIN ) ?>:</label>
        <input type="text" value="" name="s" id="s" />
        <input type="submit" id="searchsubmit" value="<?php _e( 'Search', TEXTDOMAIN ) ?>" />
    </div>
</form>