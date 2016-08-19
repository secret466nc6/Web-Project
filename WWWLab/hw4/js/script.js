// inner variables
var sX=800,sY=600;
var canvas, ctx;
var button;
var backgroundImage;
var spaceShip;
var iBgShiftY = 1024;
var hit, shoot,ost,audiob,elife;//audio
//flag
var bDrawDialog = true;
var iDialogPage = 1;
var stop=true;//遊戲暫停
var isend=false;//遊戲結束
var first=true;
//一般變數
var width;//畫布大小
var height;//畫布大小
var psize=200;//本機大小
var e2_width=80
var e2_hight=40
var total=0;//總分
var Hp=100;//生命值
var distance=1000;//終點距離
var message="";//結束遊戲訊息
//圖片區
var oExplosionImage;//爆破圖片
var weapon_img;//武器圖片
var enemy_img;//武器圖片
var life_img;//武器圖片
var el_img;//右邊砲彈
var er_img;//左邊砲彈
var weapon_speed=10;
var enemy_speed=5;
var choose_f="img/p1.png";//使用者選擇的戰鬥機
//陣列變數
var weapons = []; // 火箭炮
var lifes = []; // 補血道具
var enemies = []; // 怪獸
var l_enemies = []; // 怪獸l
var r_enemies = []; // 怪獸r
var rank_total = [];//排名總分
var rank_name = [];//排名Name
var rank_count = 0;//排名count
var explosions = []; // array of explosions

// -------------------------------------------------------------

// objects :
function Button(x, y, w, h, state, image) {
    this.x = x;
    this.y = y;
    this.w = w;
    this.h = h;
    this.state = state;
    this.imageShift = 0;
    this.image = image;
}
function SpaceShip(x, y, w, h, image) {
    this.x = x;
    this.y = y;
    this.w = w;
    this.h = h;
    this.image = image;
}
function Weapon(x, y, w, h, image) {
    this.x = x;
    this.y = y;
    this.w = w;
    this.h = h;
    this.image = image;
}
function Enemy(x, y, w, h, image) {
    this.x = x;
    this.y = y;
    this.w = w;
    this.h = h;
    this.image = image;
}
function Life(x, y, w, h, image) {
    this.x = x;
    this.y = y;
    this.w = w;
    this.h = h;
    this.image = image;
}
function L_Enemy(x, y, w, h, image) {
    this.x = x;
    this.y = y;
    this.w = w;
    this.h = h;
    this.image = image;
}
function R_Enemy(x, y, w, h, image) {
    this.x = x;
    this.y = y;
    this.w = w;
    this.h = h;
    this.image = image;
}
function Explosion(x, y, w, h, sprite, image) {
    this.x = x;
    this.y = y;
    this.w = w;
    this.h = h;
    this.sprite = sprite;
    this.image = image;
}

// -------------------------------------------------------------

// draw functions :

function clear() { // clear canvas function
    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
}

function drawDialog() { // draw dialog function
    if (bDrawDialog) {
        var bg_gradient = ctx.createLinearGradient(0, 200, 0, 400);
        bg_gradient.addColorStop(0.0, 'rgba(160, 160, 160, 0.8)');
        bg_gradient.addColorStop(1.0, 'rgba(250, 250, 250, 0.8)');
        
        ctx.beginPath(); // custom shape begin
        ctx.fillStyle = bg_gradient;
        ctx.moveTo(100, 100);
        ctx.lineTo(700, 100);
        ctx.lineTo(700, 500);
        ctx.lineTo(100, 500);
        ctx.lineTo(100, 100);
        ctx.closePath(); // custom shape end
        ctx.fill(); // fill custom shape

        ctx.lineWidth = 2;
        ctx.strokeStyle = 'rgba(128, 128, 128, 0.5)';
        ctx.stroke(); // draw border

        // draw the title text
        ctx.font = '42px DS-Digital';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'top';
        ctx.shadowColor = '#000';
        ctx.shadowOffsetX = 2;
        ctx.shadowOffsetY = 2;
        ctx.shadowBlur = 2;
        ctx.fillStyle = '#fff';
        if (iDialogPage == 1) {
            ctx.fillText('How to Play the Game?', ctx.canvas.width/2, 150);
            ctx.font = '24px DS-Digital';
            ctx.fillText("press 'W','A','S','D' to UP,DOWN,LEFT,RIGHT", ctx.canvas.width/2, 250);
            ctx.fillText("press 'T' to attack", ctx.canvas.width/2, 280);
             ctx.fillText("press 'P' to stop/continute", ctx.canvas.width/2, 310);
        } else if (iDialogPage == 2) {
            
            ctx.fillText('Ready?', ctx.canvas.width/2, 150);
            ctx.font = '24px DS-Digital';
            ctx.fillText("Hit big enemies -> get 100 points, small -> get 50 points ", ctx.canvas.width/2, 250);
            ctx.fillText("When you are attacked, your Hp - 10", ctx.canvas.width/2, 280);
             ctx.fillText("if your HP = 0 -> Game over", ctx.canvas.width/2, 310);
              ctx.fillText("if distance = 0 -> You Win!", ctx.canvas.width/2, 340);
             ctx.fillText("click Next to play!", ctx.canvas.width/2, 370);
        }else if(iDialogPage == 6){//game over
        ctx.fillText(message, ctx.canvas.width/2, 150);
        ctx.font = '24px DS-Digital';
        var t=0;
            //bubble sort
		for (var i = 0; i < rank_total.length -1; i++) {
			for (var j = 1; j < (rank_total.length - i); j++) {
				if (rank_total[j - 1] < rank_total[j]) {
					t = rank_total[j - 1];
					rank_total[j - 1] = rank_total[j];
					rank_total[j] = t;
                    t = rank_name[j - 1];
					rank_name[j - 1] = rank_name[j];
					rank_name[j] = t;
                    
				}
			}
		}
            var h=250;
            for(var i = 0; i < 5; i++){
                if(i>=rank_total.length){
                    rank_total[i]=0;
                    rank_name[i]="NULL";
                }
        ctx.fillText("Rank"+i+": "+rank_name[i]+" "+rank_total[i], ctx.canvas.width/2, h);
                h+=30
            }
        }
    }
}

function drawScene() { // main drawScene function
    
    clear(); // clear canvas
 
    // draw background
    if(!stop&&!isend){
    iBgShiftY -= 10;
     distance--;
        if(distance<=0){
        gameover();
        }
    }
    if (iBgShiftY <= 0) {
        iBgShiftY = 1024;
    }
    
    ctx.drawImage(backgroundImage, 0 , 0+ iBgShiftY, 800, 600, 0, 0, sX, sY);

    // draw space ship
    ctx.drawImage(spaceShip.image, 0, 0, spaceShip.w, spaceShip.h, spaceShip.x-psize/2, spaceShip.y-psize/2, spaceShip.w, spaceShip.h);

    // draw dialog
    drawDialog();

   

    // draw button's text
    ctx.font = '22px DS-Digital';
    ctx.fillStyle = '#ffffff';
    if(iDialogPage<2){
         // draw button
    ctx.drawImage(button.image, 0, button.imageShift, button.w, button.h, button.x, button.y, button.w, button.h);
    ctx.fillText('Tips', 400, 465);
    ctx.fillText('Next', 400, 500);
        
    }if(iDialogPage==3){//start or restart
        init();
        iDialogPage=4;//start
        ost.currentTime = 0;
		ost.play();	
    }else if(iDialogPage==2){//tips
         // draw button
    ctx.drawImage(button.image, 0, button.imageShift, button.w, button.h, button.x, button.y, button.w, button.h);
    ctx.fillText('Next', 400, 465);
    ctx.fillText('PLAY!', 400, 500);
    }else if(iDialogPage==5){//stop
         // draw button
    ctx.drawImage(button.image, 0, button.imageShift, button.w, button.h, button.x, button.y, button.w, button.h);
    ctx.fillText("Press 'p'", 400, 465);
    ctx.fillText('Back GAME!', 400, 500);
    }else if(iDialogPage==6){//game over
     //draw button
    ctx.drawImage(button.image, 0, button.imageShift, button.w, button.h, button.x, button.y, button.w, button.h);
    ctx.fillText(message, 400, 465);
    ctx.fillText('Play again!', 400, 500);
    }
    keyFunction();
    
    if(!stop&&!isend){
    drawObjects();
    randomEnemy();
    randomLife();
    drawInfo();
    }
   
}
function drawInfo(){
    ctx.font="20px Georgia";
     ctx.fillText("Distance: "+distance+"m",100,20);
    ctx.fillText("HP: "+Hp+"/100",100,50);
     ctx.fillText("Total: "+total,100,80);
   
}
function drawObjects(){
    // draw explosions
        if (explosions.length > 0) {
            for (var key in explosions) {
                if (explosions[key] != undefined) {
                    // display explosion sprites
                    ctx.drawImage(explosions[key].image, explosions[key].sprite*explosions[key].w, 0, explosions[key].w, explosions[key].h, explosions[key].x - explosions[key].w/2, explosions[key].y - explosions[key].h/2, explosions[key].w, explosions[key].h);
                    explosions[key].sprite++;
                    // remove an explosion object when it expires
                    if (explosions[key].sprite > 10) {
                        delete explosions[key];
                    }
                }
            }
        }

    // draw weapons
        if (weapons.length > 0) {
           
            for(var i=0;i<weapons.length;i++){
                
                if (weapons[i] != undefined) {
                    
                    ctx.drawImage(weapons[i].image, weapons[i].x, weapons[i].y);
                    weapons[i].y -= weapon_speed;
                    if (weapons[i].y < 0)//out of windows
                    delete weapons[i];
            
                }
            }
           
        }
     // draw enemies
        if (enemies.length > 0) {
           
            for(var i=0;i<enemies.length;i++){
                
                if (enemies[i] != undefined) {
                    
                    ctx.drawImage(enemies[i].image, enemies[i].x, enemies[i].y);
                    enemies[i].y += enemy_speed;
                    if (enemies[i].y >height)//out of windows
                    delete enemies[i];
                    
                   
                }
            }
           
        }
    // draw life
        if (lifes.length > 0) {
           
            for(var i=0;i<lifes.length;i++){
                
                if (lifes[i] != undefined) {
                    
                    ctx.drawImage(lifes[i].image, lifes[i].x, lifes[i].y);
                    lifes[i].y += 12;
                    if (lifes[i].y >height)//out of windows
                    delete lifes[i];
                    
                   
                }
            }
           
        }
    //left
    if (l_enemies.length > 0) {
           
            for(var i=0;i<l_enemies.length;i++){
                
                if (l_enemies[i] != undefined) {
                    //console.log(l_enemies[i].x);
                    ctx.drawImage(l_enemies[i].image, l_enemies[i].x, l_enemies[i].y);
                    l_enemies[i].x += enemy_speed;
                    if (l_enemies[i].x >width-120)//out of windows
                    delete l_enemies[i];
                   
                }
            }
           
        }
    //right  
    
    if (r_enemies.length > 0) {
           
            for(var i=0;i<r_enemies.length;i++){
                
                if (r_enemies[i] != undefined) {
                    
                    ctx.drawImage(r_enemies[i].image, r_enemies[i].x, r_enemies[i].y);
                    r_enemies[i].x -= enemy_speed;
                    if (r_enemies[i].x < 0)//out of windows
                    delete r_enemies[i];
                   
                }
            }
           
        }
    //damage for r_enemy
        if (r_enemies.length > 0) {
            for(var i=0;i<r_enemies.length;i++){
                if (r_enemies[i] != undefined) {
                    if (weapons.length > 0) {//hit
                       for(var j=0;j<weapons.length;j++){
                            if (weapons[j] != undefined) {
                                if (weapons[j].y < r_enemies[i].y + r_enemies[i].h/2 &&
                                    weapons[j].x > r_enemies[i].x && 
                                    weapons[j].x < r_enemies[i].x + r_enemies[i].w) {
                                    //clear
                                     explosions.push(new Explosion(r_enemies[i].x + r_enemies[i].w / 2, r_enemies[i].y + r_enemies[i].h / 2, 120, 120, 0, oExplosionImage));
                                    delete r_enemies[i];
                                    delete weapons[j];									
                                    total+=50;
									hit.play();//hit
                                   
                                }
                            }
                        }
                    }
                    // hitted
                    if (r_enemies[i] != undefined) {
                        if (spaceShip.y - spaceShip.h/2 < r_enemies[i].y + r_enemies[i].h-50 &&
                            spaceShip.x - spaceShip.w/2 < r_enemies[i].x + r_enemies[i].w/2&& 
                            spaceShip.x + spaceShip.w/2 > r_enemies[i].x + r_enemies[i].w/2) {
                            explosions.push(new Explosion(r_enemies[i].x + r_enemies[i].w / 2, r_enemies[i].y + r_enemies[i].h / 2, 120, 120, 0, oExplosionImage));
                            //hit
                            hit.play();
                            // clear enemy
                            delete r_enemies[i];
                            Hp-=10;
							hit.play();
                            if (Hp <= 0) { // gameover
                                gameover();
                            }
                        }
                    }
                }
            }
        }
        //damage for l_enemy
        if (l_enemies.length > 0) {
            for(var i=0;i<l_enemies.length;i++){
                if (l_enemies[i] != undefined) {
                    if (weapons.length > 0) {//hit
                       for(var j=0;j<weapons.length;j++){
                            if (weapons[j] != undefined) {
                                if (weapons[j].y < l_enemies[i].y + l_enemies[i].h/2 &&
                                    weapons[j].x > l_enemies[i].x && 
                                    weapons[j].x < l_enemies[i].x + l_enemies[i].w) {
                                    explosions.push(new Explosion(l_enemies[i].x + l_enemies[i].w / 2, l_enemies[i].y + l_enemies[i].h / 2, 120, 120, 0, oExplosionImage));
                                    //clear
                                    delete l_enemies[i];
                                    delete weapons[j];									
                                    total+=50;
									hit.play();//hit
                                }
                            }
                        }
                    }
                    // hitted
                    if (l_enemies[i] != undefined) {
                        if (spaceShip.y - spaceShip.h/2 < l_enemies[i].y + l_enemies[i].h-50 &&
                            spaceShip.x - spaceShip.w/2 < l_enemies[i].x + l_enemies[i].w/2&& 
                            spaceShip.x + spaceShip.w/2 > l_enemies[i].x + l_enemies[i].w/2) {
                             explosions.push(new Explosion(l_enemies[i].x + l_enemies[i].w / 2, l_enemies[i].y + l_enemies[i].h / 2, 120, 120, 0, oExplosionImage));
                            //hit
                            hit.play();
                            // clear enemy
                            delete l_enemies[i];
                            Hp-=10;
							hit.play();
                           
                            if (Hp <= 0) { // gameover
                                gameover();
                            }
                        }
                    }
                }
            }
        }
    //damage for enemy
        if (enemies.length > 0) {
            for(var i=0;i<enemies.length;i++){
                if (enemies[i] != undefined) {
                    if (weapons.length > 0) {//hit
                       for(var j=0;j<weapons.length;j++){
                           /*
                           rockets[key].y < enemies[ekey].y + enemies[ekey].h/2 &&
                           rockets[key].x > enemies[ekey].x && 
                           rockets[key].x + rockets[key].w < enemies[ekey].x + enemies[ekey].w) {
                           */
                            if (weapons[j] != undefined) {
                                if (weapons[j].y < enemies[i].y + enemies[i].h/2 &&
                                    weapons[j].x > enemies[i].x && 
                                    weapons[j].x < enemies[i].x + enemies[i].w) {
                                    explosions.push(new Explosion(enemies[i].x + enemies[i].w / 2, enemies[i].y + enemies[i].h / 2, 120, 120, 0, oExplosionImage));
                                    //clear
                                    delete enemies[i];
                                    delete weapons[j];									
                                    total+=100;
									hit.play();//hit
                                }
                            }
                        }
                    }
                    // hitted
                    if (enemies[i] != undefined) {
                        if (spaceShip.y - spaceShip.h/2 < enemies[i].y + enemies[i].h-50 &&
                            spaceShip.x - spaceShip.w/2 < enemies[i].x + enemies[i].w/2&& 
                            spaceShip.x + spaceShip.w/2 > enemies[i].x + enemies[i].w/2) {
                            explosions.push(new Explosion(enemies[i].x + enemies[i].w / 2, enemies[i].y + enemies[i].h / 2, 120, 120, 0, oExplosionImage));
                            //hit
                            hit.play();
                            // clear enemy
                            delete enemies[i];
                            Hp-=10;
							hit.play();
                            
                            if (Hp <= 0) { // gameover
                                gameover();
                            }
                        }
                    }
                }
            }
        }
     //eat life
        if (lifes.length > 0) {
            for(var i=0;i<lifes.length;i++){
                if (lifes[i] != undefined) {
                        if (spaceShip.y - spaceShip.h/2 < lifes[i].y + lifes[i].h-25 &&
                            spaceShip.x - spaceShip.w/2 < lifes[i].x + lifes[i].w/2&& 
                            spaceShip.x + spaceShip.w/2 > lifes[i].x + lifes[i].w/2) {
                            
                            //eat
                            elife.play();
                            if(Hp+10<=100)
                            Hp+=10;
                            // clear enemy
                            delete lifes[i];
                            
							
                        }
                    
                }
            }
        }
}
function init(){//初始化
        weapons = []; // 火箭炮
        enemies = []; // 怪獸
        l_enemies = []; // 怪獸l
        r_enemies = []; // 怪獸r
        isend=false;
        stop=false;
        Hp=100;//生命值
        distance=1000;//終點距離
        total=0;
}
function gameover(){
    ost.pause();
	ost.currentTime = 0;	
    bDrawDialog=true;
    isend=true;
    iDialogPage=6;
    var person = prompt("Please enter your name", "Player"+rank_count);
    
    if (person != null) {
        rank_name[rank_count]=person;
    }else {
         rank_name[rank_count]="Player"+rank_count;
    }
    
    rank_total[rank_count]=total;
    if(distance<=0){
        message="YOU WIN :"+ total;
    }else if(Hp <=0){
        message="GAME OVER :"+ total;
    }
    
    rank_count++;
}
function randomEnemy(){
    var p=Math.floor((Math.random() * 50) + 1);//  p=1/50
   // console.log(p)
    if(p==5){
    var enemy_x=Math.floor(Math.random()*(500)+1);
    var enemy_y=Math.floor(Math.random()*(400)+1);
     // console.log(enemy_x);
    enemies.push(new Enemy(enemy_x,  -100, psize, psize, enemy_img));
    l_enemies.push(new Enemy(0,  enemy_y, e2_width, e2_hight, el_img));
    r_enemies.push(new Enemy(width-100, enemy_y , e2_width, e2_hight, er_img));
    }
}
function randomLife(){
    var p=Math.floor((Math.random() * 50) + 1);//  p=1/100
   // console.log(p)
    if(p==5){
    var lifes_x=Math.floor(Math.random()*(500)+1);
     // console.log(enemy_x);
    lifes.push(new Enemy(lifes_x,  -50, 100, 100, life_img));
    }
}
function loadImages(){
    
    // weapon
    weapon_img = new Image();
    weapon_img.src = 'img/weapon.png';
    weapon_img.onload = function() { }
    //enemy
    enemy_img = new Image();
    enemy_img.src = 'img/e1.png';
    enemy_img.onload = function() { }
    //enemy
    life_img = new Image();
    life_img.src = 'img/elife.png';
    life_img.onload = function() { }
    //enemy left
    el_img = new Image();
    el_img.src = 'img/el.png';
    el_img.onload = function() { }
    //enemy rifht
    er_img = new Image();
    er_img.src = 'img/er.png';
    er_img.onload = function() { }
    // initialization of explosion image
    oExplosionImage = new Image();
    oExplosionImage.src = 'img/explosion.png';
    oExplosionImage.onload = function() { }
}
function loadAudio(){
    hit = document.getElementById("Hit");
    shoot = document.getElementById("Shoot");
    ost = document.getElementById("OST");
    audiob = document.getElementById("Button");
    elife = document.getElementById("Life");
}
//鍵盤事件
function keyFunction() {
　document.onkeydown = function(){
        var keycode = event.which || event.keyCode;
        if(keycode == 87){//W
            //alert(spaceShip.y+","+height);
            if(spaceShip.y-spaceShip.h/2>0)
            spaceShip.y-=10;
        }else if(keycode == 65){//A
            if(spaceShip.x-spaceShip.w/2>-10)
            spaceShip.x-=10;
        }else if(keycode == 83){//S
            if(spaceShip.y+spaceShip.h/2<height)
            spaceShip.y+=10;
        }else if(keycode == 68){//D
             if(spaceShip.x+spaceShip.w/2<width-10)
            spaceShip.x+=10;
        }else if(keycode == 84){//T 射擊
            weapons.push(new Weapon(spaceShip.x, spaceShip.y - spaceShip.h/2, 10, 30, weapon_img));
			shoot.play();
        }else if(keycode == 80){//P 暫停
            if(!stop){
                iDialogPage=5;
                stop=true;
                ost.pause();
            }else{
                iDialogPage=4;
                stop=false;
                ost.play();
            }
            console.log(stop);
        }else if(keycode == 82){//R 重來
             console.log(stop);
        }
     
     
    }
}
// -------------------------------------------------------------

// initialization
$(function(){
   	btn_r.onclick = function()
	{
        ost.pause();
        ost.currentTime = 0;	
        bDrawDialog=true;
        isend=true;
        iDialogPage=6;
        message="RANK";
    }
     btn_f.onclick = function()
	{
     if(first){
			setInterval(drawScene, 30); // 0.03秒循環
         first=false;
         
  
		}
    var ele = document.getElementsByName('fighter');
                var i = ele.length;
                for (var j = 0; j < i; j++) {
                    if (ele[j].checked) { //index has to be j.
                        choose_f="img/"+ele[j].value+".png";
                    }
                }
         
          // initialization of space ship
    var oSpShipImage = new Image();
   
    oSpShipImage.src = choose_f;
    oSpShipImage.onload = function() {
    }
    
    spaceShip = new SpaceShip(400, 530, psize, psize, oSpShipImage);
         
           }      
    canvas = document.getElementById('scene');
    ctx = canvas.getContext('2d');
    
    width = canvas.width;
    height = canvas.height;

    // load background image
    backgroundImage = new Image();
    backgroundImage.src = 'img/stars.jpg';
    backgroundImage.onload = function() {
    }
    backgroundImage.onerror = function() {
        console.log('Error loading the background image.');
    }
    //load img
    loadImages();
    //load audio
    loadAudio();

    // load the button sprite image
    var buttonImage = new Image();
    buttonImage.src = 'img/button.png';
    buttonImage.onload = function() {
    }
    button = new Button(310, 450, 180, 120, 'normal', buttonImage);

    $('#scene').mousedown(function(e) { // binding mousedown event (for dragging)

        var mouseX = e.layerX || 0;
        var mouseY = e.layerY || 0;
/*
        if (!bDrawDialog && 
            mouseX > spaceShip.x-psize/2 && mouseX < spaceShip.x-psize/2+spaceShip.w &&
            mouseY > spaceShip.y-psize/2 && mouseY < spaceShip.y-psize/2+spaceShip.h) {

            spaceShip.bDrag = true;
            spaceShip.x = mouseX;
            spaceShip.y = mouseY;
        }*/

        // button behavior
        if (mouseX > button.x && mouseX < button.x+button.w && mouseY > button.y && mouseY < button.y+button.h) {
            button.state = 'pressed';
            button.imageShift = 262;
        }
    });
/*
    $('#scene').mousemove(function(e) { // binding mousemove event
        var mouseX = e.layerX || 0;
        var mouseY = e.layerY || 0;

        if (!bDrawDialog && spaceShip.bDrag) {
            spaceShip.x = mouseX;
            spaceShip.y = mouseY;
        }

        // button behavior
        if (button.state != 'pressed') {
            button.state = 'normal';
            button.imageShift = 0;
            if (mouseX > button.x && mouseX < button.x+button.w && mouseY > button.y && mouseY < button.y+button.h) {
                button.state = 'hover';
                button.imageShift = 131;
            }
        }
    });
*/
    $('#scene').mouseup(function(e) { // binding mouseup event
       // spaceShip.bDrag = false;

        // button behavior
        if (button.state == 'pressed') {
            audiob.play();
            if (iDialogPage == 1) {
                iDialogPage++;
            } else if (iDialogPage == 2) {
                iDialogPage = 3;
                bDrawDialog = !bDrawDialog;
            } else if (iDialogPage == 3) {
                stop=false;
            }  else if (iDialogPage == 6) {
                iDialogPage = 1;
                
            } 
        }
        button.state = 'normal';
        button.imageShift = 0;
    });
 btn_e.onclick = function()
	{
    var ele = document.getElementsByName('efighter');
                var i = ele.length;
                for (var j = 0; j < i; j++) {
                    if (ele[j].checked) { //index has to be j.
                        choose_f="img/"+ele[j].value+".png";
                    }
                }
         
          // initialization of space ship
 
   
    enemy_img.src = choose_f;
    enemy_img.onload = function() {
    }
    }
    //setInterval(drawScene, 30); // loop drawScene
});

