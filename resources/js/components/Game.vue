<template>

	<div class="game">
		<div class="top-ten"> <!-- list top ten -->
			<TopTen ref="form"></TopTen>
		</div>

		<div class="play-game"> 
			<PlayGame @getScoreFromChild="afterGetScore"></PlayGame>
		</div>
	</div>

</template>


<script>
	import TopTen from './TopTen.vue' //import file TopTen.vue dưới dạng component tên là TopTen
	import PlayGame from './PlayGame.vue' //import file PlayGame.vue dưới dạng component tên là PlayGame

	export default{
		components:{
			TopTen,
			PlayGame
		},

		created(){
			var url_string = window.location.href
			var url = new URL(url_string)
			var user_name = url.searchParams.get("name")
			
			this.username = user_name
		},

		data(){
			return{
				username: '',
			}
		},

		methods:{
			afterGetScore(score){
				axios.post('/scores',{name: this.username, score: score})// gửi lên db username và score
				.then(response=>{
					console.log(response.data.result),
					this.$refs.form.getTopTen()//chạy lại hàm getTopTen của component TopTen để làm mới Top10
				})
			}
		}
	};
</script>
<style scoped>
.game {  
	display: -ms-flexbox; 
	display: flex;
	-ms-flex-wrap: wrap;
	flex-wrap: wrap;
	padding: 0px;
}

.top-ten {
	-ms-flex: 25%; 
	flex: 25%;
	background-color: #f1f1f1;
	padding: 0px;
	height: 608px;
}
.play-game {   
	-ms-flex: 75%;
	flex: 75%;
	background-color: white;
	padding: 0px;
}
</style>