<?php
/**
 * Created by PhpStorm.
 * User: thanhlam
 * Date: 06/05/2021
 * Time: 22:53
 */
!defined('ABSPATH') && exit;
class HanzoCatMobileMenuWalker extends Walker_Nav_Menu
{
    /**
     * {@inheritdoc}
     */
    function start_lvl(&$output, $depth=0, $args=array())
    {

        if($depth == 0)$output .= '<ul class="menu-mobile__sub">';
        else $output .= '<ul class="mobile__mega">';

    }

    /**
     * {@inheritdoc}
     */
    function end_lvl(&$output, $depth=0, $args=array())
    {

        $output .= '</ul>';

    }


}