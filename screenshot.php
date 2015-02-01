<?php 

require_once("global.php"); 

$id = $_REQUEST['id'];

// Screenshot!
$snapchat->markSnapShot($id);

echo "1";