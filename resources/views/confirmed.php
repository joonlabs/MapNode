<html>
<head>
    <title>Erfolgreich bestätigt</title>
    <style>
        html, body {
            padding: 0;
            margin: 0;
            font-family: "Tahoma", sans-serif;
        }

        .content {
            width: 400px;
            max-width: 90%;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
            margin-top: 30vh;
        }

        .content svg {
            width: 50px;
            height: 50px;
            margin-bottom: 25px;
        }

        .content span {
            line-height: 1.5rem;
        }
    </style>
</head>
<body>
<div class="content">
    <div class="check">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2ECC71"
             stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
    </div>
    <span><strong>{{ subject }} wurde erfolgreich bestätigt.</strong><br>Sie können diese Seite jetzt schließen.</span>
</div>
</body>
</html>