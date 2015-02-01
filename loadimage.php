<?php 

require_once("global.php"); 

$id = $_REQUEST['id'];

// Download a specific snap:
$data = $snapchat->getMedia($id);

if (strlen($data) == 0) {
    exit("1");
}

$i = 1;
while (file_exists("images/snap". $i . ".jpg")) {
    $i = $i + 1;
}

file_put_contents('images/snap' . $i . '.jpg', $data);

$buttons ='
<div class="btn-group" style="margin-top:10px;">
  <button type="button" class="btn btn-primary">Options</button>
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a onclick="markRead(this)" data-id="' . $id . '">Mark opened</a></li>
    <li><a onclick="screenshot(this)" data-id="' . $id . '">Mark screenshot</a></li>
    <li class="divider"></li>
    <li><a onclick="alert(\'Currently in development!\');">Info</a></li>
  </ul>
</div>
';
echo '<img style="max-width:100%;" src="images/snap' . $i . '.jpg">' . $buttons;