<template>
	<div>
		<canvas id="myCanvas" width="640" height="320"></canvas>
		<div class="play-game">
			<button @click="begin" v-if="noPlay" class="btn-play">PLAY</button>
		</div>
	</div>

</template>
<script>
	
	export default{
		data(){
			return{
				score: 0,
				x: 0,
				y: 0,
				dx: 2,
				dy: -2,
				ballRadius: 10,
				paddleHeight: 10,
				paddleWidth: 75,
				paddleX: 0,
				canvas: null,
				ctx: null,
				rightPressed: false,
				leftPressed: false,
				circle: false,
				noPlay: true,
			}
		},
		mounted() {
		  
		},
		methods:{
			begin(){
				this.noPlay = !this.noPlay;
				var vm = this
			    vm.canvas = document.getElementById("myCanvas");
				vm.ctx = vm.canvas.getContext("2d");

				//ball
				vm.x= vm.canvas.width/2;
				vm.y= vm.canvas.height-30;
				vm.paddleX= (vm.canvas.width - vm.paddleWidth)/2;

				document.addEventListener("keydown", vm.keyDownHandler, false);
				document.addEventListener("keyup", vm.keyUpHandler, false);

				vm.circle = setInterval(vm.draw, 10);

			},
			reload(){
				document.location.reload();
			},
			keyDownHandler(e) {
			    if(e.keyCode == 39) {
			        this.rightPressed = true;
			    }
			    else if(e.keyCode == 37) {
			        this.leftPressed = true;
			    }
			},
			keyUpHandler(e) {
			    if(e.keyCode == 39) {
			        this.rightPressed = false;
			    }
			    else if(e.keyCode == 37) {
			        this.leftPressed = false;
			    }
			},
			increaseScore(){
				this.score += 100;
			},
			drawScore(){
				this.ctx.beginPath();
			    this.ctx.font = "30px Arial";
				this.ctx.fillText("Score: " + this.score, 10, 30);
			    this.ctx.closePath();
			},
			drawBall(){
				this.ctx.beginPath();
			    this.ctx.arc(this.x, this.y, this.ballRadius, 0, Math.PI*2);
			    this.ctx.fillStyle = "#0095DD";
			    this.ctx.fill();
			    this.ctx.closePath();
			},
			drawPaddle(){
				this.ctx.beginPath();
				this.ctx.rect(this.paddleX+5, this.canvas.height-this.paddleHeight, this.paddleWidth-10, this.paddleHeight);
				this.ctx.fillStyle = "#0095DD";
		    	this.ctx.fill();
				this.ctx.closePath();
			},
			draw(){
				this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

				this.drawScore();
				
				this.drawBall();
				

				if(this.x + this.dx > this.canvas.width-this.ballRadius || this.x + this.dx < this.ballRadius) {
					this.increaseScore();
				    this.dx = -this.dx;
				}
				if(this.y + this.dy < this.ballRadius) {
					this.increaseScore();
				    this.dy = -this.dy;
				} else if(this.y + this.dy > this.canvas.height-this.ballRadius) {
				    if(this.x > this.paddleX && this.x < this.paddleX + this.paddleWidth) {
				    	// this.increaseScore();
				        this.dy = -this.dy;
				    }
				    else {
				    	// document.location.reload();
				     //    alert("GAME OVER");
				    	this.sendScoreToParent(this.score);
				    	this.score = 0;
				    	this.noPlay = !this.noPlay;
				        clearInterval(this.circle);
				    }
				}

				this.x += this.dx;
			    this.y += this.dy;

				this.drawPaddle();

				if(this.rightPressed && this.paddleX < this.canvas.width-this.paddleWidth) {
				    this.paddleX += 7;
				}
				else if(this.leftPressed && this.paddleX > 0) {
				    this.paddleX -= 7;
				}
			    
			},
			sendScoreToParent(score){
				this.$emit('getScoreFromChild', score)
			}
		}
	};
</script>
<style scoped>
	canvas { background: #eee; display: block; margin: 0 auto; }
	.btn-play{
		border: 2px solid red;
		background-color: red;
		color: white;
		font-size: 24px;
		font-weight: bold;
		border-radius: 15px;
		padding-left: 20px;
		padding-right: 20px;
	}
	.btn-play:hover{
		background-color: white;
		color: red;
	}
	.play-game{
		text-align: center;
		margin-top: 15px;
	}
</style>