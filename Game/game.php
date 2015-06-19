<a class="pauseButton" onclick="pause()"> || </a>
<p class="score" id="score" name="score">score: 0</p>

<div id="pauseMenu" class="reveal-modal" data-reveal aria-labelledby="PauseMenu" aria-hidden="true" role="dialog">    
    <div class="row" >
        <div class="small-12 columns text-center"  style="margin-bottom:100px"> <h1 id="scoreTitle">score: 0</h1> </div>
        <div class="small-12 columns text-center"> <a href="#" class="button round" onclick="gameContinue()">Continue</a></div>
        <div class="small-12 columns text-center">  <a href="#" class="button round" onclick="restart()">Restart</a> </div>
        <div class="small-12 columns text-center"> <a href="index.php" class="button round">Exit</a> </div>
    </div>    
</div>

<div id="winMenu" class="reveal-modal" data-reveal aria-labelledby="WinMenu" aria-hidden="true" role="dialog">    
    <div class="small-12 columns text-center"  style="margin-bottom:100px"> <h1 id="scoreTitle2">score: 0</h1> </div>
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
              </tbody>
            </table>
        </div>
    </div>  
    <div class="small-12 columns text-center">  <a href="#" class="button round" onclick="restart()">Restart</a> </div>
</div>

<script type="text/javascript" src="../Libraries/matter.js"></script>
        
<script>      
   // Initialize variables
   Width = window.innerWidth;
   Height = window.innerHeight;
   BlockSize = Height * 0.15;    
        
    var angle = Math.PI / 2;
    var maxAngle = Math.PI - Math.PI /5;
    var minAngle = Math.PI /5;
    var force = 0.01;
    
    score = 0;
    clicking = false;
    times = 0;
    count = 0;
    
    changePace = 20;
    scorePoints = 10;
    fallingBlock = null;


    // Matter.js module aliases
    Engine = Matter.Engine,
    World = Matter.World,
    Bodies = Matter.Bodies,
    Body = Matter.Body
    Constraint = Matter.Constraint,
    Composites = Matter.Composites,
    Events = Matter.Events,
    MouseConstraint = Matter.MouseConstraint;

    // create a Matter.js engine
    var engine = Engine.create(document.body, {
      render: {
        options: {
          wireframes: false,
            width: Width,
            height: Height
        }
      }
    });

    // create ground
    ground = Bodies.rectangle(Width / 2,Height,Width, Height / 10, { isStatic: true, render: { visible: true } }),
    rock = createRock(),
    fallingBlock = rock,
    blockList = [],
    anchor = { x: Width / 2, y: 0 },
    elastic = Constraint.create({
      pointA: anchor,
      bodyB: rock,
      stiffness: 0.5,
      render: {
        lineWidth: 0,
      }
    });
    
   Events.on(engine, 'tick', function(event) {
       angle += force; 
       
       if(angle > maxAngle || angle < minAngle) {
           force = -force;
       }       
       Body.setPosition(elastic.bodyB, { x: x = (Height/3 * Math.cos(angle)) + elastic.pointA.x, y: y = (Height/3 * Math.sin(angle)) + elastic.pointA.y});
       
       
       // check if Lost
       if(fallingBlock.position.y >= Height) {
           win();
       }
    });        

    $("canvas").click(function() {
        if(!engine.enabled) {
            return;   
        }
        
        if(!clicking) {
            clicking = true;
            fallingBlock = elastic.bodyB;
            block = createRock();
            elastic.bodyB = block;

            Body.setVelocity(fallingBlock, {x: 0, y: 1}); 
            blockList[blockList.length] = fallingBlock;
            score += scorePoints;
            $("#score").text("score: " + score);            
            $("#scoreTitle").text("score: " + score);
            $("#scoreTitle2").text("score: " + score);
            
            if(score % changePace == 0) {
                
                if(force < 0) {
                    force -= 0.005;   
                } else {
                    force += 0.005;                    
                }
                
                changePace *= 2;
                scorePoints += 10;
                if(score % (changePace * 10)) {
                    BlockSize * 0.95;
                }
            }
            
            setTimeout(function(){ 
                if(times == 0) {
                    times++;
                    count++;
                } else if(times < 3) {
                    Body.setPosition(ground, {x: ground.position.x, y: ground.position.y + BlockSize});
                    times++;
                    count++;
                } else {
                        Body.setPosition(ground, {x: ground.position.x, y: ground.position.y + BlockSize});                    
                        for(i = 0; i < blockList.length - 3;i++) {                                
                            cBlock = blockList[i];                    
                            Body.setPosition(cBlock, {x: cBlock.position.x, y: cBlock.position.y + BlockSize});
                            Matter.Sleeping.set(cBlock,  true);
                        }
                       count++;
                }
                World.add(engine.world, [block]);
                clicking = false;
            }, 1000);
        }        
    });
    
    // add all of the bodies to the world
    World.add(engine.world, [ground, rock,  elastic]);           

    // run the engine
    Engine.run(engine)
    
    // Functions ---------------------
    function createRock() {
           return Bodies.rectangle(Width / 2, Height / 3, BlockSize, BlockSize, { restitution: 0, friction: 0.0001, mass: 0.0000001});
    }
    
    function pause() {     
        engine.enabled = false;
        $('#pauseMenu').foundation('reveal', 'open');   
    }
    
    function win() { 
        engine.enabled = false;
        $('#winMenu').foundation('reveal', 'open');  
    }    
        
    function gameContinue() {
        $('#pauseMenu').foundation('reveal', 'close');
        engine.enabled = true;
    }
    
    function restart() {        
       $(document.body).html('<div id="content"></div>');
       $.ajax({url: "game.php", dataType:"html", success:
        function(result){
            $("#menu").hide();
            $("#content").html(result);
        }});
    }
    
</script>
