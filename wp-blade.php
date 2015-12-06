<?php
/*
Plugin Name: WP Blade
Plugin URI: 'Build wordpress theme with blade templating'
Description:
Version: 0.1
Author: Mithu A Quayium
Author URI: http://www.cybercraftit.com
License: GPLv2 or later
Text Domain: wpb
*/

require_once 'vendor/autoload.php';

add_action('init',function(){

    $path = [ get_stylesheet_directory() ];
    $cachePath = dirname(__FILE__).'/cache_path';

    $compiler = new \Xiaoler\Blade\Compilers\BladeCompiler($cachePath);

    $engine = new \Xiaoler\Blade\Engines\CompilerEngine($compiler);
    $finder = new \Xiaoler\Blade\FileViewFinder($path);

    $finder->addExtension('txt');

    $factory = new \Xiaoler\Blade\Factory($engine, $finder);

    add_filter( 'template_include', function ( $template ) use ( $factory) {
        echo $factory->make( str_replace('.php','',basename($template)), ['a' => 1, 'b' => 2])->render();
    }, 99 );
});

