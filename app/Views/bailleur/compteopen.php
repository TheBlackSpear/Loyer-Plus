
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
					<li><a href="?p=bailleur.compteConnected">compte</a></li>
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
									            <div class="panel-title">MES DONNEES PERSONNELLES</div>
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
										              }
										              else if(isset($warningMSG)){
										          ?>
									            <div class="alert alert-warning" role="alert">
									                <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $warningMSG; ?></strong>
									                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									                    <span aria-hidden="true">&times;</span>
									                </button>
									            </div>
										          <?php
										              }
										              else if(isset($successMSG)){
										          ?>
								              	<div class="alert alert-success" role="alert">
								                  <strong><span class="glyphicon glyphicon-ok-sign"></span> <?php echo $successMSG; ?></strong>
								                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								                      <span aria-hidden="true">&times;</span>
								                  </button>
								              	</div>
										          <?php  }  ?>
										          <?php if (isset($lebailleur)): ?>				          								          
									            <form method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
										            <div class="form-group">
										                <label for="lastname" class="col-md-3 control-label">Nom de famille</label>
										                <div class="col-md-9">
										                    <input type="text" class="form-control" name="nomowner" placeholder="Nom de famille" value="<?=$lebailleur->nom_bailleurs; ?>" readonly>
										                </div>
										            </div>
										            <div class="form-group">
										                <label for="firstname" class="col-md-3 control-label">Pr&eacute;nom(s)</label>
										                <div class="col-md-9">
										                    <input type="text" class="form-control" name="prenomowner" placeholder="pr&eacute;nom(s)" value="<?=$lebailleur->prenoms_bailleurs; ?>" readonly>
										               	</div>
										            </div>
										            <div class="form-group">
										                <label for="email" class="col-md-3 control-label">Email</label>
										                <div class="col-md-9">
										                    <input type="email" class="form-control" name="mail_bailleur" placeholder="Adresse Email" value="<?=$lebailleur->mail_bailleurs; ?>" readonly>
										                </div>
										            </div>
										            <div class="form-group">
										                <label class="control-label col-md-3" for="contacts">Contacts</label>
										                <div class="col-md-9"><input name="phone_bailleur" type="text" placeholder="+225 00000000" class="form-control" id="contacts"value="<?=$lebailleur->phone_bailleurs; ?>" readonly></div>
										            </div>
										            <div class="form-group">
										                <label class="control-label col-md-3" for="pseudo">ID Unique du bailleur</label>
										                <div class="col-md-9"><input name="pseudonyme" type="text" placeholder="Votre pseudonyme" class="form-control" id="pseudo" value="<?=$lebailleur->iduniq_bailleurs; ?>" readonly></div>
										            </div>
										            <div class="form-group">
										            </div>
									            </form>
									            <?php endif ?>
				        					</div>
				    					</div>
									</div>
				    		</div>
	            </section>
          	</div><!-- /.blog-post -->
	        <nav>
	          <!-- <a href="?p=jobci.index" class="btn btn-primary">  &lsaquo;&lsaquo; Liste des offres</a> -->
	        </nav>
        </div><!-- /.blog-main -->
        <br>

      

    </div><!-- /.row -->
      

</div><!-- /.container -->