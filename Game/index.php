<!DOCTYPE html>
<html>
    <?php
        include 'header.php';
    ?>
    <body>      
        <div id="menu" style="height:100%">
            <div class="row" style="height:20%">
				<div class="small-12 columns text-center"> 
					<h1>Blockstack</h1> 
				</div>
			</div>
			
			<div class="row"  style="height:60%">
				<div class="small-12 columns text-center"> <span id="Game" class="button round" onclick="loadGame()">Play Game</span> </div>
				<div class="small-12 columns text-center"> <span id="How2Play" class="button round" onclick="loadHow2Play()">How To Play</span> </div>
				<div class="small-12 columns text-center"> <span id="Highscores" class="button round" onclick="loadHighscores()">Highscores</span> </div>
				<div class="small-12 columns text-center"> <span id="Credits" class="button round" onclick="loadCredits()">Credits</span> </div>
			</div>        				
			
        </div>
        <div id="content" style="height:100%">
            <!--contains code from other loaded HTML files-->
        </div>
    </body>
    <script>
            function loadGame(){
                $.ajax({url: "game.php", dataType:"html", success:
                function(result){
                    $("#menu").hide();
					$("#content").html(result); //DA RICKY EFFEKT VERMUETLI UF RESULT
				}});
			};
            function loadHow2Play(){
            $.ajax({url: "how2play.php", dataType:"html", success:
                function(result){
                    $("#menu").hide();
					$("#content").html(result);
				}});
			};
            function loadHighscores(){
            $.ajax({url: "highscores.php", dataType:"html", success:
                function(result){
                    $("#menu").hide();
					$("#content").html(result);
				}});
			};
            function loadCredits(){
            $.ajax({url: "credits.php", dataType:"html", success:
                function(result){
                    $("#menu").hide();
					$("#content").html(result);
				}});
			};
    </script>
</html>
