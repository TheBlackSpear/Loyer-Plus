<!DOCTYPE html>
<html>
	<head>
	    <link rel="stylesheet" type="text/css" href="public/front/perso/stylebase.css">
 		<style type="text/css">

			.lead {
			  margin-bottom: 20px;
			  font-size: 0px;
			  font-weight: 300;
			  line-height: 1.4; 
			  font-size: 12px;
			}
			@media (min-width: 768px) {
			  .lead {
			    font-size: 16px;
			  }
			}
			.buttonrounded{
					border-radius:12px;
					padding-left:5px;
					padding-right:5px;
				}
			.isize{font-size: 12px;}

		   .well{
			background-color: #5f8ad8;
		    color: white;
			border: 1px dashed #cdd2f5;
		    padding: 19px;
		    border-radius: 4px;
		    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
		    box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
		    margin-bottom: 20px;
			}
			.carousel{
				max-width: 1140px;
			}
			body{background-color: rgb(255, 255, 255);}
			.rubric-title{
				font-weight: bold;
				font-style: italic;
				color:red ;
				text-decoration: underline;
				margin-top: 10px;
			}
		  .welle{
		    background-color: #5f8ad8;
		      color: white;
		    border: 1px dashed #cdd2f5;
		    padding: 10px;
		    border-radius: 4px;
		    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
		    box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
		    margin-bottom: 5px;
		  }
		</style>
	</head>
	<body>

		<div class="main">
			<div class="container">
				<div class="row">
				    <!-- Carousel================================================== -->
				    <div id="myCarousel" class="carousel slide" data-ride="carousel" style="max-width: 1140px;">   
					    <div class="carousel-inner" role="listbox"> 		        
					        <div class="item active">
					          <img class="second-slide" src="app/Upload/image_fichiers/diapo_pic/banner_infoci.jpg" alt="Second slide" width="1140" height="329">
					        </div>
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
				</div><!-- fin row carousel -->




			    <br><br> 
			    <!-- =======TEXTE DEFILANT================= -->
			    	<style type="text/css">

		          .marquee-rtl {
		            max-width: 100%;                      /* 70em; largeur de la fenêtre */
		            margin: 1em auto 2.5em;
		            font-size: 20px;
		            border: 4px solid #F0F0FF;
		            overflow: hidden;                     /* masque tout ce qui dépasse */
		            box-shadow: 0 .25em .5em #CCC,inset 0 0 1em .25em #CCC;
		          }

		          .marquee-rtl:hover > :first-child {
		          	cursor: pointer;
		            font-size: 20px; 
		            /*animation: defilement-rtl paused linear;*/
		          }

		          .marquee-rtl > :first-child {
		            display: inline-block;                /* modèle de boîte en ligne */
		            padding-right: 2em;                   /* un peu d'espace pour la transition */
		            padding-left: 100%;                   /* placement à droite du conteneur */
		            white-space: nowrap;                  /* pas de passage à la ligne */
		            animation: defilement-rtl 30s infinite linear;
		          }
		          @keyframes defilement-rtl {
		            0% {
		              transform: translate3d(0,0,0);      /* position initiale à droite */
		            }
		            100% {
		              transform: translate3d(-100%,0,0);  /* position finale à gauche */
		            }
		          }
		        </style> 

	        <?php  if(isset($flashs) && !empty($flashs)){ ?>
	          <div class="row">
	            <div class="col-md-12">
	              <hr style="border:1px #085f8a dashed;">              
	              <div class="col-sm-12">
	                <div class="marquee-rtl"> 
	                  <div class="marquee">
	                    <?php 
	                      foreach ($flashs as $informations){
	                    ?>
	                      <span style="color: #df4a43; font-weight: bold;"><?=$informations->flash_title;?> :</span> <span style="color: #07026b;"> <?=$informations->flash_content;?>&nbsp;&nbsp;</span> 
	                      <?php } ?>
	                  </div>
	                </div>   
	              </div>
	            </div>
	          </div>
	        <?php } ?>


			</div>
			<hr>
			<style type="text/css">

				.plusinfo {
				    display: inline-block;
				    width: 125px;
				    background-color: rgb(44, 153, 16);
				    font-weight: 600;
				    font-style: italic;
				    color: rgb(255, 255, 255);
				    font-size: 0.9em;
				    border-radius: 10px;
				    padding: 5px;
				    margin: 10px;
				    text-align: center;
				}

				.plusinfo a{
					text-decoration: none;
					color:rgb(255, 255, 255);
				}

			</style>
			<br>
			<div class="container" style="margin-top:15px;">
			  	<div class="row" style="margin-left:-4px;min-height:480px;">
				    <div class="col-md-12 col-xs-12 " style="margin-left:-4px; min-height:480px;">
						<div class="row">
						    <div class="col-md-6 col-xs-12" data-example-id="default-media">
						      <h4 class="rubric-title">Accéder à l'espace Bailleur</h4>	
					            <div class="joboxbref col-md-12 col-xs-12" style="border:0.7px #f00 solid;"> 
					              	<div class="media-body"> 
								        <div class="col-md-12 col-xs-12 text-center">
								        	<a href="?p=bailleur.inscription">
								        	  <button class="col-md-12 btn btn-lg btn-success" style="background-color: #f0ba28; color: #000;">
								        	   	Bailleur &raquo; 
								        	 	</button>
								        	</a>
								        </div> 
					              	</div> 
					            </div>
						    </div>
						    <div class="col-md-6 col-xs-12" data-example-id="default-media">
						      <h4 class="rubric-title">Accéder à l'espace Locataire</h4>
					            <div class="joboxbref col-md-12 col-xs-12" style="border:0.7px #f00 solid;">
					              	<div class="media-body"> 
								        <div class="col-md-12 col-xs-12 text-center">
								        	<a href="?p=locataire.connexion">
								        	  	<button class="col-md-12 btn btn-lg btn-primary">
								        	   		Locataire &raquo; 
								        	 	</button>
								        	</a>
								        </div> 
					              	</div> 
					            </div>
						    </div>
						</div>
						<br><br>
		  			</div> <!--/colonne de 12 blog main -->
				</div>  <!--/row -->
			</div> <!--/container -->

		</div>      
	</body>
</html>