<template>
	<div>
		<canvas id="myCanvas" width="700" height="400"></canvas>
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
			ballRadius: 6,
			paddleHeight: 10,
			paddleWidth: 100,
			paddleX: 0,
			canvas: null,
			ctx: null,
			rightPressed: false,
			leftPressed: false,
			circle: false,
			noPlay: true,
			isPlaying: false,
		}
	},
	mounted() {
		document.addEventListener("keydown", this.keyDownEnter);
	},
	methods:{
		begin(){
			this.isPlaying=true;
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

				vm.circle = setInterval(vm.draw, 4);

			},
			reload(){
				document.location.reload();
			},
			keyDownEnter(e){
				if (this.isPlaying==false) {
					if(e.keyCode == 13){
						this.begin()
					}
				}
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
				this.score += 5;
			},
			drawScore(){
				this.ctx.beginPath();
				this.ctx.font = "15px Arial";
				this.ctx.fillText("Score: " + this.score, 620, 20);
				this.ctx.closePath();
			},
			drawBall(){
				this.ctx.beginPath();
				this.ctx.arc(this.x, this.y, this.ballRadius, 0, Math.PI*2);
				this.ctx.fillStyle = "#ff0000";
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
				        // alert("GAME OVER");
				        this.sendScoreToParent(this.score);
				        this.score = 0;
				        this.isPlaying= false;
				        this.noPlay = !this.noPlay;
				        clearInterval(this.circle);
				    }
				}

				this.x += this.dx;
				this.y += this.dy;

				this.drawPaddle();

				if(this.rightPressed && this.paddleX < this.canvas.width-this.paddleWidth) {
					this.paddleX += 3;
				}
				else if(this.leftPressed && this.paddleX > 0) {
					this.paddleX -= 3;
				}

			},
			sendScoreToParent(score){
				this.$emit('getScoreFromChild', score)
			}
		}

	};

	</script>

	<style scoped>
	canvas {
		background: #eee; 
		display: block; 
		margin: 50px auto;
	}
	.btn-play{
		outline: none;
		background-color: #307492;
		color: white;
		font-size: 24px;
		font-weight: bold;
		border-radius: 15px;
		padding-left: 20px;
		padding-right: 20px;
	}
	.btn-play:hover{
		background-color: white;
		color: #307492;
	}
	.play-game{
		text-align: center;
		margin-top: 50px;
	}
	</style>