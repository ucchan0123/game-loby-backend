@extends('mail.layouts.main')

@section('body')
<div>
    <br>
    {{ $params['name'] }}様<br>
    <br>
    ユーザー登録を完了するには、以下のリンクをクリックしてください。<br>
    <a href="{{ $params['activation_url'] }}">ユーザーを有効にする</a><br>
    <br>
    このメールに心当たりがない場合は恐れ入りますが、削除してください。<br>
</div>
<br>
@include('mail.layouts.footer')

@endsection