<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$h5abSnowFlurryArray = get_option('h5abSnowFlurryV2Array');

if (get_option('h5abSnowFlurryV2Array')) {} else {
    
    $snowFlurryMaxSize = wp_strip_all_tags(5);
    $snowFlurryNumberFlakes = wp_strip_all_tags(25);
    $snowFlurryMinSpeed = wp_strip_all_tags(10);
    $snowFlurryMaxSpeed = wp_strip_all_tags(15);
    $snowFlurryColor = wp_strip_all_tags('#fff');
    $snowFlurryTimeout = wp_strip_all_tags(0);

    $snowFlurryMaxSize = sanitize_text_field($snowFlurryMaxSize);
    $snowFlurryNumberFlakes = sanitize_text_field($snowFlurryNumberFlakes);
    $snowFlurryMinSpeed = sanitize_text_field($snowFlurryMinSpeed);
    $snowFlurryMaxSpeed = sanitize_text_field($snowFlurryMaxSpeed);
    $snowFlurryColor = sanitize_text_field($snowFlurryColor);
    $snowFlurryTimeout = sanitize_text_field($snowFlurryTimeout);

    $h5abSnowFlurryArray = array(
        'h5abSnowFlurryMaxSize' => $snowFlurryMaxSize,
        'h5abSnowFlurryNumberFlakes' => $snowFlurryNumberFlakes,
        'h5abSnowFlurryMinSpeed' => $snowFlurryMinSpeed,
        'h5abSnowFlurryMaxSpeed' => $snowFlurryMaxSpeed,
        'h5abSnowFlurryColor' => $snowFlurryColor,
        'h5abSnowFlurryTimeout' => $snowFlurryTimeout
    );

    add_option('h5abSnowFlurryV2Array', $h5abSnowFlurryArray);
        ?>
        <script>location.reload();</script>
        <?php
    }

?>

<form id="h5ab-snow-flurry" method="post" enctype="multipart/form-data">

<h2>Snow Flurry Settings</h2>

<div style="max-width: 500px;">

    <div style="padding: 0.5em 0; border-bottom: 1px solid #fff;">
        <label>Max Snow Flake Size (px): </label>
        <br/>
        <input type="number" value='<?php echo esc_attr($h5abSnowFlurryArray['h5abSnowFlurryMaxSize']); ?>' name="SnowFlurryMaxSize" maxlength="25" min="1" max="10" />
        <br/>
        <label style="font-size: 0.75em;">Max Entry Value 10 (px)</label>
    </div>

    <div style="padding: 0.5em 0; border-bottom: 1px solid #fff;">
        <label>Number of Flakes: </label>
        <br/>
        <input type="number" value='<?php echo esc_attr($h5abSnowFlurryArray['h5abSnowFlurryNumberFlakes']); ?>' name="SnowFlurryNumberFlakes" maxlength="25"/>
        <br/>
        <label style="font-size: 0.75em;">Recommended Maximum of 25</label>
    </div>

    <div style="padding: 0.5em 0; border-bottom: 1px solid #fff;">
        <label>Snow Flake Minimum Speed (value) Seconds - Top to Bottom Speed: </label>
        <br/>
        <input type="number" value='<?php echo esc_attr($h5abSnowFlurryArray['h5abSnowFlurryMinSpeed']); ?>' name="SnowFlurryMinSpeed" maxlength="25"/><br/>
        <label style="font-size: 0.75em;">Must be less than Snow Flake Maximum Speed</label>
    </div>

    <div style="padding: 0.5em 0; border-bottom: 1px solid #fff;">
        <label>Snow Flake Maximum Speed (value) Seconds - Top to Bottom Speed: </label>
        <br/>
        <input type="number" value='<?php echo esc_attr($h5abSnowFlurryArray['h5abSnowFlurryMaxSpeed']); ?>' name="SnowFlurryMaxSpeed" maxlength="25"/>
        <br/>
        <label style="font-size: 0.75em;">Must be Greater than Snow Flake Minimum Speed</label>
    </div>

    <div style="padding: 0.5em 0; border-bottom: 1px solid #fff;">
        <label>Snow Flake Color (HTML Color): </label>
        <br/>
        <input type="text" value='<?php echo esc_attr($h5abSnowFlurryArray['h5abSnowFlurryColor']); ?>' name="SnowFlurryColor" maxlength="25"/>
    </div>

    <div style="padding: 0.5em 0;">
        <label>Disable Snow Flakes After (Seconds): </label>
        <br/>
        <input type="number" value='<?php echo esc_attr($h5abSnowFlurryArray['h5abSnowFlurryTimeout']); ?>' name="SnowFlurryTimeout" maxlength="25"/>
    </div>
    
    <br>

    <?php
    wp_nonce_field('H5AB_Snow_Flurry_upload_nonce','H5AB_Snow_Flurry_upload_n');

    if ( ! is_admin() ) {
    echo 'Only Admin Users Can Update These Options';
    } else {
    echo '<input type="submit" class="button button-primary" id="h5ab_snow_flurry_submit" name="h5ab_snow_flurry_submit" value="Save Settings" />';
    }
    ?>
    
    <br>
    <br>

</div>

</form>

<div class="h5ab-affiliate-advert" style="width: 250px;">
                    <p style="margin: 0; text-align: center;">Advertisements*</p>
                    <a href="http://si123.seopressor.hop.clickbank.net" target="_blank"><img src="<?php echo esc_url(plugins_url( '../images/seopressor-banner.jpg', __FILE__ )) ?>" border="0" style="max-width: 100%; height: auto;" /></a>
                    <br>
                    <br>
                    <a href="https://www.rocketresponder.com/?ref=17327" target="_blank"><img src="<?php echo esc_url(plugins_url( '../images/rocket-responder-banner.jpg', __FILE__ )) ?>" border="0" style="max-width: 100%; height: auto;" /></a>

</div>

<hr/>

<div style="width: 98%; padding: 0 5px;">
<p>*Affiliate Links - We (Plugin Authors) earn commission on sales generated through these link.</p>
</div>