<?php
	include "dbAccess.php";    

	if($_POST["par"] == "topTen"){
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

    if($_POST["par"] == "writeData"){
        // Abfrage an Datenbank
        $result = mysql_query("SELECT * FROM `highscore` Order by score Desc Limit 10;");
        
        $rank = 1;
        $score = $_POST["score"];        
        $bool = true;
        
        while ($row = mysql_fetch_object($result)) {
            $bool = false;
            if($score >= $row->score){
                $bool = true;
                break;
            }
            $rank ++;
        }
        
        if($bool) {
            $query = "INSERT INTO highscore (name, score) VALUES ('', $score)";
        } else {
            $query = "SELECT 'id' FROM 'highscore' Where 'score' = $score";
        }
        
        $result = mysql_query($query);
        
        //$result = mysql_query("INSERT INTO highscore ('name', 'score') VALUES (NULL, $score)");
        
        //$score_id = mysql_query("SELECT 'id' FROM 'highscore' Where 'score' = $score");
        
        //return score_id;
    }
?>