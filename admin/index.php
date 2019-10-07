<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Jakomita</title>
    <link href="css/materialicons/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="../js/jquery.js"></script>
    <link href="css/materialize.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="css/style.css" media="all" rel="stylesheet" type="text/css" />
    <script src="js/materialize.min.js"></script>

</head>
<body>
<form class="signin" style="margin-top: 130px">
  <h5 class="center">Admin Sign In</h5>
  <div class="row center-align">
    <div class="input-field s12" >
      <input placeholder="Username" type="text" name="username" required id="username">
    </div>
    <div class="input-field s12" >
      <input placeholder="password" type="password" name="passkey" required id="password">
    </div>
    <div class="center" id="available"></div>
    <div class="input-field s12" >
      <input class="btn brown" type="submit" id="submit" value="LOG IN">
    </div>
  </div>
</form>
<!-- <script type="text/javascript">
  var showme = typeOf(typeOf(1));
  alert(showme);
</script> -->
<script src="js/login.js"></script>
</body>
</html>