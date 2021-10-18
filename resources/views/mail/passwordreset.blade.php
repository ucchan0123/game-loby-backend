@extends('mail.layouts.main')

@section('body')
<div>
    <br>
    パスワードの再設定をするには、以下のリンクをクリックしてください。<br />
    <a href="{{ $reset_url }}">パスワードの変更</a><br />
    <br />
    このメールに心当たりがない場合は恐れ入りますが、削除してください。<br />
</div>
<br>
@include('mail.layouts.footer')

@endsection