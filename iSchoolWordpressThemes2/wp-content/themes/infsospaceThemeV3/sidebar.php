<?php if ( is_sidebar_active('Sidebar') ) : ?>
                <div id="primary" class="widget-area">
                        <ul class="xoxo">
                                <?php dynamic_sidebar('primary_widget_area'); ?>
                        </ul>
                </div><!-- #primary .widget-area -->
<?php endif; ?>         
                
<?php if ( is_sidebar_active('footerl-widgetarea') ) : ?>
                <div id="secondary" class="widget-area">
                        <ul class="xoxo">
                                <?php dynamic_sidebar('secondary_widget_area'); ?>
                        </ul>
                </div><!-- #secondary .widget-area -->
<?php endif; ?>      