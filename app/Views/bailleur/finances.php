
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
          <li><a href="?p=bailleur.compteConnected">compte</a></li>
          <li><a href="#">Mes locataires</a></li>
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
            <div class="col-md-12 col-sm-12 col-xs-12" style="overflow: scroll;">       
                 <?php
                    if(isset($warningMSG)){
                  ?>
                        <div class="alert alert-warning" style="margin-top:10px;">
                          <span class="fa fa-info-circle"></span> <strong><?php echo $warningMSG; ?></strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                  <?php
                      }
                  ?>
                      
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th colspan="8" class="text-center">
                    <b>Mes Finances</b>
                  </th>
                </tr>
                <tr>
                  <th class="text-center" scope="row">#</th>
                  <th class="text-center" scope="row">Nom</th>
                  <th class="text-center" scope="row">Prénoms</th>
                  <th class="text-center" scope="row">Téléphone</th>
                  <th class="text-center" scope="row">Date d'entrée</th>
                  <th colspan="3" class="text-center" scope="row">ACTION</th>
                </tr>
              </thead>
              <tbody>
                <?php if(isset($locataireListe) && !empty($locataireListe)){ foreach ($locataireListe as $offreindiv) { //var_dump($offreindiv);?>
                <tr>
                  <td class="text-center" ><?=$offreindiv->idlocataires; ?></td>
                  <td class="text-center" ><?=$offreindiv->nom_locataires; ?></td>
                  <td class="text-center" ><?=$offreindiv->prenom_locataires; ?></td>
                  <td class="text-center" ><?=$offreindiv->phone_locataires; ?></td>
                  <td class="text-center" > <?=$offreindiv->first_date; ?></td>
                  <td class="text-center" ><a href="?p=bailleur.readMoreLocataire&suitable=<?=$offreindiv->iduniq_locataires; ?>" title="Lire plus"><i class="fa fa-search" aria-hidden="true"></i> lire</a></td>
                  <td class="text-center" ><a href="?p=bailleur.majLocataire&suitable=<?=$offreindiv->iduniq_locataires; ?>" title="Mettre à jour"><i class="fa fa-edit" aria-hidden="true"></i> modifier</a></td>
                  <td class="text-center" ><a href="?p=bailleur.delete&suitabledel=<?=$offreindiv->iduniq_locataires; ?>" title="Supprimer" onclick="return confirm('Voulez-vous supprimer ce contenu ?')"><i class="fa fa-trash" aria-hidden="true"></i> supprimer</a></td>
                </tr> 
              <?php }}else{}?>              
              </tbody>
            </table>
              <?php if(isset($pageno) && isset($total_pages)){ ?>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <ul class="pagination">
                  <li><a href="?p=bailleur.listLocataire&pageno=1">Debut</a></li> &nbsp;&nbsp;
                  <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                      <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?p=bailleur.listLocataire&pageno=".($pageno - 1); } ?>">Precedent</a>
                  </li>&nbsp;&nbsp;
                  <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?p=bailleur.listLocataire&pageno=".($pageno + 1); } ?>">Suivant</a>
                  </li>&nbsp;&nbsp;
                  <li><a href="?p=bailleur.listLocataire&pageno=<?php echo $total_pages; ?>">Fin</a></li>
                </ul>
              </div> <?php } ?>
            </div>
              <br><br>
          </div>
        </section>
      </div><!-- /.blog-post -->
    </div><!-- /.blog-main -->
    <br>

  </div><!-- /.row -->
</div><!-- /.container -->