<?php if(!defined('ABSPATH')) die('Fatal Error');

add_shortcode('trading_portfolio','trading_portfolio_cb');
function trading_portfolio_cb($atts, $content = NULL){
    global $post,$wpdb;
    // $Investophp = new Investophp('kenyon@divestmedia.com','Harry15t$!$!');
    // $status = $Investophp->getPortfolioStatus();

    $tradier = new Tradier();
    extract( shortcode_atts([],$atts));
    wp_enqueue_style( 'investophp-trading-css',  INVESTOPHP_PLUGIN_URL . 'assets/trading.css' ,null,null,false);
    wp_enqueue_script( 'investophp-trading-js',  INVESTOPHP_PLUGIN_URL . 'assets/trading.js' ,['jquery'],null,true);
    ob_start(); ?>
    <div class="row countTo-lg text-center">
        <div class="col-xs-6 col-sm-6">
            <pre><?php var_dump($tradier->fetch());?></pre>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
