<?php


$cmd = "$ffmpegPath -i $tempFilePath $finalFilePath 2>&1";

$outputLog = array();
exec($cmd, $outputLog, $returnCode);
echo $outputLog;
echo $returnCode;
?>