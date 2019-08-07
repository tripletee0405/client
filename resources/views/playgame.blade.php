<!-- <?php 
    //session_start();
 ?> -->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Game</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="/css/app.css">
        <a href=""></a>
    </head>
    <body>
        <?php 
            if(isset($_SESSION['playerName'])&&isset($_GET['name'])){
                $ss_name = $_SESSION['playerName'];
                $get_name = $_GET['name'];
                if($ss_name == $get_name){
                    echo '<div id="app">';
                    // echo '<div>'.$_SESSION['playerName'].'</div>';
                    // echo '<div>'.$_GET['name'].'</div>';
                    echo '<playgame></playgame>';
                    echo '</div>';
                }else{
                    echo '<h1>You are not login</h1>';
                    echo '<a href="/auth/passport">Back to Login Page</a>';
                }
            }
            else{
                echo '<h1>Bạn Chưa Đăng Nhập</h1>';
            }
         ?>
        <!-- <div id="app">
            <home-game></home-game>
        </div> -->
        <script src="/js/app.js" type="text/javascript"></script>
    </body>
</html>