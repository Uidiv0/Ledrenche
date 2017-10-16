<?php if (!empty($_POST)): ?>
<?php if ($configs['user']['wp_token']): ?>   
<div id="message" class="updated notice notice-success is-dismissible">
    <p>
        WordPress Token applied.
    </p>
    <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss message</span></button>
</div>
<?php else: ?>
<div id="message" class="updated notice notice-success is-dismissible">
    <p>
        WordPress Token removed.
    </p>
    <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss message</span></button>
</div>

<?php endif; ?>
<?php endif; ?>
<div class="setting-rid-wp wrap">
    <h1><?php echo _('Account Settings')?></h1>
    <div class="set-rid-list">
        <div class="card card-logo">
            <img src="<?php echo $logo?>" alt="Riddle" />
        </div>
        <?php if (!$configs['user']['wp_token']): ?>
        <div class="card">
            <h2><?php echo _('Signup to Riddle now!')?></h2>
            <p>Start your 14 days trial now and get creating.
                Just click the button below, register, and your WordPress token will be
                automatically passed into the field below.
            </p>
            <a href="<?php echo RIDDLE_URL?>user/signup?wordpress=1" target="_blank" class="btn getWpToken" id="">Sign up & get WP Token</a>
            <h2><?php echo _('- or- Existing Users')?></h2>
            <p>If you already have an Account please log in with this.
                Your WordPress token will be automatically passed into the field below.
            </p>
            <a href="<?php echo RIDDLE_URL?>user/login?wordpress=1" target="_blank" class="btn getWpToken" id="">Log in & get WP Token</a>
        </div>
        <?php endif; ?>
        
        <?php if ($configs['user']['wp_token']): ?>            
            <div class="card">
                <h2><?php echo _('Thank you for using Riddle!')?></h2>
                <p>
                    Go to <a href="<?php echo get_site_url(null, 'wp-admin/admin.php?page=riddle-list') ?>">my Riddles</a> or 
                    <a href="<?php echo get_site_url(null, 'wp-admin/admin.php?page=riddle-creation') ?>">create a new Riddle.</a>
                </p>
            </div>
        <?php endif; ?>

        <div class="card">
            <h2><?php echo _('WordPress Token')?></h2>
            <?php if (!$configs['user']['wp_token']): ?>
            <p>
                Your token will automatically appear below after log in or sign up (or you can copy/paste). Just click on 'My Riddles' or 'Create Riddle' to get started.
            </p>
            <?php endif; ?>
            <form method="post" id="form_wp">
                <input type="text" id="token" name="user[wp_token]" value="<?php echo $configs['user']['wp_token']?>" required="required" />
                <button type="submit" id="save-token" class="btn">Go!</button>
                <button type="button" id="remove-token" class="btn">Remove WP Token</button>
            </form>
        </div>

    </div>
</div>