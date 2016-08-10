<?php if(!defined('ABSPATH')) die('Fatal Error');
/*
Plugin Name: Investopedia Demo Trading Account
Plugin URI: #
Description: Divestmedia plugin for displaying Demo Trading Portfolio
Author: ralphjesy@gmail.com
Version: 1.0
Author URI: https://github.com/ralphjesy12
*/

define( 'INVESTOPHP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'INVESTOPHP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// require __DIR__ . '/vendor/autoload.php';
// require __DIR__ . '/lib/class.investopedia.php';
require __DIR__ . '/lib/class.tradier.php';
require __DIR__ . '/lib/shortcode-portfolio.php';
