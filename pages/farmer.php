<?php http_response_code(404); ?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
      <link rel="icon" href="../assets/images/authentication/image.png" type="image/x-icon">
    <title>404 ไม่พบหน้านี้</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url(https://fonts.googleapis.com/css?family=Oswald:400,700);

        html,
        body {
            height: 100%;
            width: 100%;
            margin: 0;
            padding: 0;
            background: #242424;
            font-family: 'Oswald', sans-serif;
            background: -webkit-canvas(noise);
            background: -moz-element(#canvas);
            overflow: hidden;
        }

        html::after {
            content: '';
            background: radial-gradient(circle, rgba(0, 0, 0, 0), rgba(0, 0, 0, 1));
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }

        .center {
            height: 400px;
            width: 500px;
            position: absolute;
            top: calc(50% - 200px);
            left: calc(50% - 250px);
            text-align: center;
        }

        h1,
        p,h3 {
            margin: 0;
            padding: 0;
            -webkit-animation: funnytext 4s ease-in-out infinite;
            animation: funnytext 4s ease-in-out infinite;
        }

        h1{
            font-size: 16rem;
            color: rgba(0, 0, 0, 0.3);
            -webkit-filter: blur(3px);
            filter: blur(3px);
        }
        h3 {
            font-size: 8rem;
            color: rgba(0, 0, 0, 0.3);
            -webkit-filter: blur(3px);
            filter: blur(3px);
        }

        p {
            font-size: 2rem;
            color: rgba(0, 0, 0, 0.6);
        }

        body::after,
        body::before {
            content: ' ';
            display: block;
            position: absolute;
            left: 0;
            right: 0;
            top: -4px;
            height: 4px;
            -webkit-animation: scanline 8s linear infinite;
            animation: scanline 8s linear infinite;
            opacity: 0.33;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.5) 90%, rgba(0, 0, 0, 0)), -webkit-canvas(noise);
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.5) 90%, rgba(0, 0, 0, 0)), -moz-element(canvas);
        }

        body::before {
            -webkit-animation-delay: 4s;
            animation-delay: 4s;
        }

        @-webkit-keyframes scanline {
            0% {
                top: -5px;
            }

            100% {
                top: 100%;
            }
        }

        @keyframes scanline {
            0% {
                top: -5px;
            }

            100% {
                top: 100%;
            }
        }

        @-webkit-keyframes funnytext {
            0% {
                color: rgba(0, 0, 0, 0.3);
                -webkit-filter: blur(3px);
            }

            30% {
                color: rgba(0, 0, 0, 0.5);
                -webkit-filter: blur(1px);
            }

            65% {
                color: rgba(0, 0, 0, 0.2);
                -webkit-filter: blur(5px);
            }

            100% {
                color: rgba(0, 0, 0, 0.3);
                -webkit-filter: blur(3px);
            }
        }

        @keyframes funnytext {
            0% {
                color: rgba(0, 0, 0, 0.3);
                filter: blur(3px);
            }

            30% {
                color: rgba(0, 0, 0, 0.5);
                filter: blur(1px);
            }

            65% {
                color: rgba(0, 0, 0, 0.2);
                filter: blur(5px);
            }

            100% {
                color: rgba(0, 0, 0, 0.3);
                filter: blur(3px);
            }
        }
    </style>
</head>

<body>
    <canvas id="canvas" class="canvas" hidden></canvas>
    <div class="center">
        <h3>KTIS</h3>
        <h1>404</h1>

        <p>PAGE NOT FOUND.</p>
    </div>
    <script>
        var canvas = document.getElementById('canvas'),
            context = canvas.getContext('2d'),
            height = canvas.height = 256,
            width = canvas.width = height,
            bcontext = 'getCSSCanvasContext' in document ? document.getCSSCanvasContext('2d', 'noise', width, height) : context;
        noise();

        function noise() {
            requestAnimationFrame(noise);
            var idata = context.getImageData(0, 0, width, height);
            for (var i = 0; i < idata.data.length; i += 4) {
                idata.data[i] = idata.data[i + 1] = idata.data[i + 2] = Math.floor(Math.random() * 255);
                idata.data[i + 3] = 255;
            }
            bcontext.putImageData(idata, 0, 0);
        }
    </script>
</body>

</html>