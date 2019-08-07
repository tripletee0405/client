<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Wanna Play?</title>
	<style>
		body{
			background-image: url(https://images.playerslounge.co/img/homepage/hero-background.png);
			width: 100%;
			background-size: 1320px 650px;
			background-repeat: no-repeat;
			height: 650px;
		}
		button{
			cursor: pointer;
			color: #4f5616;
			font-weight: bold;
			font-size: 13px;
			background-color: #2ec1ab;
			border-radius: 20px;
			height: 50px;
			margin-top: 320px;
			margin-left: 612px;
			outline: none;
		}
		a {
			margin-left: 515px;
			text-decoration: none;
			color: red;
		}
	}
</style>
</head>
<body>
	<button onclick="window.location.href='/auth/passport'">Play Game</button>
	<br>
	<br>
	<a href="/register">You don't have an account? Register now!</a>
</body>
</html>
