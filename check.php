<?php
$myfile=fopen("testfile.txt","r") or die("unable to open file!");
//do this till the end of file
while(!feof($myfile)) {
    echo fgets($myfile)."<br>";
}
fclose($myfile);


?>