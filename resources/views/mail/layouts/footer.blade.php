<footer>
    <hr>
    【お問い合わせ先】<br />
    {{ config('mail.from.name') }}<br />
    {{ config('mail.from.address') }}<br />
    <br />
    TEL 03-6441-0275<br />
    <br />
    ※対応時間は平日10：00〜18：00です<br />
    ※メールの受付は24時間行っています<br />
    ※3営業日（土日祝除く）以内にご返信<br />
    <hr>
</footer>

@section('styles')
    @parent
    footer hr {
    text-align: left;
    width: 400px;
    margin-left: 0px;
    }
@endsection
