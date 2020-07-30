<h2 style="
    background-color: #619c02;
    color: #f1f1f1;
    padding: 10px;
    text-align:  center;
    font-family: arial;
    border-radius: 8px 8px 0 0;
    margin-top: 20px;
    margin-bottom: 0px;
">Xác nhận tài khoản</h2>
<div style="
    border: solid 1px #b7b7b7;
    margin-top:  0px;
    border-radius: 0 0 8px 8px;
    background-color: #f1f1f1;
    padding:  10px;
">

    <p>Xin Chào <strong> {{$name}}</strong></p>
    <br/>
    <p>
        Tài khoản của bạn vừa được yêu cầu xác nhận.
        <br/>Nếu bạn thực sự thực hiện yêu cầu trên vui lòng nhấn <a href="{{route('confirmemail',['email'=>$email,'key'=>$key])}}"> vào đây</a>. Hoặc copy đường link sau và thực hiện truy cập trên trình duyệt của bạn.
        <br/>{{route('confirmemail',['email'=>$email,'key'=>$key])}}
        <br/>Ngược lại nếu bạn không thực hiện yêu cầu trên bạn có thể bỏ qua email này.
        <br/>Lưu ý: Link có thời gian sử dụng là 6 giờ.
    </p>
    <p>Thân mến</p>
</div>
