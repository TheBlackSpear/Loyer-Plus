
<?php /**
* Author:Alain KIKOUN 
**/ ?>
<head>
    <link rel="stylesheet" type="text/css" href="public/front/bootstrap-3.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="public/front/bootstrap-3.3.7/dist/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="public/front/perso/stylebase.css">
   <!--  <link rel="stylesheet" type="text/css" href="apparence/css/sticky-footer.css"> -->
</head>
<!-- BEGIN PAGE TITLE/BREADCRUMB -->
<div class="parallax colored-bg pattern-bg" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="page-title">Mon Compte</h1>        
		<ul class="breadcrumb">
			<li><a href="?p=loyerplus.index">Accueil </a></li>
			<li><a href="?p=bailleur.compteconnectedx">compte</a></li>
			<li><a href="#">Modifier Infos maison</a></li>
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
            <b><?=$_SESSION['bailleur_id']; ?></b> 
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
                   <div class="panel-title">FIN DU CONTRAT DE BAIL</div>
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
                   } else if(isset($warningMSG)){
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
	                      <label class="col-md-3 control-label">LOCATAIRE</label>
	                      <div class="col-md-9">
	                          <input type="text" class="form-control" name="locataire" value="<?=$oneInfo->nom_locataires; ?> <?=$oneInfo->prenom_locataires; ?>" readonly>
	                      </div>
	                    </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Référence Unique du LOCATAIRE</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" name="ru_locataire" placeholder="Libelle de l'offre" value="<?=$oneInfo->iduniq_locataires; ?>" readonly>
                        </div>
                      </div>
	                    <div class="form-group">
	                      <label class="col-md-3 control-label">Ma Propriété</label>
	                      <div class="col-md-9">
	                        <input type="text" class="form-control" value="<?=$oneInfo->porte_num_pat;?>" readonly>
	                      </div>
	                    </div> 
	                    <div class="form-group">
	                      <label for="fin" class="col-md-3 control-label">Date de fin de bail</label>
	                      <div class="col-md-9">
	                        <input type="date" name="lastdate" class="form-control" id="fin">
	                      </div>
	                    </div>                   

	                    <div class="form-group">
	                      <!-- Button -->
	                        <div class="col-xs-12 col-sm-12 col-md-12">
	                          <button id="btn-signup" type="submit" class="btn btn-success btn-block" name="editlocataire"><i class="fa fa-save"></i> Valider </button>
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
    </div><!-- /.blog-main -->
    <br>

  </div><!-- /.row -->
  

</div><!-- /.container -->