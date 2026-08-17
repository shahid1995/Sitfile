<!DOCTYPE html>
<html>
<head>
    <title>Paypal Integration</title>
    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
    <div class="w3-container">
        @if($message = \Session::get('success'))
        <div class="w3-panel w3-green w3-display-container">
            <span onclick="this.parentElement.style.display='none'" 
            class="w3-button w3-green w3-large w3-display-topright">&times;</span>
            <p>{!! $message !!}</p>
        </div>
        <?php \Session::forget('success') ?>
        @endif

         @if($message = \Session::get('error'))
        <div class="w3-panel w3-green w3-display-container">
            <span onclick="this.parentElement.style.display='none'" 
            class="w3-button w3-green w3-large w3-display-topright">&times;</span>
            <p>{!! $message !!}</p>
        </div>
        <?php \Session::forget('error') ?>
        @endif

        <form class="w3-container w3-display-middle w3-card-4 w3-padding-16 " method="POST" role="payment-form" 
        action="{!! URL::to('paypal')!!}">

            <div class="w3-container w3-teal w3-padding-16">Paywith Paypal</div>
            {{ csrf_field() }}
            <h2 class="w3-text-blue">Payment Form</h2>
            <p>Demo Paypal Form</p>
            <label class="w3-test-blue">For Premium registration You need to pay ${{ $amount }} per month</label>
            <input type="hidden" class="w3-input w3-border" id="amount" name="amount" value="{{ $amount }}">
            <button class="w3-btn w3-blue">Pay With Pyapal</button>

        </form>
    </div>
</body>
</html>