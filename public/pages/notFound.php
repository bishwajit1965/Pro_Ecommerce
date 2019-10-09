<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Page Not Found</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
        * {
            line-height: 1.2;
            margin: 0;
        }

        html {
            color: #888;
            display: table;
            font-family: sans-serif;
            height: 100%;
            /* text-align: center; */
            width: 100%;
        }

        body {
            display: table-cell;
            vertical-align: middle;
            margin: 2em auto;
        }

        .not-foundh1 {
            color: #555;
            font-size: 2em;
            font-weight: 900;
            color: red;
            text-align: center;
        }

        .not-found {
            margin: 0 auto;
            width: 100%;
            font-weight: 900;
            text-align: center;
        }

        @media only screen and (max-width: 280px) {

            body,
            p {
                width: auto;
            }

            h1 {
                font-size: 1.5em;
                margin: 0 0 0.3em;
                color: red;
            }
        }

        /* Blinker */
        .blink_me {
            animation: blinker 1s linear infinite;
            color: red;
        }

        @keyframes blinker {
            50% {
                opacity: 0.4;
            }
        }

        .message {
            padding-top: 20px;
            padding-bottom: 40px;
        }
        </style>
    </head>

    <body>
        <div class="container blink_me message">
            <h1 class="not-foundh1"> Products Not Found !!! No product exists in this brand.</h1>
            <p class="not-found"><strong>SORRY !!!</strong> the products you were trying to view are not available yet.
            </p>
        </div>
    </body>

</html>