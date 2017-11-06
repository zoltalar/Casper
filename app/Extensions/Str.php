<?php

namespace App\Extensions;

class Str extends \Illuminate\Support\Str
{
    /**
     * Inserts HTML paragraphs before all newlines in a string
     *
     * @param   string $str subject
     * @param   boolean $br convert single linebreaks to <br />
     * @return  string
     */
    public static function nl2p($str, $br = true)
    {
        if (($str = trim($str)) === '') {
            return '';
        }

        // Standardize newlines
        $str = str_replace(array("\r\n", "\r"), "\n", $str);

        // Trim whitespace on each line
        $str = preg_replace('~^[ \t]+~m', '', $str);
        $str = preg_replace('~[ \t]+$~m', '', $str);

        // The following regexes only need to be executed if the string contains html
        if ($html = (strpos($str, '<') !== false)) {
            // Elements that should not be surrounded by p tags
            $nop = '(?:p|div|h[1-6r]|ul|ol|li|blockquote|d[dlt]|pre|t[dhr]|t(?:able|body|foot|head)|c(?:aption|olgroup)|form|s(?:elect|tyle)|a(?:ddress|rea)|ma(?:p|th))';

            // Put at least two linebreaks before and after $nop elements
            $str = preg_replace('~^<'.$nop.'[^>]*+>~im', "\n$0", $str);
            $str = preg_replace('~</'.$nop.'\s*+>$~im', "$0\n", $str);
        }

        // Do the <p> magic!
        $str = '<p>' . trim($str) . '</p>';
        $str = preg_replace('~\n{2,}~', "</p>\n\n<p>", $str);

        // The following regexes only need to be executed if the string contains html
        if ($html !== false) {
            // Remove p tags around $nop elements
            $str = preg_replace('~<p>(?=</?'.$nop.'[^>]*+>)~i', '', $str);
            $str = preg_replace('~(</?'.$nop.'[^>]*+>)</p>~i', '$1', $str);
        }

        // Convert single linebreaks to <br />
        if ($br === true) {
            $str = preg_replace('~(?<!\n)\n(?!\n)~', "<br />\n", $str);
        }

        return $str;
    }
}