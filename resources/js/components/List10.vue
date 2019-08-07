<template>
	<div class="top-highscore">
		<h3>TOP 10 HIGH SCORE</h3>
		<table>
			<tr>
				<th style="color: green;">Avatar</th>
				<th style="color: blue;">Name</th>
				<th style="color: red;">Score</th>
			</tr>	
			<tr v-for="player in Listplayer">
				<td><img v-bind:src="player.img" alt=""></td>
				<td>{{player.name}}</td>
				<td>{{player.score}}</td>
			</tr>
		</table>
	</div>
</template>
<script>
	export default{
		data(){
			return{
				Listplayer:[{

				}]
			}
		},
		created(){
			this.getList10()
		},
		methods:{
			getList10(){
				axios.get('/scores')
    			.then(response=>{
    				this.Listplayer = response.data
    			})
			}
		}
	};
</script>
<style scoped>
	img{
		width:  50px;
		height: 50px;
	}
	td{
		border-bottom: 1px solid grey;
	}
	.top-highscore{
		text-align: center;
	}
	table{
		width: 100%;	
	}
	table th{
		font-size: 20px;
	}
</style>