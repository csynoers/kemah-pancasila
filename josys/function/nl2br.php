<?php
function nl2br2($string) {
  $string = str_replace(array("\r\n", "\r", "\n"), "<br />", $string);
  return $string;
}
