<div>
    <p>Xin chào bạn, </p>
    @if(!empty($nameUserDelete))   
        <p>Thông tin công ty khách hàng <b>{{ $nameCompany }} </b> vừa được xóa bởi: <b> {{ $nameUserDelete }} </b></p>      
    @else
    <p>Thông tin công ty khách hàng <b>{{ $nameCompany }} </b> vừa được xóa.</p>       
    @endif
    <p>Thời gian xóa : {{ $time }}</p>
   
    <p>Nếu bạn cần giúp đỡ vui lòng liên hệ bộ phận kỹ thuật của chúng tôi để được hỗ trợ.</p>
    <p>Email: contact@miichisoft.com hoặc hotline: (+84) 246 292 9109</p>
    <br />
    <p>Chân thành cảm ơn.</p>
</div>

