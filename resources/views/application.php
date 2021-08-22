<html lang="de">
<head>
    <title>MapNode</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- ======================================================= -->
    <!--                START MAPNODE EINBINDUNG                 -->
    <!-- ======================================================= -->

    <!-- javascript -->
    <script src="/assets/js/mapnode.js"></script>
    <script src="/assets/js/swal.js"></script>
    <script src="https://adressomat.de/api/serve/js/adressomat.js"></script>
    <script src="https://adressomat.de/api/serve/js/autocomplete.js"></script>
    <script src="https://adressomat.de/api/serve/js/mapbox-gl.js"></script>
    <!-- css -->
    <link rel="stylesheet" href="https://adressomat.de/api/serve/css/autocomplete.css"/>
    <link rel="stylesheet" href="https://adressomat.de/api/serve/css/mapbox-gl.css"/>
    <style>
        .mapNode, .swal2-container, .adressomat-suggestions {
            font-family: "Tahoma", sans-serif;
            line-height: 1.5em;
        }

        .swal2-title, .swal2-html-container {
            text-align: left !important;
        }

        .swal2-styled.swal2-confirm, .mapNode.button {
            background: #236EFC;
            display: block;
            text-align: center;
        }

        .swal2-styled.swal2-confirm:focus, .mapNode.button:focus {
            box-shadow: 0 0 0 3px rgba(35, 110, 252, 0.3);
        }
        .swal2-styled.swal2-confirm.secondary, .mapNode.button.secondary {
            background: #898989;
        }

        .swal2-actions {
            align-items: start;
            justify-content: start;
            margin: 1.25em 22px 0;
        }

        .mapNode.button {
            padding: 8px 18px;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
        }

        .mapNode.input, textarea.mapNode, select.mapNode {
            width: calc(50% - 7px);
            box-sizing: border-box;
            border-radius: 5px;
            padding: 10px;
            margin-right: 7px;
            outline: none;
            border: 3px solid #C0C0C0;
            transition: all .25s;
            margin-bottom: 12px;
            font-size: 1rem;
        }

        .mapNode.input.floating {
            width: 350px;
            max-width: calc(100% - 40px);
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 1;
            padding: 10px 14px;
            box-shadow: 0 0 40px 8px rgba(0, 0, 0, 0.10);

        }

        .swal2-html-container b {
            display: block;
            margin-bottom: 12px;
            margin-top: 12px;
        }

        .mapNode.input.bigger {
            width: calc(70% - 7px);
        }

        .mapNode.input.smaller {
            width: calc(30% - 7px);
        }

        .mapNode.input.half {
            width: calc(50% - 7px);
        }

        .mapNode.input.full, textarea.mapNode.full, select.mapNode.full {
            width: calc(100% - 7px);
        }

        .mapNode.input:focus {
            border: 3px solid #236EFC;
        }

        .marker {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-left: -15px;
            margin-top: -30px;
            background-repeat: no-repeat;
            background-size: 30px;
            background-position: center center;
            padding: 8px;
            box-sizing: border-box;
        }

        .mapNode.message {
            width: 80%;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            border-bottom-right-radius: 15px;
            background: #dfdfdf;
            padding: 20px;
            margin-right: 50px;
            box-sizing: border-box;
            margin-bottom: 10px;
            text-align: left;
        }

        .mapNode.message .from {
            margin-top: 5px;
            display: block;
            width: 100%;
            font-size: 0.75rem;
            color: #757575;
        }
    </style>

    <script>
        window.addEventListener("load", function () {
            let mapNode = new MapNode({
                mandantenID: "{{ mandant }}",
                adressOMatAccessToken: "{{ token }}",
                apiUrl: "/api"
            });
            mapNode.init({
                container: document.querySelector(".mapNode#container")
            })
        })
    </script>

    <!-- ======================================================= -->
    <!--                 ENDE MAPNODE EINBINDUNG                 -->
    <!-- ======================================================= -->

    <style>
        body, html {
            padding: 0;
            margin: 0;
        }

        .mapNode#container {
            position: relative;
            width: 100%;
            height: 100vh;
            background: #dfdfdf;
            border-radius: 5px;
            touch-action: none;
        }
    </style>
</head>
<body>
<div class="mapNode" id="container">
    <input class="mapNode input floating" type="search" adressomat-autocomplete="name"
           adressomat-autofill="attributes.street" placeholder="Nach Adresse suchen">
    <!-- Hier wird die MapNode Anwendung geladen -->
</div>
</body>

</html>