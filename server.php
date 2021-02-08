

<?php
$file = 'CHANGELOG.md';



$fn = fopen($file, "r");
$line = fgets($fn, 30);
// echo $result;
if (preg_match('/(.*\[)([0-9]{1,3}\.?[0-9]{0,3}\.?[0-9]{0,4})(\].*)/', $line, $output)) {
    echo $output[2];
}
fclose($fn);


// $myfile = fopen($file, "r") or die("Unable to open file!");
// echo fread($myfile,filesize($file));
// fclose($myfile);

/*
In php to read file first you have to use 'fopen' method to open the file
after that you perform different operation on it.
Like Reading file, Writing file etc.

TO read file data we have to use 'fread' method.
*/