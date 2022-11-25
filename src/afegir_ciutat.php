<html>
 <head>
 	<title>Afegir Ciutat</title>
 	<style>
 		body{
 		}
 		table,td {
 			border: 1px solid black;
 			border-spacing: 0px;
 		}
 	</style>
 </head>
 
 <body>
 	<h1>Afegir Ciutat</h1>
 
 	<?php
 		$conn = mysqli_connect('127.0.0.1','admin','admin123');
 		mysqli_select_db($conn, 'world');
 		$consulta = "SELECT * FROM country;";
 		$resultat = mysqli_query($conn, $consulta);
 		if (!$resultat) {
     			$message  = 'Consulta invàlida: ' . mysqli_error($conn) . "\n";
     			$message .= 'Consulta realitzada: ' . $consulta;
     			die($message);
 		}
 	?>
 
    <form action="" method="POST">
 	<label for="codi_pais">Escull un país:</label>
 	<select name="codi_pais" id="codi_pais">

 	<?php
 		
 		while( $registre = mysqli_fetch_assoc($resultat) )
 		{
            echo "<option value=".$registre["Code"].">".$registre["Name"]."</option>";
 		}
 	?>

    </select><br><br>
    <label for="nom_ciutat">Ciutat:</label><br>
    <input id="nom_ciutat" type="text" name="nom_ciutat"><br><br>
    <label for="poblacio">Població:</label><br>
    <input type="number" name="poblacio" id="poblacio"><br><br>
    <input type="submit" name="submit" id="submit">
    </form>

    <?php
        if(isset($_POST["submit"])){
            $query = "select * from city where name= '".$_POST["nom_ciutat"]."' and CountryCode= '".$_POST["codi_pais"]."';";
            $resQuery = mysqli_query($conn, $query);
            $filesQuery = mysqli_num_rows($resQuery);
        if($filesQuery > 0){
            echo "<div class='missatge'>Aquesta ciutat ja existeix en aquest país</div>";
        }
        else{
            $queryInsert = "INSERT INTO city (Name,CountryCode,Population) values('".$_POST["nom_ciutat"]."','".$_POST["codi_pais"]."',".$_POST["poblacio"].");";
            $resultat = mysqli_query($conn, $queryInsert);
            if($resultat){
                echo "<div class='missatge'>Ciutat afegida correctament</div>";
            }
        }
        }
    ?>

    <a href="index.php">Tornar a l'inici</a>

 </body>
</html>