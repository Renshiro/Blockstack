<?php
	include "dbAccess.php";

	function getTopTenTable(){
		// Abfrage an Datenbank
		$result = mysql_query("SELECT * FROM `highscore` Order by score Desc Limit 10;");	
		// Den Rang initialisieren
		$rank = 1;		
		//Ergebnisse durchgehen	
		while ($row = mysql_fetch_object($result)) {
			echo '
			<tr>
			  <td>'.$rank.'</td>
			  <td>'.$row->name.'</td>
			  <td>'.$row->score.'</td>
			</tr>
			';
			$rank++;
		}				
	}
?>