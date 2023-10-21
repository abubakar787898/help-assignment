@component('mail::message')

Dear Admin,
<br>

New Order.<br> For more information visit  @component('mail::button',['url' => url('/admin/orders')])
plz Check New Order {{$order->id}}
@endcomponent
Customer Topic:{{$order->topic}}<br>
Customer Name:{{$order->user_name}}
<br>
Customer Email:{{$order->email}}
Thanks,<br>
Assignment Art
@endcomponent