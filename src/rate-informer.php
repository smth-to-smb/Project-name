<?php
/*
Plugin name: Rate informer
Author: Anton Samarin
Version: 1.1
License: GPL2+
 */
register_activation_hook(__file__, 'ri_activation');
register_deactivation_hook(__file__, 'ri_deactivation');

// saves option to WP_Options table after activation
function ri_activation()
{
    $ri_text_option = array(
        'ri_textfield_text' => 'Dummy text'
    );
    
    add_option('rateinformer_text_option', $ri_text_option);
}

// removes option after deactivation
function ri_deactivation()
{ 
    delete_option('rateinformer_text_option');
}

add_action('admin_menu', 'ri_admin_menu');

function ri_admin_menu()
{
    add_options_page('Rate Informer', 'Rate Informer', 'manage_options', 'rate-informer', 'rate_informer_page');
}

// callback for settings
function section_one_callback()
{
    echo 'Enter text:';
}

// callback for settings fields
function field_one_callback()
{
    $setting = esc_attr(get_option('ri_text_option'));
    echo "<input type='text' name='ri_text_option' value='$setting' />";
}

add_action('admin_init', 'ri_admin_init');

function ri_admin_init()
{
    register_setting('ri-settings-group', 'ri_text_option');
    add_settings_section('ri-section-one', 'Field to enter the text', 'section_one_callback', 'rate-informer');
    add_settings_field('field-one', 'Enter text', 'field_one_callback', 'rate-informer', 'ri-section-one');
}

add_action('wp_enqueue_scripts', 'slider_turnin');

function slider_turnin()
{
    wp_enqueue_script('jquery', 'http://code.jquery.com/jquery-1.11.3.min.js');
    wp_enqueue_script('slider', plugins_url('/js/slider.js', __FILE__));
    wp_enqueue_style('style', plugins_url('/css/style.css', __FILE__));
}

function rate_informer_page()
{ ?>
    <div class="wrap">
        <h2>Rate informer options.</h2>
        <form action="options.php" method="POST">
            <?php settings_fields('ri-settings-group'); ?>
            <?php do_settings_sections('rate-informer'); ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

add_shortcode('ri-init', 'ri_shortcode_handler');
function ri_shortcode_handler()
{ ?>
    <div id="slider-wrap">
        <div id="slider">
            <?php

            $filepath = 'http://example.com/rates/randomrates' . rotator() . '.xml';
            $myrates = simplexml_load_file($filepath);


            foreach ($myrates as $express) {
                ?>
                <div class="slide">
                    <div class="slide_wrapper">
                        <div class="up_link"><a href="http://example.com/response.php?id=<?= $express->id ?>" target="blank">Interested?
                                Click it!</a></div>
                        <div><span>Route:</span> <?= $express->origin ?>&nbsp;-&nbsp;<?= $express->destination ?></div>
                        <div><span>Transport:</span> <?= $express->container_type ?></div>
                        <div><span>Rate:</span> <?= $express->rate ?> USD</div>
                        <div><span>Transit:</span> <?= $express->transit_time ?> days</div>
                        <div class="bottom_link">To publish rates click <a href="http://druglogista.ru" target="blank">HERE</a></div>
                    </div>
                </div>

                <?php
            } ?>
        </div>
    </div>
<?php }


function rotator()
{
    $rand = rand(0, 9);
    return $rand;
}



