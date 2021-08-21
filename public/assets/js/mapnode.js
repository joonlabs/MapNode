class MapNode {

    /**
     * Creates a new MapNode object.
     *
     * @param id
     */
    constructor({mandantenID, adressOMatAccessToken, apiUrl} = {}) {
        let _this = this;

        this.mandantenID = parseInt(mandantenID)
        this.adressOMatAccessToken = adressOMatAccessToken
        this.apiUrl = apiUrl

        this.adressOMat = new AdressOMat({
            key: this.adressOMatAccessToken
        })

        AdressOMatInput.init({
            key: this.adressOMatAccessToken,
            callbacks: { //optional (is default)
                "clickResult": function (data) {
                    if(data.data.coordinates.lat !== null && data.data.coordinates.long !== null)
                        _this._setNewMarker(data)
                }
            },
        })
    }

    /**
     * Inits a MapNode view. Loads all entries and displays them.
     *
     * @param container
     */
    async init({container} = {}) {
        let _this = this;
        await this._loadMandant();

        console.debug(this.mandant)

        this.map = this.adressOMat.Map({
            container: container,
            latitude: this.mandant.karte_latitude,
            longitude: this.mandant.karte_longitude,
            zoom: this.mandant.karte_zoom
        })

        for (let eintrag of this.mandant.eintraege) {
            let marker = this.map.Marker({
                latitude: eintrag.latitude,
                longitude: eintrag.longitude,
            }).setPopup({
                content: "<h3>" + eintrag.name + "</h3>" +
                    // "<span>" + eintrag.inhalt + "</span>" +
                    "<div class='mapNode button'>Details ansehen</div>",
                offset: [0, -30]
            }).render({
                map: this.map
            })
            // set color
            marker.marker._element.style.backgroundImage = "url('data:image/svg+xml;utf8,<svg width=\"100%\" height=\"100%\" viewBox=\"0 0 24 24\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" xml:space=\"preserve\" xmlns:serif=\"http://www.serif.com/\" fill=\"%23" + eintrag.kategorie.farbe.substr(1) + "\" style=\"fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;\"><path d=\"M22,10C22,4.514 17.486,-0 12,0C6.514,0 2,4.514 2,10C2,13.025 3.52,15.891 5.387,18.225C8.079,21.59 11.445,23.832 11.445,23.832C11.781,24.056 12.219,24.056 12.555,23.832C12.555,23.832 15.921,21.59 18.613,18.225C20.48,15.891 22,13.025 22,10ZM12,6C9.792,6 8,7.792 8,10C8,12.208 9.792,14 12,14C14.208,14 16,12.208 16,10C16,7.792 14.208,6 12,6Z\"/></svg>')"
        }

        // enable klick on map
        // register an click event handler
        this.map.on({
            event: "click",
            handler: function (event) {
                // only use clicks on the canvas not on other elements like markers
                if(event.originalEvent.target.tagName !== "CANVAS")
                    return false

                // create new marker
                _this._setNewMarker({
                    data: {
                        coordinates: {
                            lat: event.lngLat.lat,
                            long: event.lngLat.lng,
                        }
                    }
                })
            }
        })
    }

    async _loadMandant() {
        // load mandanten information
        this.mandant = (await this._api({
            query: `query get($id:Int!){
                mandant(id:$id){
                    name
                    karte_latitude
                    karte_longitude
                    karte_zoom
                    eintraege{
                        name
                        latitude
                        longitude
                        inhalt
                        kategorie{
                            name
                            farbe
                        }
                    }
                }
            }`,
            variables: {id: this.mandantenID}
        })).data.mandant
    }

    /**
     * Sets a new grey marker.
     *
     * @param data
     * @private
     */
    _setNewMarker({data} = {}) {
        let _this = this
        let randomId = "button_" + Math.random().toString(36).substr(2)
        let marker = this.map.Marker({
            latitude: data.coordinates.lat,
            longitude: data.coordinates.long,
        }).setPopup({
            content: "<h3>Neuer Eintrag</h3>" +
                "<div class='mapNode button' id='" + randomId + "'>Hier Erstellen</div>",
            offset: [0, -30]
        }).render({
            map: this.map
        }).togglePopup()
        // set color
        marker.marker._element.style.backgroundImage = "url('data:image/svg+xml;utf8,<svg width=\"100%\" height=\"100%\" viewBox=\"0 0 24 24\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" xml:space=\"preserve\" xmlns:serif=\"http://www.serif.com/\" fill=\"%23C0C0C0\" style=\"fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;\"><path d=\"M22,10C22,4.514 17.486,-0 12,0C6.514,0 2,4.514 2,10C2,13.025 3.52,15.891 5.387,18.225C8.079,21.59 11.445,23.832 11.445,23.832C11.781,24.056 12.219,24.056 12.555,23.832C12.555,23.832 15.921,21.59 18.613,18.225C20.48,15.891 22,13.025 22,10ZM12,6C9.792,6 8,7.792 8,10C8,12.208 9.792,14 12,14C14.208,14 16,12.208 16,10C16,7.792 14.208,6 12,6Z\"/></svg>')"

        // fly to the new marker
        this.map.flyTo({
            latitude: data.coordinates.lat,
            longitude: data.coordinates.long,
            zoom: 18,
            maxDuration: 2500
        })

        // remove marker on close
        let markerClosed = false
        marker.marker._popup.on("close", function(){
            if(markerClosed) return
            markerClosed = true
            marker.remove()
        })

        // add onclick for button
        document.querySelector("#" + randomId).onclick = async function () {
            let formData = await _this._newEntryPopUp(_this)

            // create buerger
            let buergerId = (await _this._api({
                query: `mutation create($buerger: BuergerInput!){
                            erstelleBuerger(buerger: $buerger){
                                id
                            }
                        }`,
                variables: {
                    buerger: {
                        vorname: formData.vorname,
                        nachname: formData.nachname,
                        email: formData.email,
                        strasse: formData.strasse === "" ? null : formData.strasse,
                        hausnummer: formData.strasse === "" ? null : formData.hausnummer,
                        stadt: formData.stadt === "" ? null : formData.stadt,
                        plz: formData.plz === "" ? null : formData.plz,
                    }
                }
            })).data.erstelleBuerger.id

            // create eintrag
            let eintrag = (await _this._api({
                query: `mutation create($eintrag: EintragInput!){
                            erstelleEintrag(eintrag: $eintrag){
                                id
                                name
                                status
                                inhalt
                                latitude
                                longitude
                                kategorie{
                                    farbe
                                }
                                bestaetigt
                                chat_verfuegbar
                                erstellt
                            }
                        }`,
                variables: {
                    eintrag: {
                        name: formData.name,
                        inhalt: formData.inhalt === "" ? null : formData.inhalt,
                        latitude: data.coordinates.lat,
                        longitude: data.coordinates.long,
                        mandant_id: _this.mandantenID,
                        kategorie_id: formData.kategorie,
                        buerger_id: buergerId,
                    }
                }
            })).data

            _this._showEntrySuccessPopUp()
            markerClosed = true
            marker.setPopup({
                content: "<h3>Eintrag erstellt!</h3>" +
                    "Wir haben Ihnen zum <strong>Bestätigen</strong> eine E-Mail zugesandt.",
                offset: [0, -30]
            })
        }
    }

    async _newEntryPopUp() {
        let _this = this
        const {value: formValues} = await Swal.fire({
            title: "Neuen Eintrag anlegen",
            html:
                '<b>Persönliche Informationen</b>' +
                '<input id="vorname" class="mapNode input" placeholder="Vorname*">' +
                '<input id="nachname" class="mapNode input" placeholder="Nachname*">' +
                '<input id="email" class="mapNode input full" type="email" placeholder="E-Mail*">' +
                '<input id="strasse" class="mapNode input bigger" placeholder="Straße">' +
                '<input id="hausnummer" class="mapNode input smaller" placeholder="Hausnummer">' +
                '<input id="plz" class="mapNode input smaller" type="tel" placeholder="PLZ">' +
                '<input id="stadt" class="mapNode input bigger" placeholder="Stadt">' +
                '<br><b>Informationen über den Eintrag</b>' +
                await _this._buildSelectKategorien() +
                '<input id="name" class="mapNode input full" placeholder="Titel*">' +
                '<textarea class="mapNode full" placeholder="Beschreibung" id="inhalt"></textarea>',
            focusConfirm: false,
            confirmButtonText: "Eintrag anlegen",
            preConfirm: () => {
                let data = {
                    vorname: document.getElementById('vorname').value.trim(),
                    nachname: document.getElementById('nachname').value.trim(),
                    strasse: document.getElementById('strasse').value.trim(),
                    hausnummer: document.getElementById('hausnummer').value.trim(),
                    stadt: document.getElementById('stadt').value.trim(),
                    plz: parseInt(document.getElementById('plz').value.trim()),
                    email: document.getElementById('email').value.trim(),
                    kategorie: parseInt(document.getElementById('kategorie').value.trim()),
                    name: document.getElementById('name').value.trim(),
                    inhalt: document.getElementById('inhalt').value.trim(),
                }

                // validate data
                if (data.vorname === "" || data.nachname === "" || data.email === "" || data.name === "" || data.kategorie === "") {
                    alert("Bitte füllen Sie alle benötigten Felder aus.")
                    return false
                }

                return data
            }
        })

        return formValues
    }

    async _buildSelectKategorien() {
        let html = "<select class='mapNode full' id='kategorie'>";

        // load kategorie information
        let kategorien = (await this._api({
            query: `query{
                        kategorien{
                            id
                            name
                        }
                    }`,
            variables: {id: this.mandantenID}
        })).data.kategorien

        for (let kategorie of kategorien) {
            html += "<option value='" + kategorie.id + "'>" + kategorie.name + "</option>"
        }

        html += "</select>"
        return html;
    }

    _showEntrySuccessPopUp() {
        Swal.fire({
            icon: "success",
            title: "Eintrag angelegt",
            html: "<strong>Bestätigen</strong> Sie bitte die Erstellung Ihres Eintrags, indem Sie auf den <strong>Link in der Bestätigungs-E-Mail</strong> klicken."
        })
    }

    /**
     * Makes an api call.
     *
     * @param query
     * @param variables
     * @return {Promise<Response>}
     * @private
     */
    async _api({query, variables} = {variables: {}}) {
        return (await fetch(this.apiUrl, {
            method: 'POST',
            mode: 'cors',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                query: query,
                variables: variables,
            }),
        })).json()
    }


}