<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Delete Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(185, 168, 214);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }
        .container {
            text-align: center;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, p {
            margin-bottom: 20px;
        }
        .btn {
            background-color: #591f61;
            border: 1px solid rgb(23, 11, 29);
            color: white;
            padding: 5px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 2px 1px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #7d338c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>অ্যাকাউন্ট মুছে ফেলার নিশ্চিতকরণ</h1>
        <p>আপনি কি নিশ্চিত যে আপনি আপনার অ্যাকাউন্ট মুছে ফেলতে চান?</p>
        <form action="/confirm-delete-account/{{$user->id}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn">হ্যাঁ, আমার অ্যাকাউন্ট মুছে ফেলুন</button>
        </form>
        <a href="{{ url('/') }}"><button class="btn">বাতিল</button></a>
    </div>
</body>
</html>
