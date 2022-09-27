<meta charset="utf-8">
  <?php
  if(isset($categname) && $categname!==false){
      $meta_descr=$categname->meta_description;

      $meta_author=$categname->nom_artisan;
      $meta_keywd=$categname->meta_kwdshop;
      $title="Categorie : " . ucfirst($categname->btkcateg_lib). "| Bothentik, Espace Promo de www.infoci.info ";
    }else{
      $meta_author="infoci.info | Kikoun Media ";
      $meta_keywd="Marchand-d-art, coiffeurs, ferronnier, peintre, Photographe, ébéniste, info ci, information ci, ivoire info, ci actu, ci actualité, news ivoire, actualité nationale côte d'Ivoire";
      $meta_descr="Des prestataires, artisans, spécialistes dans leur domaine sont disponibles dans notre catalogue. Consultez et trouvez satisfaction.";
      $title="Bothentik, Beau et Authentique | infoci.info - Liste de Prestataires de service";
  } 

    ?>

    <style type="text/css">
    	
    	@media (min-width: 767px) {
    		.listBlogArticle{height: 160px;}
    		.extraitBlogArticle{height: 110px;}
		}
		@media (max-width: 480px) {
			.listBlogArticle{height: 150px;}
			.extraitBlogArticle{height: 110px;}
		}
    </style>


<!DOCTYPE html>
<html>
  	<head>
     	<link rel="stylesheet" type="text/css" href="public/front/perso/stylebase.css">
     <!--  <link rel="stylesheet" type="text/css" href="apparence/css/sticky-footer.css"> -->
  	</head>
  	<body>

	   
	    <div class="main">
			<div class="container">
			    <div class="row">
			      <!-- Carousel================================================== -->
			      <div id="myCarousel" class="carousel slide" data-ride="carousel" style="max-width: 1150px;">  
			        <div class="carousel-inner" role="listbox">             
			          <div class="item active">
			            <img class="second-slide" src="app/Upload/image_fichiers/diapo_pic/banner_infoci.jpg" alt="Second slide" width="1150" height="300">
			          </div>
			          <?php  if(isset($thebanners) && !empty($thebanners)){foreach ($thebanners as $banner){?>
			            <div class="item">
			              <a href="<?=$banner->lcibanner_url; ?>">
			                <img class="first-slide" src="app/Upload/image_fichiers/immo_pic/<?=$banner->lcibannerpix; ?>" width="1150" height="300" alt="First slide">
			              </a>
			            </div>  
			          <?php }}else{}?> 
			        </div>
			        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			          <span class="sr-only">Previous</span>
			        </a>
			        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			          <span class="sr-only">Next</span>
			        </a>
			      </div><!-- /.carousel -->
			      <hr>
			    </div><!-- fin row carousel -->
			</div>

		  	<div class="container" style="min-height:480px;margin-top:15px;"> 
				    
			    <div class="row">
			      	<div class="col-sm-8 blog-main" style="margin-left:-4px; min-height:500px;">  
				        <div class="bs-example" data-example-id="thumbnails-with-custom-content">
					        <div class="row"> 
						        <div class="col-sm-12">	 
				    				<div class="col-sm-12"><?php if(isset($lemotcle) && $lemotcle==true){ ?>
				    					<ul class="breadcrumb">
				    						<li><a href="http://www.infoci.info/">Accueil </a></li>
				    						<li><a href="?p=bothentik.index">Bothentik</a></li> 
				    					</ul>
				    					<h4 class="page-title"> Resultats contenant le mot cle: <span style="color:#df1818;"><?=ucfirst($lemotcle); ?></span> </h4>
				    					<?php } ?>
				    				</div>
						        </div> 
					          	<div class="col-sm-12">

						          	<?php if(isset($errMSG)){ ?>  
						            <div class="alert alert-danger letexte" role="alert">
						               <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
						            </div>
						        	<?php } ?> 

						            <form method="post" action="?p=bothentik.shopByfiltre">
						            	<div class="form-group col-sm-8">
						              		<input type="text" name="motcleshop" placeholder="Saisir un mot clé pour trouver un prestataire..." class="form-control">
						              	</div>
						              	<div class="form-group col-sm-4">
						              		<input type="submit" name="chercheshop" class="btn btn-primary form-control" value="Rechercher">
						              	</div>
						            </form>
					          	</div>
						    </div>  
				          	<div class="row">
				            	<?php if(isset($bloglistcateg) && !empty($bloglistcateg)){ foreach ($bloglistcateg as $offreindiv){ //var_dump($total_records); ?>
					            <div class="col-sm-6 col-md-4">
					                <div class="thumbnail">

					                    <?php if($offreindiv->ph1==="image1.jpg"){ $image1="defaut.png"; ?>
					                    <a href="?p=bothentik.oneshop&coderef=<?=$offreindiv->idbtkartisan; ?>">
					                      <img alt="<?=$offreindiv->nom_artisan; ?>" src="..app/Views/infocishop/imgshop/<?=$image1; ?>" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">
					                    </a>
					                    <?php }else{ ?> 
					                    <a href="?p=bothentik.oneshop&coderef=<?=$offreindiv->idbtkartisan; ?>">
					                      <img alt="<?=$offreindiv->nom_artisan; ?>" src="app/Views/infocishop/imgshop/<?=$offreindiv->ph1; ?>" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">
					                    </a>
					                    <?php } ?>
					                  <div class="caption">
					                    <span style="font-size:1.1em; font-weight:bold;">
					                      <a href="?p=bothentik.oneshop&coderef=<?=$offreindiv->idbtkartisan; ?>" title="" rel="bookmark">
					                        <?=ucfirst(substr($offreindiv->nom_artisan, 0,20))."..."; ?>
					                      </a>
					                    </span> 
					                    <p>
					                      <ul class='list-group'>                                 
					                        <li class='list-group-item' style="border:0px solid #fff; padding:0px;"> 
					                          <span style="color:#c88127; font-weight:600;"><?=ucfirst($offreindiv->btkcateg_lib); ?></span>
					                        </li> 
					                        <li class='list-group-item' style="border:0px solid #fff; padding:0px;">
					                          <span style="color:#337ab7;">
					                            <i class="fa fa-map-marker"></i>
					                          </span> &nbsp; 
					                          <span style="color:#056213; font-weight:600;"> 
					                            <?=$offreindiv->zone_nom;?>
					                          </span>
					                        </li><hr>

					                        <li class='list-group-item' style="border:0px solid #fff; padding:0px;">
					                     <?php 

					                        $str = strip_tags(html_entity_decode($offreindiv->presentation));
					                        $lim = 100;

					                        if (mb_strlen($str,'UTF-8')>=$lim)
					                        {
					                           $detail_offre = mb_substr($str, 0, $lim-3, 'UTF-8').'..';
					                        }else{
					                          $lim = 80;
					                          $detail_offre = mb_substr($str, 0, $lim-3, 'UTF-8').'..';
					                        }
					                             //echo $str;
					                      ?>
					                      <?=$detail_offre; ?><br>
					                        </li>
					                      </ul>
					                    </p> 
					                    <p> 
					                      <a href="?p=bothentik.oneshop&coderef=<?=$offreindiv->idbtkartisan; ?>" class="btn btn-default btn-sm" role="button"> <i class="fa fa-plus"></i> Details...</a>
					                    </p> 
					                  </div> 
					                </div> 
					            </div>
				            	<?php } ?>        
					            <div class="row">
					              <?php if(isset($pageno) && isset($total_pages) && isset($lemotcle)){ ?>
					              <div class="col-md-12">
					                <ul class="pagination">
					                    <li><a href="?p=bothentik.shopByfiltre&prest=<?=$lemotcle; ?>&pageno=1">Debut</a></li> &nbsp;&nbsp;
					                    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
					                      <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?p=bothentik.shopByfiltre&prest=$lemotcle&pageno=".($pageno - 1); } ?>">Precedent</a>
					                    </li>&nbsp;&nbsp;
					                    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
					                          <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?p=bothentik.shopByfiltre&prest=$lemotcle&pageno=".($pageno + 1); } ?>">Suivant</a>
					                    </li>&nbsp;&nbsp;
					                    <li><a href="?p=bothentik.shopByfiltre&prest=<?=$lemotcle; ?>&pageno=<?php echo $total_pages; ?>">Fin</a></li>
					                  </ul>
					              </div> 
					              <?php } ?>
					            </div>
					            <?php }else{} ?>
					        </div> 
				        </div>
				        <br><br>


				        <hr style="border:1px #085f8a dashed;">
				        <div class="row">
				        </div>
			      	</div><!-- /.blog-main -->

			      	<div class="col-sm-4 blog-sidebar">
				        <div class="sidebar-module sidebox">

				          <h4 class="text-center">Categories shop</h4>
				          <p>
				            <ul class="categories">
				              <?php if(isset($shopcateg) && !empty($shopcateg)){foreach ($shopcateg as $categorieshop): ?>
				                <li><a href="?p=bothentik.allShopByCategorie&list=<?=$categorieshop->orderbtkcateg;?>"><?=ucfirst($categorieshop->btkcateg_lib);?> <span> </span></a></li>
				              <?php endforeach;}else{ echo "Liste des prestataires indisponible pour l'instant !";} ?>
				            </ul>            
				          </p>
				        </div>
				        <div class="sidebar-module sidebox">
				          <img src="app/Views/infocijob/pub/300X600.jpg" class="img-thumbnail text-center">
				        </div>
				        <div class="sidebar-module sidebox">
				          <h4 class="section-title text-center" style="color:#f01515;"><b>INFORMATIONS</b></h4>
				          <p style="font-size:1.2em; line-height:1.3em;"><b><i>Infoci</i></b> sélectionne les spécialistes qu'il vous faut et les ajoute à son catalogue-ci. Selon votre besoin trouvez le prestataire correspondant. Et <b>obtenez toujours satisfaction.</b> <br><span style="font-size:.9em;"> <i><b>Bothentik</b>, Quand c'est beau et authentique !</i></span></p>
				        </div>
			      	</div><!-- /.blog-sidebar -->
			    </div><!-- /.row -->
			</div> <!-- /container -->
		</div> 
  	</body>
</html>
