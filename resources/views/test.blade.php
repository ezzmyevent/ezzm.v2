<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Overlay</title>
    <style>
        .container {
            position: relative;
            width: 100%;
        }

        .container img {
            width: 100%;
            height: auto;
        }

        .bottom-left {
            position: absolute;
            bottom: 8px;
            left: 16px;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 5px;
            border-radius: 5px;
        }

        .top-left {
            position: absolute;
            top: 8px;
            left: 16px;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 5px;
            border-radius: 5px;
        }

        .top-right {
            position: absolute;
            top: 8px;
            right: 16px;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 5px;
            border-radius: 5px;
        }

        .bottom-right {
            position: absolute;
            bottom: 8px;
            right: 16px;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 5px;
            border-radius: 5px;
        }

        .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="https://ezzmyevent.com/images/Download%20Now!!!.png" alt="Snow">
        <div class="bottom-left">Bottom Left</div>
        <div class="top-left">Top Left</div>
        <div class="top-right">Top Right</div>
        <div class="bottom-right">Bottom Right</div>
        <div class="centered">Centered</div>
    </div>
</body>
</html>
