<!DOCTYPE html>
<html>
    <?php
        include 'header.php';
        include '../Database/dbAccess.php';

        if(isset($_POST['submit'])){
             mysql_query( "INSERT INTO highscore (name, score) VALUES ('".$_POST['name']."', ".$_POST['scoreTitle3'].")"); 
        }
    ?>
    <body style="overflow:hidden">      
        <div id="menu" style="height:100%;">
            <div class="row" style="height:20%">
				<div class="small-12 columns text-center"> 
					<h1>Blockstack</h1> 
				</div>
			</div>

			<div class="row"  style="height:60%">
				<div class="small-12 columns text-center"> <span id="Game" class="button round" onclick="loadPage('game.php', false)">Play Game</span> </div>
				<div class="small-12 columns text-center"> <span id="How2Play" class="button round" onclick="loadPage('how2play.php', true)">How To Play</span> </div>
				<div class="small-12 columns text-center"> <span id="Highscores" class="button round" onclick="loadPage('highscore.php', true)">Highscores</span> </div>
				<div class="small-12 columns text-center"> <span id="Credits" class="button round" onclick="loadPage('Credits.php', true)">Credits</span> </div>
			</div>        				
			
        </div>
        <div id="content">
            <!--contains code from other loaded HTML files-->
        </div>
    </body>
    <script>
        function loadCredits(){
            loadPage("Credits.php");
        };
        
        function loadPage(site, bool){
            $.ajax({url: site, dataType:"html", success:
                function(result){
                    $("#menu").hide();
					$("#content").html(result);
                    if(bool){                        
                        setContentHeight();
                    }
				}});
        };
        
        function setContentHeight(){            
            $("#content").height("100%");   
        };
    </script>
</html>
