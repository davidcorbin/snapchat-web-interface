<?php 

require_once("global.php"); 

$id = $_REQUEST['id'];

// Mark the snap as viewed:
$snapchat->markSnapViewed($id);

echo "1";