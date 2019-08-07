@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>  
                    @endif
<!--                     <?php 
                        if (isset($_SESSION['playerName'])) {
                            $ss_name = $_SESSION['playerName'];
                            echo '<a href="/playgame?name='.$ss_name.'">Play</a>';
                        }
                     ?> -->
                     You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
