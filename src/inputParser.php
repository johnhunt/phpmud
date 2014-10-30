<?php
namespace Utility;

/**
 * Class InputParser
 *
 * Take a string input and process it.
 *
 * @todo Update this docblock
 * @package Utility
 */
class InputParser
{
    const TOKEN_DELIMITER = ' ';

    var $command = '';
    var $inputText = '';

    function __construct()
    {
    }

    public function tokenise($string)
    {
        $tokens = explode(self::TOKEN_DELIMITER, $string)
    }
}