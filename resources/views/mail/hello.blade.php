<h1>Order Confirmation</h1>

<p>Thank you for your order!</p>

@if($nearestExpirationDate)
    <p>Please come and get your order before this day: <strong>{{ $nearestExpirationDate }}</strong> (near expired medicine).</p>
@endif


<p>We appreciate your business!</p>
