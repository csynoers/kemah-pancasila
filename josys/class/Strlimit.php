<?php
class Strlimit {
    /**
     * Limit the number of characters in a string.
     *
     * <code>
     *        // Returns "Tay..."
     *        echo strlimit('Taylor', 3);
     *
     *        // Limit the number of characters and append a custom ending
     *        echo strlimit('Taylor', 3, '---');
     * </code>
     *
     * @param  string  $value
     * @param  int     $limit
     * @param  string  $end
     * @return string
     */
    function chars($value, $limit, $end = '...')
    {
        $value = htmlspecialchars_decode(strip_tags(stripslashes(addslashes($value)))); //clean code
        return (strlen($value) <= $limit) ? $value : substr($value, 0, $limit).$end;
    }

    /**
     * Limit the number of chracters in a string including custom ending
     *
     * <code>
     *        // Returns "Taylor..."
     *        echo strlimit_exact('Taylor Otwell', 9);
     *
     *        // Limit the number of characters and append a custom ending
     *        echo strlimit_exact('Taylor Otwell', 9, '---');
     * </code>
     *
     * @param  string  $value
     * @param  int     $limit
     * @param  string  $end
     * @return string
     */
    function exact($value, $limit, $end = '...')
    {
        $value = htmlspecialchars_decode(strip_tags(stripslashes(addslashes($value)))); //clean code
        $limit -= strlen($end);

        return (strlen($value) <= $limit) ? $value : strlimit($value, $limit, $end);
    }

    /**
     * Limit the number of words in a string.
     *
     * <code>
     *        // Returns "This is a..."
     *        echo strlimit_words('This is a sentence.', 3);
     *
     *        // Limit the number of words and append a custom ending
     *        echo strlimit_words('This is a sentence.', 3, '---');
     * </code>
     *
     * @param  string  $value
     * @param  int     $words
     * @param  string  $end
     * @return string
     */
    function words($value, $words, $end = '...')
    {
        if (trim($value) == '') return '';
        $value = htmlspecialchars_decode(strip_tags(stripslashes(addslashes($value)))); //clean code
        preg_match('/^\s*+(?:\S++\s*+){1,'.$words.'}/u', $value, $matches);

        if (strlen($value) == strlen($matches[0]))
        {
            $end = '';
        }

        return rtrim($matches[0]).$end;
    }
}
