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
        // $contents[] = $line;
        $contents[] = explode(",", $line);
    }

    fclose($fileResource);

    return $contents;
}

function readFullLines($filename)
{
    $fileResource = fopen($filename, 'r');

    if(!is_resource($fileResource))
    {
        exit("File could not be opened for reading.");
    }

    $contents = array();

    while($line = fgets($fileResource))
    {
        $contents[] = $line;
    }

    fclose($fileResource);

    return $contents;
}

function appendLine($filename, $line)
{
    $fileResource = fopen($filename, 'a');

    if(!is_resource($fileResource))
    {
        exit("File could not be opened for appending.");
    }

    fwrite($fileResource, $line);
    fwrite($fileResource, "\n");

    fclose($fileResource);

    return null; 
}

function deleteLine($filename, $lineNumber){
    $contents = readFullLines($filename);

    unset($contents[$lineNumber]);

    $fileResource = fopen($filename, 'w');

    if(!is_resource($fileResource))
    {
        exit("File could not be opened for writing.");
    }

    foreach($contents as $contentLine)
    {
        fwrite($fileResource, $contentLine);
    }

    fclose($fileResource);

    return null; 
}