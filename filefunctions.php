<?php

function readLines($filename)
{
    $fileResource = fopen($filename, 'r');

    if(!is_resource($fileResource))
    {
        exit("File could not be opened for reading.");
    }

    $contents = array();

    while($line = fgets($fileResource))
    {
        $contents[] = explode("-", $line);
    }

    fclose($fileResource);

    return $contents;
}