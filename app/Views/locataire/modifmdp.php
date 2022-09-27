
<!-- BEGIN PAGE TITLE/BREADCRUMB -->
<div class="parallax colored-bg pattern-bg" data-stellar-background-ratio="0.5">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">Modifier son mot de passe</h1>
				
				<ul class="breadcrumb">
					<li><a href="?p=loyerplus.index">Accueil </a></li>
					<li><a href="?p=locataire.compteConnected">Mon compte</a></li>
					<li><a href="#">Mot de Passe</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- END PAGE TITLE/BREADCRUMB -->
<hr>
<div class="content">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div  class="col-xs-12 col-sm-12 col-md-3 sidebar-offcanvas" id="sidebar">
		          <div class="list-group">
		            <a href="#" class="list-group-item">Bienvenue <b><?=$_SESSION['nom_locataire']; ?> </b></a>
		            <a href="?p=locataire.editMdp" class="list-group-item">Modifier mon mot de passe</a>
		            <a href="?p=locataire.bailleursListe" class="list-group-item">Mes bailleurs</a>
		            <a href="?p=locataire.mespayements" class="list-group-item">Mes payements</a>
		            <a href="?p=logout.accountclose" class="list-group-item text-center"><span style="font-weight:bold; color:#ce0823">DECONNEXION</span></a>
		          </div>
		        </div>
				<div  class="col-xs-12 col-sm-12 col-md-9">
			        <div class="panel panel-info">
			            <div class="panel-heading">
			               <div class="panel-title">MODIFICATION DU MOT DE PASSE</div>
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
			                <form method="post" enctype="multipart/form-data" class="form-horizontal" role="form"  onsubmit="return checkCheckBoxes(this);">
			                 	<div class="form-group">
			                        <label for="email" class="col-md-3 control-label">Email</label>
			                        <div class="col-md-9">
			                            <input type="text" class="form-control" name="votremail" placeholder="Adresse Email">
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <label for="login-password" class="col-md-3 control-label"> Ancien Mot de passe</label>
			                        <div class="col-md-9">
			                            <input type="password" id="login-password" class="form-control" name="ancmdp" placeholder="Ancien mot de passe">
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <label for="login-password" class="col-md-3 control-label">Nouveau Mot de passe</label>
			                        <div class="col-md-9">
			                            <input type="password" id="login-password" class="form-control" name="nouvmdp" placeholder="Nouveau mot de passe">
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <label for="password" class="col-md-3 control-label">Confirmation mot de passe</label>
			                        <div class="col-md-9">
			                            <input type="password" class="form-control" name="confnouvmdp" placeholder="Nouveau mot de passe">
			                        </div>
			                    </div>
			                    <div class="form-group">
			                                <!-- Button -->                                        
			                        <div class="col-md-offset-3 col-md-9">
			                            <button type="submit" id="submit_button" class="btn btn-primary" name="editpasse"><i class="icon-hand-right"></i> Envoyer </button>
			                        </div>
			                    </div>
			                </form>
			            </div>
			        </div> 
			    </div>
	    	</div>
	    </div>
    </div>
</div>


