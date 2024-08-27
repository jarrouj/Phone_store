<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
    font-family: 'Roboto', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    text-align: center;
    background-color: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
}

.success-icon {
    margin-bottom: 20px;
}

.success-icon img {
    width: 96px;
    height: 96px;
}

h1 {
    color: #28a745;
    font-size: 24px;
    margin-bottom: 10px;
}

.message {
    font-size: 16px;
    color: #555;
    margin-bottom: 30px;
}

.button {
    display: inline-block;
    padding: 12px 20px;
    background-color: #28a745;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: 500;
    transition: background-color 0.3s;
}

.button:hover {
    background-color: #218838;
}

.button-secondary {
    display: inline-block;
    padding: 12px 20px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: 500;
    margin-top: 10px;
    transition: background-color 0.3s;
}

.button-secondary:hover {
    background-color: #0069d9;
}

    </style>
</head>
<body>
    <div class="container">
        <div class="success-icon">
            <img src="https://img.icons8.com/color/96/checkmark--v1.png" alt="Success">
        </div>
        <h1>Payment Successful!</h1>
        <p class="message">Thank you for your payment. Your transaction was completed successfully, and a receipt has been sent to your email.</p>
        <a href="{{ url('/') }}" class="button">Go to Home</a>
        {{-- <a href="#" class="button-secondary">View Receipt</a> --}}
    </div>
</body>
</html>
