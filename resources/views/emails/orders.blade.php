@component('mail::message')
# Welcome to Our Assignment Art Service
Dear {{$order->user_name}},
<br>
We look forward to communicating more with you.<br> For more information visit our @component('mail::button',['url' => url('/blogs')])
Visit Website Blogs.
@endcomponent
If you want to Contact Us then text on this whatsapp Number :
@component('mail::button',['url' => url('/')])
Your Order Placed Successfully
@endcomponent
Thanks,<br>
Assignment Art
@endcomponent