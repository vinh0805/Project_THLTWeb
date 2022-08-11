@extends('layout')

@section('content')
    <?php
    use Illuminate\Support\Facades\Session;
    $user = Session::get('sUser');
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card" id="charCard">
                    <div class="card-header" id="chatHeader">Pet Forum Messengers</div>

                    <div id="app">
                        @if(isset($user))
                            <chat-app :user="{{$user}}"></chat-app>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection
