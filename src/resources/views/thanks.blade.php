@extends('layouts.thanks')

@section('content')
<link href="{{ asset('css/thanks.css') }}" rel="stylesheet">

<div class="thanks_content">
    <div class="thanks_message">お問い合せありがとうございました</div>
    
    <!-- ホームボタン -->
    <div class="home">
        <form action="/" method="GET">
            <button type="submit" class="home_button">HOME</button>
        </form>
    </div>
</div>
@endsection
