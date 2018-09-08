@php
//php list function
$info = array('coffee', 'brown', 'caffeine');
var_dump($info);
echo "<hr>";
list($drink, $color, $power) = $info;
var_dump($drink);var_dump($color);
echo "<hr>";
var_dump($info);

//echo "$drink is $color and $power makes it special.\n";
@endphp