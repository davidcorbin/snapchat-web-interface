<!doctype html>
<html>
<head>
<meta name="viewport" content="initial-scale=1,user-scalable=no, width=device-width">
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/bootstrap/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Snapwn by David Corbin</a>
    </div>

<?php if(isset($_SESSION['username'])){echo '

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="snap.php">Send</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $_SESSION['username'] . ' <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
             ' . '<li><a href="#" onclick="javascript: return false; this.preventDefault();">' . $points . " points</a></li>" . '
            <!--<li><a href="#">Another action</a></li>//-->
            <li class="divider"></li>
            <li><a href="login.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
    
    ';} ?>
    
  </div>
</nav>

<div class="container">
<?php echo $body; ?>
</div>

</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
</html>