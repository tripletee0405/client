<template>
	<div class="game-calling">
		
        <div class="list-top10">
        	<List ref="form"></List>
        </div>
        <div class="play-game">
        	<Play @getScoreFromChild="afterGetScore"></Play>
        </div>
    </div>
</template>
<script>
	import List from './List10.vue'
	import Play from './Play.vue'

	export default{
		components:{
			List,
			Play
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
				//luu score va user vao db
				axios.post('/scores',{name: this.username, score: score})
    			.then(response=>{
    				console.log(response.data.result),
    				//goi lai ham getlistTop10 cua component con List
    				this.$refs.form.getList10()
    			})
			}
		}
	};
</script>
<style scoped>
	.game-calling {  
	  display: -ms-flexbox; 
	  display: flex;
	  -ms-flex-wrap: wrap;
	  flex-wrap: wrap;
	  padding: 0px;
	}

	.list-top10 {
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