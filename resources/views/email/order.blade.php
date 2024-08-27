<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>

<body>


    <h3>
        Hello [shop name] Family, we wanted you to know that you received a new message from your website.
        Please Find the information provided below!
    </h3>
    <h4>Name: {{ $order->name }}</h4> 
    @foreach ($orderProducts as $orderProduct)
    <h4>Product ID: {{ $orderProduct->product_id }}</h4>
   @endforeach
</body>

</html>
