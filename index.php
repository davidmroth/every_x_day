<?php
/**
 * Plugin Name:       Every X Day
 * Description:       With "Every X Day", you no longer have to manually count days on your calendar. Install it, choose the ordinal and the day of the week you're interested in, and our plugin will instantly tell you the date. To use it, use the shortcode: [every_x_day day="[day of the week]" which="[first, second, third, fourth]" /]
 * Version:           0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            David Roth
 * Author URI:        https://efficientitpros.com 
 *
 *
 * @author David Roth, david@efficientitpros.com
 *
 */
namespace occ {
    class EveryXDay
    {
        function __construct()
        {
            add_shortcode('every_x_day', array($this, 'getEveryXDay'));
        }

        function ordinal($a)
        {
            // return English ordinal number
            return $a . substr(date('jS', mktime(0, 0, 0, 1, ($a % 10 == 0 ? 9 : ($a % 100 > 20 ? $a % 10 : $a % 100)), 2000)), -2);
        }

        function getEveryXDay($atts)
        {
            $ordinal = $atts['which'];
            $day = $atts['day'];

            $month = date('m');
            $year = date('Y');
            $value = explode('|', date("F|j", strtotime($ordinal . " " . $day, mktime(0, 0, 0, $month, 1, $year))));

            return $value[0] . ' ' . $this->ordinal($value[1]);
        }
    }

    new EveryXDay;
}