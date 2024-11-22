<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/logo.png')}}" type="image/x-icon">
    <title>@yield('code') - @yield('title')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .error-container {
            text-align: center;
            max-width: 600px;
            width: 100%;
            padding: 40px 20px;
            animation: fadeIn 0.5s ease-out;
        }

        .error-icon {
            width: 150px;
            height: 150px;
            margin: 0 auto 50px;
            position: relative;
        }

        .error-code {
            position: absolute;
            top: 0;
            right: -20px;
            background: #ffebee;
            color: #e53935;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
        }

        .error-title {
            font-size: 32px;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .error-message {
            background: #d3d4f3;
            padding: 20px;
            border-radius: 10px;
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .button-group {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .button {
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .button-primary {
            background: rgb(26, 35, 126);
            color: white;
        }

        .button-secondary {
            background: #e53935;
            color: white;
        }

        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0,0,0,0.15);
        }

        .smile-icon {
            width: 150px;
            height: 150px;
            border: 6px solid rgb(26, 35, 126);
            border-radius: 50%;
            position: relative;
            margin: 0 auto;
        }

        .smile-icon::before {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: rgb(26, 35, 126);
            border-radius: 50%;
            left: 35px;
            top: 45px;
        }

        .smile-icon::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: rgb(26, 35, 126);
            border-radius: 50%;
            right: 35px;
            top: 45px;
        }

        .smile {
            width: 80px;
            height: 40px;
            border: 6px solid rgb(26, 35, 126);
            border-radius: 0 0 40px 40px;
            border-top: 0;
            position: absolute;
            bottom: 35px;
            left: 29px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 480px) {
            .error-title {
                font-size: 24px;
            }

            .error-message {
                font-size: 14px;
            }

            .button {
                width: 100%;
                margin: 5px 0;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">

        <div>
            @yield('content')
        </div>
        @include('errors.boutton_error')
    </div>
</body>
</html>
