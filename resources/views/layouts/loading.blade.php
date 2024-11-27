{{--
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading...</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #627254;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loader {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loader::before {
            content: "";
            background: rgba(255, 255, 255, 0);
            backdrop-filter: blur(8px);
            position: absolute;
            width: 140px;
            height: 55px;
            z-index: 20;
            border-radius: 0 0 10px 10px;
            border: 1px solid rgba(255, 255, 255, 0.274);
            border-top: none;
            box-shadow: 0 15px 20px rgba(0, 0, 0, 0.082);
            animation: anim2 2s infinite;
        }

        .loader div {
            background: rgb(228, 228, 228);
            border-radius: 50%;
            width: 25px;
            height: 25px;
            z-index: -1;
            animation: anim 2s infinite linear;
            animation-delay: calc(-0.3s * var(--i));
            transform: translateY(5px);
            margin: 0.2em;
        }

        @keyframes anim {

            0%,
            100% {
                transform: translateY(5px);
            }

            50% {
                transform: translateY(-65px);
            }
        }

        @keyframes anim2 {

            0%,
            100% {
                transform: rotate(-10deg);
            }

            50% {
                transform: rotate(10deg);
            }
        }
    </style>
</head>

<body>
    <div class="loader" id="loader">
        <div style="--i: 1"></div>
        <div style="--i: 2"></div>
        <div style="--i: 3"></div>
        <div style="--i: 4"></div>
    </div>

    <script>
        setTimeout(function() {
        // document.getElementById('loader').style.display = 'none';
        window.location.href = '/welcome';
    }, 2000);
    </script>

</body>

</html> --}}

{{-- loader design 2 --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Loading....</title>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Amatic+SC");

        body {
            background-color: #000000;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h1 {
            margin: 0;
            font-family: "Amatic SC", cursive;
            font-size: 6vh;
            color: #ffffff;
            opacity: 0.75;
            animation: pulse 2.5s linear infinite;
            text-align: center;
        }

        #cooking {
            position: relative;
            width: 30vw; /* Adjusted for responsiveness */
            height: 30vw; /* Adjusted for responsiveness */
            max-width: 250px; /* Maximum width to maintain visual consistency */
            max-height: 250px; /* Maximum height to maintain visual consistency */
        }

        #cooking .bubble {
            position: absolute;
            border-radius: 100%;
            box-shadow: 0 0 0.25vh #4d4d4d;
            opacity: 0;
        }

        #cooking .bubble:nth-child(1) {
            margin-top: 2vh;
            left: 58%;
            width: 5%; /* Responsive size */
            height: 5%; /* Responsive size */
            background-color: #454545;
            animation: bubble 2s cubic-bezier(0.53, 0.16, 0.39, 0.96) infinite;
        }

        #cooking .bubble:nth-child(2) {
            margin-top: 3vh;
            left: 52%;
            width: 4%; /* Responsive size */
            height: 4%; /* Responsive size */
            background-color: #3d3d3d;
            animation: bubble 2s ease-in-out 0.35s infinite;
        }

        #cooking .bubble:nth-child(3) {
            margin-top: 1.8vh;
            left: 50%;
            width: 3%; /* Responsive size */
            height: 3%; /* Responsive size */
            background-color: #333;
            animation: bubble 1.5s cubic-bezier(0.53, 0.16, 0.39, 0.96) 0.55s infinite;
        }

        #cooking .bubble:nth-child(4) {
            margin-top: 2.7vh;
            left: 56%;
            width: 2.5%; /* Responsive size */
            height: 2.5%; /* Responsive size */
            background-color: #2b2b2b;
            animation: bubble 1.8s cubic-bezier(0.53, 0.16, 0.39, 0.96) 0.9s infinite;
        }

        #cooking .bubble:nth-child(5) {
            margin-top: 2.7vh;
            left: 63%;
            width: 2%; /* Responsive size */
            height: 2%; /* Responsive size */
            background-color: #242424;
            animation: bubble 1.6s ease-in-out 1s infinite;
        }

        #cooking #area {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 50%;
            height: 50%;
            background-color: transparent;
            transform-origin: 15% 60%;
            animation: flip 2.1s ease-in-out infinite;
        }

        #cooking #area #sides {
            position: absolute;
            width: 100%;
            height: 100%;
            transform-origin: 15% 60%;
            animation: switchSide 2.1s ease-in-out infinite;
        }

        #cooking #area #sides #handle {
            position: absolute;
            bottom: 10%;
            right: 80%;
            width: 25%;
            height: 10%;
            background-color: transparent;
            border-top: 1vh solid #333;
            border-left: 1vh solid transparent;
            border-radius: 100%;
            transform: rotate(20deg) rotateX(0deg) scale(1.3, 0.9);
        }

        #cooking #area #sides #pan {
            position: absolute;
            bottom: 20%;
            right: 30%;
            width: 50%;
            height: 8%;
            background-color: #333;
            border-radius: 0 0 1.4em 1.4em;
            transform-origin: -15% 0;
        }

        #cooking #area #pancake {
            position: absolute;
            top: 24%;
            width: 100%;
            height: 100%;
            transform: rotateX(85deg);
            animation: jump 2.1s ease-in-out infinite;
        }

        #cooking #area #pancake #pastry {
            position: absolute;
            bottom: 26%;
            right: 37%;
            width: 40%;
            height: 45%;
            background-color: #333;
            box-shadow: 0 0 3px 0 #333;
            border-radius: 100%;
            transform-origin: -20% 0;
            animation: fly 2.1s ease-in-out infinite;
        }

        @keyframes jump {
            0% {
                top: 24%;
                transform: rotateX(85deg);
            }

            25% {
                top: 10%;
                transform: rotateX(0deg);
            }

            50% {
                top: 30%;
                transform: rotateX(85deg);
            }

            75% {
                transform: rotateX(0deg);
            }

            100% {
                transform: rotateX(85deg);
            }
        }

        @keyframes flip {
            0% {
                transform: rotate(0deg);
            }

            5% {
                transform: rotate(-27deg);
            }

            30%,
            50% {
                transform: rotate(0deg);
            }

            55% {
                transform: rotate(27deg);
            }

            83.3% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(0deg);
            }
        }

        @keyframes switchSide {
            0% {
                transform: rotateY(0deg);
            }

            50% {
                transform: rotateY(180deg);
            }

            100% {
                transform: rotateY(0deg);
            }
        }

        @keyframes fly {
            0% {
                bottom: 26%;
                transform: rotate(0deg);
            }

            10% {
                bottom: 40%;
            }

            50% {
                bottom: 26%;
                transform: rotate(-190deg);
            }

            80% {
                bottom: 40%;
            }

            100% {
                bottom: 26%;
                transform: rotate(0deg);
            }
        }

        @keyframes bubble {
            0% {
                transform: scale(0.15, 0.15);
                top: 80%;
                opacity: 0;
            }

            50% {
                transform: scale(1.1, 1.1);
                opacity: 1;
            }

            100% {
                transform: scale(0.33, 0.33);
                top: 60%;
                opacity: 0;
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1, 1);
                opacity: 0.25;
            }

            50% {
                transform: scale(1.2, 1);
                opacity: 1;
            }

            100% {
                transform: scale(1, 1);
                opacity: 0.25;
            }
        }
    </style>
</head>

<body>

    <h1>Cooking in progress..</h1>
    <div id="cooking">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div id="area">
            <div id="sides">
                <div id="pan"></div>
                <div id="handle"></div>
            </div>
            <div id="pancake">
                <div id="pastry"></div>
            </div>
        </div>
    </div>

    <script>
        setTimeout(function() {
            // document.getElementById('loader').style.display = 'none';
            window.location.href = '/main';
        }, 2000);
    </script>

</body>

</html>

