<?php

require_once("global.php"); 

// Get your feed:
$snaps = $snapchat->getSnaps();

//print_r($snaps);

$body = "";
$body .= '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
$i = 0;
foreach ($snaps as $snap) {
    if ($snap->time == "") {
        continue;
    }
    $body .='
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading' . $i . '">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#acc' . $i . '" aria-expanded="false" aria-controls="acc' . $i . '" name="accordion">
         ' . $snap->sender . '
       </a>
      </h4>
    </div>
    <div id="acc' . $i . '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading' . $i . '">
      <div class="panel-body" data-id="' . $snap->id . '" onclick="loadImage(this)">Load Image</div>
    </div>
  </div>
';
    $i = $i + 1;
}

if ($i == 0) {
$body.='<div class="alert alert-dismissable alert-success">
  <strong>All snaps opened!</strong> 
</div>';
}
$body .= '</div>';

$body .='

<script>
function loadImage(el) {
    if ($(el).html() == "Load Image") {
        $.get("loadimage.php", {id:$(el).data("id")}, function(data) {
            if (data == "1") {
                $(el).html("Image Unavailable!");
            } 
            else {
                $(el).html(data);
            }
        });
    } 
    else {
        return;
    }
}

function markRead(el) {
        $.get("open.php", {id:$(el).data("id")}, function(data) {
//alert(data);
        });
}

function screenshot(el) {
        $.get("screenshot.php", {id:$(el).data("id")}, function(data) {
//alert(data);
        });
}
</script>

';

require_once("html.inc");