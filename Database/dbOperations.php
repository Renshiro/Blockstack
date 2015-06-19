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

    function setHighscore(var score, var name){
        // Abfrage an Datenbank
        $result = mysql_query("SELECT * FROM `highscore` Order by score Desc Limit 10;");
        
        $rank = 1;
        
        while ($row = mysql_fetch_object($result)) {
            $bool = false;
            if(score >= .$row->score.){
                $bool = true;
            }
            $rank ++;
        }
        
        if($bool) {
            $query = "INSERT INTO highscore ('name', 'score') VALUES (NULL, $score)";
        } else {
            $$query = "SELECT 'id' FROM 'highscore' Where 'score' = $score";
        }
        
        $result = mysql_query($query);
        
        //$result = mysql_query("INSERT INTO highscore ('name', 'score') VALUES (NULL, $score)");
        
        //$score_id = mysql_query("SELECT 'id' FROM 'highscore' Where 'score' = $score");
        
        //return score_id;
    }
?>