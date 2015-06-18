<div class="row" style="height:10%">
	<div class="small-12 columns text-center"> 
		<h1>highscores</h1> 
	</div>
</div>

<div class="row text-center" style="height:60%;margin-bottom:5%">
	<div class="small-12 columns">
		<table style="margin:0 auto">
		  <thead>
			<tr>
			  <th>Rank</th>
			  <th>Name</th>
			  <th>Score</th>
			</tr>
		  </thead>
		  <tbody>
			<?php
				include "../Database/dbOperations.php";				
				getTopTenTable();
			?>			
		  </tbody>
		</table>
	</div>
</div>

<div class="row" style="height:20%">
	<div class="small-12 columns text-center"> 
		<a id="back" class="button round" href="index.php" data-transition="slide">Back</a>
	</div>
</div>
