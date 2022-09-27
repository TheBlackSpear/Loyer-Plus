
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="infoci-favicon.ico">

    <title>Connexion</title>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
      body {
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #eee;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
  background: rgba(0, 67, 255 , 0.4);
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

    </style>

  </head>

  <body>

    <div class="container">

      <?php
          if(isset($errMSG)){
            ?>
              <div class="alert alert-danger" style="margin-top:10px;">
                <span class="fa fa-info-circle"></span> <strong><?php echo $errMSG; ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?php
            }elseif(isset($successMSG)){
          ?>
            <div class="alert alert-success" style="margin-top:10px;">
                  <strong><span class="fa fa-info-circle"></span> <?php echo $successMSG; ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
          </div>
      <?php  } ?>

    <form class="form-signin" method="post">
        <h4 class="form-signin-heading center">Réinitialisation du Mot de passe</h4>
        <label for="inputEmail" class="sr-only">Adresse Email </label>
        <label for="inputPassword" class="sr-only">Mot de Passe</label>
        <input type="password" id="inputPassword"  name="newpassword"  class="form-control" placeholder="Mot de Passe" required>
        <div class="form-group" id="affichemsg"></div>
        <label for="inptPassword" class="sr-only">Mot de Passe</label>
        <input type="password" id="inptPassword"  name="confpassword"  class="form-control" placeholder="Mot de Passe" required>
        <br><br>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="editnewpass">Envoyer</button>
    </form>

    </div> <!-- /container -->
    <br>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
