<div class="wrap">    
    <?php if ($token): ?>
        <h1><?php echo $title ?></h1>   
        <iframe id="riddle_iframe" src="<?php echo RIDDLE_URL ?>creation?token=<?php echo $token ?>&wordpress=1"></iframe>
        <script>
            jQuery(function () {
                jQuery('#riddle_iframe').height(jQuery('body').outerHeight() + 'px');

                window.addEventListener("message", function (event) {
                    if (event.data.riddleHeight) {
                        var iframeStyle = jQuery('#riddle_iframe');
                        iframeStyle.height(event.data.riddleHeight + "px");
                    }

                    if (event.data.riddleNavigate) {
                        window.location.href = '<?php echo get_site_url(null, '') ?>' + event.data.riddleNavigate;
                    }
                }, false);
            });
        </script>
    <?php else: ?>
        <script>
            window.location.href = "<?php echo get_site_url(null, 'wp-admin/admin.php?page=riddle-settings') ?>"
        </script>
    <?php endif; ?>
</div>