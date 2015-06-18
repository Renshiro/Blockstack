
<script type="text/javascript" src="../Libraries/matter.js"></script>
        
<script>      
   // Initialize variables
   Width = window.innerWidth;
   Height = window.innerHeight;


    // Matter.js module aliases
    var Engine = Matter.Engine,
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

    // add a mouse controlled constraint
    var mouseConstraint = MouseConstraint.create(engine);

    // create ground
    var ground = Bodies.rectangle(Width / 2,Height,Width, Height / 10, { isStatic: true, render: { visible: true } }),
    rockOptions = { density: 0.68, restitution: 1.0 },
    rock = Bodies.rectangle(Width / 2, Height / 3, Width /5, Width / 5, rockOptions),
    anchor = { x: Width / 2, y: 0 },
    elastic = Constraint.create({
      pointA: anchor,
      bodyB: rock,
      stiffness: 0.5,
      render: {
        lineWidth: 0,
      }
    });
    
    var angle = Math.PI / 2;
    var maxAngle = Math.PI - Math.PI /5;
    var minAngle = Math.PI /5;
    var force = 0.01;
    
   Events.on(engine, 'tick', function(event) {
       angle += force; 
       
       if(angle > maxAngle || angle < minAngle) {
           force = -force;
       }
       
       Body.setPosition(elastic.bodyB, { x: x = (Height/3 * Math.cos(angle)) + elastic.pointA.x, y: y = (Height/3 * Math.sin(angle)) + elastic.pointA.y});
    });        

   Events.on(engine, 'mousedown', function(event) {               
       elastic.bodyB = null;
    });           

    // add all of the bodies to the world
    World.add(engine.world, [ground, mouseConstraint, rock,  elastic]);           

    // run the engine
    Engine.run(engine)
</script>
