
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
			<li><a href="">Accueil </a></li>
			<li><a href="?p=bailleur.compteConnected">Compte</a></li>
			<li><a href="#">Détails sur ma maison</a></li>
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
                   <div class="panel-title">LECTURE CETTE OFFRE</div>
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
	                      <label class="col-md-3 control-label">Libelle de l'offre</label>
	                      <div class="col-md-9">
	                          <input type="text" class="form-control" name="titreof" placeholder="Libelle de l'offre"  value="<?=$oneInfo->offrelabel; ?>" readonly>
	                      </div>
	                    </div>
	                    <div class="form-group">
	                      <label class="col-xs-4 col-sm-3 col-md-3 control-label">Type de contrat </label>
	                      <div class="col-xs-8 col-sm-9 col-md-9">
	                        <select class="form-control chosen" name="lecontrat" readonly>
	                        	<option value="<?=$oneInfo->typecontrat;?>"><?=$oneInfo->jobtypelabel; ?></option>
	                          	<optgroup label="CHOISIR LE TYPE DE CONTRAT">

		                            <?php 
		                            foreach ($typcontract as $contrat) {          
		                             ?>
		                          	<option value="<?=$contrat->orderjobtype;?>"><?=$contrat->jobtypelabel;?></option>
		                          	<?php }  ?>
	                          	</optgroup>
	                        </select>
	                      </div>
	                    </div>
	                    <div class="form-group">
	                      <label class="col-xs-4 col-sm-3 col-md-3 control-label">Niveau de formation (Etude) </label>
	                      <div class="col-xs-8 col-sm-9 col-md-9">
	                        <select class="form-control chosen" name="niveaudetude" readonly>
	                        	<option value="<?=$oneInfo->orderjobnivo;?>"><?=$oneInfo->nivolabel;?></option>
	                          	<optgroup label="CHOISIR LE NIVEAU D'ETUDE">
		                            <?php 
		                            foreach ($nivoetude as $etude) {          
		                             ?>
		                          	<option value="<?=$etude->orderjobnivo;?>"><?=$etude->nivolabel;?></option>
		                          	<?php }  ?>
	                          	</optgroup>
	                        </select>
	                      </div>
	                    </div>
	                    <div class="form-group">
	                      <label class="col-xs-4 col-sm-3 col-md-3 control-label">Domaine d'activité </label>
	                      <div class="col-xs-8 col-sm-9 col-md-9">
	                        <select class="form-control chosen" name="categoriepro" readonly>
	                        	<option value="<?=$oneInfo->orderjobcategpro;?>"><?=utf8_encode($oneInfo->nomcategpro);?></option>
	                          	<optgroup label="CHOISIR LE DOMAINE D'ACTIVITE">
		                            <?php 
		                            foreach ($jobdomain as $domaine) {          
		                             ?>
		                          	<option value="<?=$domaine->orderjobcategpro;?>"><?=utf8_encode($domaine->nomcategpro);?></option>
		                          <?php }  ?>
	                          	</optgroup>
	                        </select>
	                      </div>
	                    </div>
	                    <div class="form-group">
	                      <label class="col-md-3 control-label">Lieu du poste</label>
	                      <div class="col-md-9">
	                          <input type="text" class="form-control" name="localite" placeholder="Zone geographique du poste" value="<?=$oneInfo->lieujob;?>" readonly>
	                      </div>
	                    </div>
	                    <div class="form-group">
	                      <label class="col-md-3 control-label">Experience professionnelle</label>
	                      <div class="col-md-9">
	                          <input type="number" class="form-control" name="experience" placeholder="Expérience professionnelle" value="<?=$oneInfo->experience;?>" readonly>
	                      </div>
	                    </div>
	                    <div class="form-group">
	                      <label class="control-label col-md-3">Détails sur l'offre</label>
	                      <div class="col-md-9">
	                      	<?=htmlspecialchars_decode($oneInfo->contenu_offre) ;?>
	                      </div>
	                    </div>
	                    <div class="form-group">
	                      <label for="fin" class="col-md-3 control-label">Date Limite</label>
	                      <div class="col-md-9">
	                        <input type="date" name="finir" class="form-control" id="fin" value="<?=$oneInfo->expire_le;?>" readonly>
	                      </div>
	                    </div>
	                    <div class="form-group">
	                      <!-- Button -->                                        
	                      <div class="col-md-offset-3 col-md-9">
	                        <div class="col-xs-12 col-sm-12 col-md-6">
	                          <a href="?p=jobrecruteurci.compteConnected" class="btn btn-primary btn-block"><i class="fa fa-backward" aria-hidden="true"></i> Mon Compte</a>
	                        </div>
	                        <div class="col-xs-12 col-sm-12 col-md-6">
	                          <a href="?p=jobrecruteurci.majOffre&suitable=<?=$oneInfo->idjoboffre;?>" class="btn btn-info btn-block" name="editjob"><i class="fa fa-save"></i> Modifier </a>
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