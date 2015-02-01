<?php

require_once("global.php");

if (!empty($_FILES)) {
    $random = randString(10); 
    $target = 'tmp/' . $random . '.jpg';
    move_uploaded_file( $_FILES['image']['tmp_name'], $target);
    echo $random . '.jpg';
    exit();
}

$body="";

//print_r($_POST);

if (isset($_POST['length']) && isset($_POST['filename'])) {
    // Upload a snap
    $id = $snapchat->upload(
        Snapchat::MEDIA_IMAGE,
        file_get_contents('tmp/' . $_POST['filename'])
    );
    
    $recipients = array();
    foreach($_POST as $name => $value) {
        if ($name == "length" || $name == "filename") {
	        continue;
        }
        $recipients[] = $name;
    }
    
    $snapchat->send($id, $recipients, intval($_POST['length']));
    unlink("tmp/" . $_POST['filename']);
    $body.='<div class="alert alert-dismissable alert-success"><strong>Snap sent!</strong></div>';
}

$body.='
<form class="form-horizontal" method="post" action="snap.php" onsubmit="return submitsnap();">
  <fieldset>
    <legend>Send a Snap</legend>

    <div class="form-group" style="margin-top:5px;">
        <label class="col-lg-2 control-label">Choose image</label>
        <div class="col-lg-10">
        <span class="btn btn-default btn-file">
            Browse <input type="file" onchange="upload(this.files[0])">
            <input type="hidden" name="filename" id="filename">
        </span>
        </div>
    </div>

    <div class="form-group">
      <label for="select" class="col-lg-2 control-label">Seconds to view snap</label>
      <div class="col-lg-10">
        <select class="form-control" id="select" name="length">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
          <option>6</option>
          <option>7</option>
          <option>8</option>
          <option>9</option>
          <option>10</option>
        </select>
      </div>
    </div>
    
    <div class="form-group">
      <label for="checkbox" class="col-lg-2 control-label">Recepients:</label>
      <div class="col-lg-10">

        <div class="checkbox"><label><input type="checkbox" name="story">Story</label></div>
';

// Get a list of your friends:
$friends = $snapchat->getFriends();
usort($friends, "cmp");

foreach ($friends as $friend) {
    $body.='<div class="checkbox"><label><input type="checkbox" name="' . $friend->name . '">' . $friend->display . " (" . $friend->name . ")</label></div>";
}

        
$body.='
      </div>
    </div>

    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>

  </fieldset>
</form>
';

$body.='
<script type="text/javascript">
function submitsnap() {
    if ($("#filename").val() == "") {
        return false;
    }
    return true;
}

function upload(file) {
	if (!file || !file.type.match(/image.*/)) return;
	$(".btn-file").html($(".btn-file").html().replace("Browse", "Uploading..."));
	
	var fd = new FormData();
	fd.append("image", file);
	
	var xhr = new XMLHttpRequest();
	xhr.open("POST", "snap.php"); 
	xhr.onload = function() {
            $("#filename").val(this.responseText);
            $(".btn-file").html($(".btn-file").html().replace("Uploading...", "Done"));
	}
	xhr.send(fd);
}
</script>
';

function cmp($a, $b) {
    return strcmp($a->display, $b->display);
}


require_once("html.inc");