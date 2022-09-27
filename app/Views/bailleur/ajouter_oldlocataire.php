
<head>
    <link rel="stylesheet" type="text/css" href="public/front/bootstrap-3.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="public/front/bootstrap-3.3.7/dist/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="public/front/perso/stylebase.css">
</head>
<!-- BEGIN PAGE TITLE/BREADCRUMB -->
<div class="parallax colored-bg pattern-bg" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="page-title">Mon Compte</h1>
        
        <ul class="breadcrumb">
          <li><a href="">Accueil </a></li>
          <li><a href="?p=bailleur.index">compte</a></li>
          <li><a href="#">Mon Compte</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- END PAGE TITLE/BREADCRUMB -->
<hr>


<div class="container" style="min-height:480px;">

  <!-- si recruteur connecte Afficher son compte sinon Texte BREF Conditions et Form connexion ou Form inscription-->
  <div class="row">
    <div class="col-sm-12 blog-main">
      <div class="blog-masthead">
        <div class="container">
          <nav class="blog-nav">
            <a href="?p=logout.recrutclose" class="blog-nav-item"><span style="font-weight:bold; font-size:18px; color:#ce0823"><i class="fa fa-sign-out"></i></span></a> 
            <a href="?p=bailleur.compteConnected" class="blog-nav-item">
            <b><?=$_SESSION['bailleur_nom']; ?></b> 
            </a>
            <a class="blog-nav-item" href="?p=bailleur.editMdp">Mot de passe</a>
            <a class="blog-nav-item" href="?p=bailleur.plusMaison">Ajouter une maison</a>
            <a class="blog-nav-item" href="?p=bailleur.plusLocataire">Ajouter un locataire</a>
            <a class="blog-nav-item" href="?p=bailleur.listMaison">Mes Maisons</a>
            <a class="blog-nav-item" href="?p=bailleur.listLocataire">Mes Locataires</a>
            <a class="blog-nav-item" href="?p=bailleur.finance">Mes Finances</a>
          </nav>
        </div>
      </div>
      <div class="blog-post">
        <section class="jobox">
          <div  class="col-md-12 col-sm-12 col-xs-12">
            <div class="col-md-12 col-sm-12 col-xs-12">       
              <div class="panel panel-info">
                <div class="panel-heading">
                   <div class="panel-title">Ajouter un locataire</div>
                </div>  
                <div class="panel-body">

                  <?php
                  if(isset($errMSG)){
                  ?>  
                  <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
                    
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                 <?php
                   }elseif(isset($warningMSG)){
                  ?>
                    <div class="alert alert-warning" role="alert">
                      <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $warningMSG; ?></strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  <?php
                    }else if(isset($successMSG)){
                  ?>
                  <div class="alert alert-success" role="alert">
                      <strong><span class="glyphicon glyphicon-ok-sign"></span> <?php echo $successMSG; ?></strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <?php  }  ?>
                  <form method="post" enctype="multipart/form-data" class="form-horizontal" role="form"  onsubmit="return checkCheckBoxes(this);">
                    
                    <div class="form-group">
                      <label class="col-md-3 control-label">Référence Unique Locataire</label>
                      <div class="col-md-9">
                          <input type="text" class="form-control" name="rul_locataire" placeholder="Référence Unique du locataire">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">Date d'entrée</label>
                      <div class="col-md-9">
                          <input type="date" class="form-control" name="date_entree" placeholder="Date d'entrée">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-xs-4 col-sm-3 col-md-3 control-label">Numéro de porte attribuée</label>
                      <div class="col-xs-8 col-sm-9 col-md-9">
                        <select class="form-control chosen" name="idmaison">
                          <optgroup label="Maison affectée">
                            <?php 
                            foreach ($portevidee as $etude) {          
                             ?>
                          <option value="<?=$etude->iduniq_pat;?>"><?=$etude->porte_num_pat;?></option>
                          <?php }  ?>
                          </optgroup>
                        </select>
                      </div>
                    </div>
                    <?php 
                      //  var_dump($portevidee);
                     ?>                   

                    <div class="form-group">
                      <!-- Button -->                                        
                      <div class="col-md-offset-3 col-md-9">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <a href="?p=bailleur.compteConnected" class="btn btn-primary btn-block"><i class="fa fa-backward" aria-hidden="true"></i> Mon Compte</a>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <button id="btn-signup" type="submit" class="btn btn-success btn-block" name="oldlocataire"><i class="fa fa-save"></i> Ajouter </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div><!-- /.blog-post -->
      <nav>
        <a href="?p=bailleur.plusLocataire" class="btn btn-primary">Locataire sans compte</a>
      </nav>
    </div><!-- /.blog-main -->
    <br>

  </div><!-- /.row -->
  

</div><!-- /.container -->