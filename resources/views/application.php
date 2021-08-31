<html lang="de">
<head>
    <title>MapNode</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- ======================================================= -->
    <!--             START: INCLUDE VON JS & CSS                 -->
    <!-- ======================================================= -->

    <!-- javascript -->
    <script src="/assets/js/mapnode.js"></script>
    <script src="/assets/js/swal.js"></script>
    <script src="https://adressomat.de/api/serve/js/adressomat.js"></script>
    <script src="https://adressomat.de/api/serve/js/autocomplete.js"></script>
    <script src="https://adressomat.de/api/serve/js/mapbox-gl.js"></script>
    <!-- css -->
    <link rel="stylesheet" href="/assets/css/mapnode.css"/>
    <link rel="stylesheet" href="https://adressomat.de/api/serve/css/autocomplete.css"/>
    <link rel="stylesheet" href="https://adressomat.de/api/serve/css/mapbox-gl.css"/>

    <script>
        window.addEventListener("load", function () {
            let mapNode = new MapNode({
                mandantenID: "{{ mandant }}",
                adressOMatAccessToken: "{{ token }}",
                apiUrl: "/api"
            });
            mapNode.init({
                container: document.querySelector(".mapNode#container"),
                callback: function() {
                    // jump to entry after loading the map
                    mapNode.jumpToEntry({
                        entry: "{{ entry_id }}"
                    })
                }
            })
        })
    </script>

    <!-- ======================================================= -->
    <!--               END: INCLUDE VON JS & CSS                 -->
    <!-- ======================================================= -->

    <style>
        body, html {
            padding: 0;
            margin: 0;
        }

        .mapNode, .swal2-container, .adressomat-suggestions {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }

        /**
        DIESER TEIL IST OPTIONAL - EIN STYLE FÜR DEN CONTAINER WIRD ALLERDINGS BENÖTIGT
         */
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

<!-- ======================================================= -->
<!--                START: MAPNODE CONTAINER                 -->
<!-- ======================================================= -->
<div class="mapNode" id="container">
    <input class="mapNode input floating" type="search" adressomat-autocomplete="name"
           adressomat-autofill="attributes.street" placeholder="Nach Adresse suchen">
    <div class="mapNode hint" id="mapNodeHint">Klicken Sie auf die Karte, oder geben Sie eine Adresse ein, um einen neuen Marker zu setzen und einen neuen Eintrag erstellen zu können.</div>
    <!-- Hier wird die MapNode Anwendung geladen -->
</div>
<!-- ======================================================= -->
<!--                END: MAPNODE CONTAINER                 -->
<!-- ======================================================= -->

</body>

</html>