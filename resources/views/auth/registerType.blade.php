<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Register Type</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .container h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .button {
            display: block;
            text-decoration: none;
            margin: 10px 0;
            padding: 15px 20px;
            border-radius: 5px;
            font-size: 18px;
            color: #fff;
            background-color: #007bff;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .button.patient {
            background-color: #28a745;
        }

        .button.patient:hover {
            background-color: #1e7e34;
        }
    </style>
</head>
<body>
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <div class="container">
        <h1>Registration</h1>
        <a href="{{route('donor.showRegisterForm')}}" class="button">Donor <i class="fa-solid fa-hand-holding-droplet"></i></a>
        <a href="{{route('patient.showRegisterForm')}}" class="button patient">Patient <i class="fa-solid fa-bed"></i></a>
    </div>
</body>
</html>
