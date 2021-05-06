<?php
/**
 * Created by PhpStorm.
 * User: thanhlam
 * Date: 06/05/2021
 * Time: 21:29
 */
!defined('ABSPATH') && exit;
class HanzoCatMenuWalker extends Walker_Nav_Menu
{
    /**
     * {@inheritdoc}
     */
    function start_lvl(&$output, $depth=0, $args=array())
    {

      if($depth == 0)$output .= '<div class="introNavBox"><ul class="mega-menu">';
      else $output .= '<ul class="sub-menu">';

    }

    /**
     * {@inheritdoc}
     */
    function end_lvl(&$output, $depth=0, $args=array())
    {
        if($depth == 0)$output .= '</ul></div>';
        else $output .= '</ul>';

    }


}