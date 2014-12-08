<?php
/*
Plugin Name: Osclass XML IMPORTER Universal
Plugin URI: http://www.webegenius.es
Description: Import ads From any XML.
Version: 0.1.0
Author: HASSAN KIBRIA
Author URI: http://www.webegenius.es
Short Name: Osclass XML IMPORTER Universal

*/
/*
To make this script is worked on your side , you should add your server connection

also change your table prefix , my table prefix is "os_" if your database table prefix is "any_" 
exm : :os_t_user to any_t_user


*/

error_reporting(0); 
ini_set("max_execution_time","64800000");//  control time limit
ini_set("memory_limit","500M");// image memory limit


       $connection = mysql_connect("localhost","root","");  // "hostname","username","password"
    
    if(!$connection){
        die("Connection is Error " .mysql_error());
    }
    
    $db_select = mysql_select_db("DATABASE_NAME",$connection);  // database name 
    
    if(!$db_select){
        die("Connection has error " .mysql_error());
    }

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>XML IMPORTER</title>
	<link rel="stylesheet" href="stylesheet.css" />
	<link rel="stylesheet" href="jquery.minimalect.css" />
	
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="jquery.minimalect.min.js"></script>
</head>
<body>	

        <script type="text/javascript">
            $(document).ready(function(){
            $("#user").hide();
			
         
			$("#start").blur(function(){
				var st = $("#start").val();
				if(isNaN(st)){
					alert("Porfavor, intrduzca numero");
				
				}
			})
				$("#finish").blur(function(){
				var fin = $("#finish").val();
				if(isNaN(fin)){
					alert("Porfavor, intrduzca numero");
				
				}
			})
				//fecha
			
			var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth()+1; //January is 0!
			var yyyy = today.getFullYear();
			var ho = today.getHours();
			var min = today.getMinutes();
			var sec = today.getSeconds();
			

			if(dd<10) {
				dd='0'+dd
			} 

			if(mm<10) {
				mm='0'+mm
			} 

			today = yyyy+'-'+mm+'-'+dd + " " + ho + ":" + min  + ":" + sec;
			// document.write(today);


			$("#today").val(today);
			
	//ajax input email
					
$("#email").minimalect({
		onchange: function(){
				$("#user").html("Bienvenido <span style='color:#48AA47'>" + $(".minict_wrapper ul").children(".selected").text()).show()+"</span>";
				            $("#user").show();
               
                
                $("#user_email").val($(".minict_wrapper ul").children(".selected").text());
				var rep = $(".minict_wrapper ul").children(".selected").attr("class").replace("minict_last","");
               rep = rep.replace("selected","");
               rep = rep.replace("minict_first","");
			   $("#user_name").val(rep);
			   
			
				
		}
	});	
			
        })
        </script>
		<div class="wrapper">
			<div class="header">
				<div class="logo">
					<a href='index.php'><img src="logo.png" alt="osclass xml importer" /></a>
				
				</div>
				<div class="header_text">
							<h2>Osclass XML IMPORTER <span> Universal</span></h2>
					<p> This is a simple script to import product to your Database.</p>
					
			
					<div class="log">
						<a href="logout.php">logout</a>

					</div>
					<div class="menu">
						<ul>
							<li><a href="index.php">Inicio(joyaria)</a></li>
							<li><a href="normal.php">General Xml</a></li>
							<li><a href="casaxmlanucios.php">Inmobiliaria Xml</a></li>
							<li><a href="vihiculesxmlanucios.php">Vihicules Xml</a></li>
						</ul>
					</div>
				</div>
			
			</div>
			
    
	
    <div class="main_area">
    
        <div class="main_left">
        
				<form action="" method="post">
				
				<input type="hidden" name="time" value="" id="today" />
				
						  <p>
						  <!-- xml url-->
							<label for="Xml Feed" class="feed_class" data-icon="u" >XML url  =</label>
							<input id="xml_id" size="60" name="xml_feed" required="required" type="text" placeholder=" xml url "/>
						  </p>

									
						<p>
		   <!-- xml title -->  
						   <label for="title" class="title" data-icon="u" >XML Titulo =</label>
							
							
							<input id="title_id"  size="60" name="title" required="required" type="text" placeholder="Title Tag"/>
						</p>
		 <!-- xml image -->  
						<p>
						
						<label for="image" class="image" data-icon="u" > XML imagen =  </label>
							
							
							<input id="image_id"  size="50"  name="image" required="required" type="text" placeholder="imagen tag "/>
						</p>
						
						
						   
						<p>
		  <!-- xml Description -->
							<label for="description" class="description" data-icon="u" > XML descripción = </label>
							
							
							<input id="description_id"  size="50" name="description" required="required" type="text" placeholder=" descripción tag"/>
						</p>
						 </p>
						
					   
							<label for="Price" class="price_cls" data-icon="u" >XML Precio = </label>
							<input id="price_id" name="price" required="required" type="text" placeholder="Precio Tag"/>
						</p>
				   
						<div class="counter">
							
							<label class="">Empezar Desde : </label>
							<input id="start" type="text" name="start" placeholder="1"/>
							
							<label class=""> Hasta : </label>
							<input id="finish" type="text" name="finish"placeholder="5"/>
							<br/>
							<span style="color:red">Este es un contador. ¿Cuántos elemento que desea importar a su base de datos?</span>
							<br/>
							<div id="counting">
							
								<?php echo"<h2 style='color:red'> Último contador empezar  desde  ".$_POST['start']." y hasta = ".$_POST['finish']."</h2><br/>"?>
						
							</div>
						</div>
				   
							   
							   
					  
						
						<h2>Esta información es para el usuario: </h2>
						<?php
						// category 
								$sql = "SELECT * from os_t_category_description";
										$res = mysql_query($sql);
						
						?>
						<h2>Nombre de la Categoría :</h2>
							<select name="my_cat">
							
								<option value="">Introduzca el nombre de la categoría : </option>
							
								<?php 
									while( $row= mysql_fetch_array($res)){
										
										
										echo "<option value='".$row['fk_i_category_id']."'>".utf8_encode($row['s_name'])."</option>";
										
									}
								   
								?> 
								
							   
							</select>

			  
						
					 
						 <p>
		 <!--Email-->
							<?php 
							
								$sql = mysql_query("SELECT * FROM os_t_user ORDER BY s_name ASC");
						  
									
								
							?>
							<h2>Información de usuario</h2>
							<p>Correo :</p>
						 <select id="email" name="id_user">
							
						   
									<option value="">Seleccionar Email de Usuario : </option>  
									
								  <?php     while($result= mysql_fetch_array($sql)){
									$emm =$result['s_email'];
									$un = $result['s_name'];
							?>
							   
							  <?php 
									echo "<option class='".utf8_encode($result['s_name'])."' value='".$result['pk_i_id']."'>".utf8_encode($result['s_email'])."</option>";
							  // while 
							 }
							  ?> 
							   
						 </select>
						 <?php 
						 
						 
						 ?>
							<p id="user"></p>
					   
						  <input type="hidden" name="user_name" id="user_name" value=""/> 
							<input type="hidden" name="email" id="user_email" value=""/> 
				<?php ?>
						  <input id="xml_form" type="submit" value="aplicar"/>
				</form>
				
        
        
        
        </div>
        
        <div class="main_right">
			<div class="advice">
				<h2>Consejo :</h2>
					<ul>
					
						<li> Usted tiene que insertar cada nombre de etiqueta (tag name) exactamente</li>
						<li> Cada vez haces una nueva importación xml, primer intento con uno o dos productos.</li>
						<li>Si, ves esta funciona, entonces intentas lo importación..</li>
						<li>El número de la importación del producto depende de la talla(tamaño) de la imagen xml, su límite de tiempo phpmyadmin y otros.</li>
						<li>Este script no se introduzca ningún elemento duplicado.</li>
						<li>Ver este vídeo, esto puede ayudarle.</li>
						
					</ul>
					
			
			</div>
            <div class="youtube">
			<iframe width="300" height="289" src="//www.youtube-nocookie.com/embed/K_G_6nrF7Bw" frameborder="0" allowfullscreen></iframe>
			</div>
			
        
        
        </div>
    
    
    </div>

      <?php
        
            if(isset($_POST['xml_feed'])){
			?>
			                <script type="text/javascript">
                    $("#counting").show();
                 </script>
              <?php   
                echo "<span style='color:#B70000'>Terminado!!!</span>";

            $category_xml  = array($_POST["xml_category"]); // category name--  XML
                            
            $category =  array($_POST["my_cat"]);  // category name-- DB
            
          
                           
       
       	$arr1 = $category_xml;  // category name ..from xml
		$arr2 = $category; 		// category name ..from database

			$xml = simplexml_load_file($_POST['xml_feed']);
          

			$counter = 0;		// $counter is for controlling or how many we needs to work 

			$id_category ="";
mysql_close($connection);
			foreach ($xml as $k) {
                $connection = mysql_connect("localhost","root","");  // "hostname","username","password"
        $db_select = mysql_select_db("DATABASE_NAME",$connection);
                        // $xml = simplexml_load_file($_POST["xml_feed"]);
         
         
                           // $xml =$_POST['xml_feed'];
                           	$contact_name = $_POST['user_name'];
                    		$contact_email =$_POST['email'];
                            
                            $user_id   =$_POST['id_user'];
                           
                           
                            $image_xml = $k->$_POST['image'];
                           
                            
                  
                            
                          
                            
                            $description_xml = $k->$_POST['description'];
                            $price = $k->$_POST['price'];
							
				
			if(isset($_POST['price'])){
				
				$price = $k->$_POST['price'];

				//123,12
				$price_pos = strpos($price, ',');   // get position
				$price_replace = str_replace(",","",$price);   //change , to ''
				$price_len =strlen($price_replace);
				$result = $price_len - $price_pos;
				
				?>
<?php if ($price_pos != false ): ?>
		<?php
				if($result ==2){
					$price = $price_replace . "0000";
				}elseif($result ==1){
					$price = $price_replace . "00000";
				}else{
					$price =  $price_replace . "000000";
				}
			?>
 <?php else: 

				
					$price = $price . "000000";
				
				

 endif ;

}

?>
			
				<?php 			//.....//
							
                       
                             $title_xml = $k->$_POST['title'];
                      






			if($counter >= $_POST['start'] && $counter < $_POST['finish']){
			  

 
       
         
						// category
						$cont = 0;
					
					
						
                         
								$sql = "SELECT * from os_t_category_description WHERE s_name='".$arr2[$cont]."'";
								$res = mysql_query($sql);
								/*$cons = mysql_fetch_array($res);
								$id_category=  $cons["fk_i_category_id"];*/
						
					
						//end category

						if(mysql_affected_rows() > 0){
						   
							$row = mysql_fetch_array($res);
							$id_category=  $cons["fk_i_category_id"];


						}else{
						
							$insertC = "INSERT INTO os_t_category_description (s_name) VALUES ('".mysql_real_escape_string($arr2[$cont])."')";
							mysql_query($insertC);
							$id_category = mysql_insert_id();

						}
							$cont++; //change name 
							
						//os_t_item_description
						
                        $replace_price =  str_replace(',','',$price_xml);
							 		$title ="SELECT * FROM os_t_item_description WHERE s_title='".$title_xml."'and s_description='".$description_xml."'";
      
						$title_query = mysql_query($title);
                        
                        
                        
                        
					if(mysql_affected_rows() > 0){
						$reseric = mysql_fetch_array($title_query);
				
				$sqleric = "UPDATE os_t_item SET i_price='$price', dt_pub_date='".$_POST["time"]."',dt_mod_date='".$_POST["time"]."' WHERE pk_i_id=".$reseric["fk_i_item_id"];
				mysql_query($sqleric);
				
						
						}else{ 
						  
	                
                    			 $item_insert = "INSERT INTO os_t_item (fk_i_user_id,fk_i_category_id,dt_pub_date,dt_mod_date,i_price,fk_c_currency_code,s_contact_name,s_contact_email,s_ip,b_premium,b_enabled,b_active,b_spam,b_show_email)
					 			VALUES ('".$_POST["id_user"]."','".$_POST['my_cat']."','".$_POST['time']."','".$_POST['time']."',".$price.",'EUR','".$_POST['user_name']."','".$_POST['email']."','::1','0','1','1','0','0')";
                           
                         
                           
						 mysql_query($item_insert) or die ("error no 1 ". mysql_error());				

							// title calling
						
							$tit_id = mysql_insert_id();



							$title_insert = "INSERT INTO os_t_item_description (fk_c_locale_code,s_title,s_description,fk_i_item_id) VALUES ('es_ES','".utf8_decode($title_xml)."','".utf8_decode($description_xml)."','".$tit_id."')";
							
							mysql_query($title_insert)  or die ("error no 2 ". mysql_error());	;
                            // inserting image url 
						
							$image = "INSERT INTO os_t_item_resource (fk_i_item_id,s_path,s_extension,s_content_type) VALUES ('".$tit_id."','oc-content/uploads/','jpg','image/jpeg')";
                            mysql_query($image)   or die ("error no 3 ". mysql_error());	
                            // location of image 
                            $id_imagen = "../oc-content/uploads/"; //image upload destination
                            
                            $id_imagen .= mysql_insert_id() . "_original.jpg";
                           
                           
							
                              $imagen = explode("?",$image_xml);
                            $ruta = substr($imagen[0], 0, -5 ); // delete un-necessary part,

                            $archivo = file_get_contents($ruta);  // read image 
                            $aa = fopen ($id_imagen, "w+");  //
                            fwrite($aa, $archivo);
                            fclose($aa);
							
							
							$filename = $id_imagen;
							
							// Get new sizes
							list($width, $height) = getimagesize($filename);
							$newwidth = 640;
							$newheight = 480;

							// Load
							$thumb = imagecreatetruecolor($newwidth, $newheight);
							$source = imagecreatefromjpeg($filename);

							// Resize
							imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

							// Output and free memory
							//the resized image will be 400x300
							imagejpeg($thumb, "../oc-content/uploads/". mysql_insert_id() . ".jpg" );
							imagedestroy($thumb);
							
							list($width, $height) = getimagesize($filename);
							$newwidth = 480;
							$newheight = 340;

							// Load
							$thumb = imagecreatetruecolor($newwidth, $newheight);
							$source = imagecreatefromjpeg($filename);

							// Resize
							imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

							// Output and free memory
							//the resized image will be 400x300
							imagejpeg($thumb, "../oc-content/uploads/". mysql_insert_id() . "_preview.jpg" );
							imagedestroy($thumb);
							
							list($width, $height) = getimagesize($filename);
							$newwidth = 240;
							$newheight = 200;

							// Load
							$thumb = imagecreatetruecolor($newwidth, $newheight);
							$source = imagecreatefromjpeg($filename);

							// Resize
							imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

							// Output and free memory
							//the resized image will be 400x300
							imagejpeg($thumb, "../oc-content/uploads/". mysql_insert_id() . "_thumbnail.jpg" );
							imagedestroy($thumb);

						}	
				
			} // count == 22
			$counter++;			
				mysql_close($connection);
			}    
                 ?>
                 

                 <?php
                            
             }?>
             
				<div class="footer">
				
					<h2>&copy; www.webegenius.es | the best Web solutions </h2>
					
				</div>
			 

        
        	</div>
</body>
</html>

<?php 
// Before add any large number of listing on your side, You should test with 4 or 5 advertise(add list). 
	
?>



