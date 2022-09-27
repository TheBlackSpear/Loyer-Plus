<!DOCTYPE html>

<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <link rel="icon" href="public/front/loyerpluslogo/loyerplus.jpeg">

    <title><?php //=$title; ?></title>

    
   <!-- Jquery JqueryUi chosen core CSS -->

    <script src="public/front/jquery/jquery.3.3.1.min.js"></script>
    <link rel="stylesheet" href="public/front/jquery-ui/jqueryui1.12.1/jquery-ui.css">
    <link rel="stylesheet" href="public/front/jquery-ui/chosen_v1.8.7/chosen.min.css">

    <link rel="stylesheet" href="public/front/font-awesome-4.7.0/css/font-awesome.min.css">
   
    <!-- Bootstrap core CSS -->
    <link href="public/front/bootstrap-3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- CSS PERSO -->
    <link rel="stylesheet" type="text/css" href="public/front/perso/owncss.css">    

   <!-- <script src="public/jquery-ui/jquery1.12.4/jquery.min.js"></script>-->   
    <script src="public/front/jquery-ui/jqueryui1.12.1/jquery-ui.min.js"></script>
    <script src="public/front/jquery-ui/chosen_v1.8.7/chosen.jquery.min.js"></script>
<!-- ==================CSS JS SLIDE LOGO PARTENAIRE =================== -->
  <script src="public/logoslider/js/slick.js"></script>
  <link href="public/logoslider/css/slick.css" rel="stylesheet">
  <script src="public/logoslider/js/slick-event.js"></script>
<!-- =================!CSS JS SLIDE LOGO PARTENAIRE ==================== -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="public/front/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
  </head>

  <body>


  <!-- NAVBAR ============================= -->
  <div class="navbar-wrapper">
    <div class="container">

      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
              <div class="col-xs-2">
                <a class="navbar-brand" href="?p=loyerplus.index"><img src="public/front/loyerpluslogo/loyerplus.jpeg" width="60" height="30" alt="LOYER PLUS"></a>
              </div>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="?p=loyerplus.index" title="Accueil"><i class="glyphicon glyphicon-home"></i></a></li>
              <li><a href="?p=apropos.index" title="A Propos de Nous"><i class="fa fa-users"></i></a></li>              

              <?php if(isset($_SESSION['bailleur_id'])){ ?>
              <!-- bailleur connecte -->
              <li class="dropdown">
                <a href="?p=bailleur.index" title="Bailleur" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class=""></i>Bailleur <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="?p=bailleur.compteconnected" title="Mon compte"><i class=""></i> Mon Compte</a></li>
                  <li><a href="?p=logout.recrutclose" title="Déconnexion"><i class=""></i>Déconnexion</a></li>
                </ul>
              </li>
            <?php }else{?>
              <!-- bailleur deconnecte -->
              <li class="dropdown">
                <a href="?p=bailleur.index" title="Bailleur" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class=""></i>Bailleur <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="?p=bailleur.inscription" title="Créer un compte"><i class=""></i> Créer un Compte</a></li>
                  <li><a href="?p=bailleur.loginForm" title="Connexion"><i class=""></i>Connexion</a></li>
                </ul>
              </li>
              <?php }  ?>
              <?php if(isset($_SESSION['locataire_id'])){ ?>
              <!-- Locataire connecte -->
              <li class="dropdown">
                <a href="?p=locataire.index" title="Locataire" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class=""></i>Locataire <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="?p=locataire.compteconnected" title="Mon compte"><i class=""></i> Mon Compte</a></li>
                  <li><a href="?p=logout.accountclose" title="Déconnexion"><i class=""></i>Déconnexion</a></li>
                </ul>
              </li>
              <?php }else{?>
              <!-- Locataire deconnecte -->
              <li class="dropdown">
                <a href="?p=locataire.index" title="Locataire" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class=""></i>Locataire <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="" title="Créer un compte"><i class=""></i> </a></li>
                  <li><a href="?p=locataire.connexion" title="Connexion"><i class=""></i>Connexion</a></li>
                </ul>
              </li>
              <?php }  ?>
              <li><a href="?p=loyerplus.joinUs"><i class="fa fa-envelope"></i> Contacter Loyer-Plus</a></li> 
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </div>
  <div class="container" style="margin-top:70px; margin-bottom:70px;">
    <?=$content; ?>
  </div>
    <br>

    <style type="text/css">
      #go_to_top {
        position: fixed;
        width: 25px;
        height: 25px;
        bottom: 50px;
        right: 30px;
      }
    </style>
      <!-- FOOTER -->
    <footer class="footer footstyle">
      <div class="container">
        <p class="pull-right" id="go_to_top"><a href="#" title="Back to top"> <i class="glyphicon glyphicon-circle-arrow-up" style="font-size:50px;"></i></a></p>
        <p class="text-muted"><?=date("Y"); ?> &middot; LOYER PLUS</a>  &middot;<a href="" target="_blank">Politique de confidentialit&eacute;</a> &middot; <a href="" target="_blank">Conditions Générales d'Utilisation</a></p>
      </div>
    </footer> 



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="public/front/bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="public/front/js/ie10-viewport-bug-workaround.js"></script>

     <script type="text/javascript">
      $(".chosen").chosen();
    </script>
     </script>
</html>
