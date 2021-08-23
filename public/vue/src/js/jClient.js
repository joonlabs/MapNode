import axios from "axios";
import router from "@/router";
import {jUser} from "@/js/jUser";

export class jClient {

    static createClient(name, zoom, lat, long) {
        try {
            return new Promise(function (resolve, reject) {
                axios({
                    method: "POST",
                    headers: {
                        Authorization: "Bearer " + jUser.getToken()
                    },
                    url: window.config.url + window.config.api.endpoint,
                    data: {
                        query: `mutation {
                                erstelleMandant(mandant: {name:"${name}", karte_latitude: ${lat}, karte_longitude: ${long}, karte_zoom: ${zoom}}){
                                id
                                 } 
                            }`,
                    }
                }).then(function (response) {
                    if (response.status === 200) {
                        // success
                        router.push('/clients')
                    } else {
                        reject(response)
                    }
                }).catch(function (error) {
                    reject(error)
                })
            })
        } catch (error) {
            console.error(error);
        }
    }

    static getClients() {
        try {
            return new Promise(function (resolve, reject) {
                axios({
                    method: "POST",
                    headers: {
                        Authorization: "Bearer " + jUser.getToken()
                    },
                    url: window.config.url + window.config.api.endpoint,
                    data: {
                        query: `
                            {
                                mandanten {
                                    id
                                    name
                                }
                            }
                        `
                    }
                }).then(function (response) {
                    if (response.status === 200) {
                        // success
                        resolve(response)
                    } else {
                        reject(response)
                    }
                }).catch(function (error) {
                    reject(error)
                })
            }).then(function (response) {
                return response.data.data.mandanten
            })
        } catch (error) {
            console.error(error);
        }
    }


    static getClient(id) {
        try {
            return new Promise(function (resolve, reject) {
                axios({
                    method: "POST",
                    headers: {
                        Authorization: "Bearer " + jUser.getToken()
                    },
                    url: window.config.url + window.config.api.endpoint,
                    data: {
                        query: `
                            {
                                mandant(id: ${id}) {
                                    id
                                    name
                                    kennung
                                    karte_latitude
                                    karte_longitude
                                    karte_zoom
                               
                                    erstellt
                                }
                            }
                        `
                    }
                }).then(function (response) {
                    if (response.status === 200) {
                        // success
                        resolve(response)
                    } else {
                        reject(response)
                    }
                }).catch(function (error) {
                    reject(error)
                })
            }).then(function (response) {
                console.log(response)
                return response.data.data.mandant
            })
        } catch (error) {
            console.error(error);
        }
    }

    static updateClient(id,name, lat, long, zoom) {
        try {
            return new Promise(function (resolve, reject) {
                axios({
                    method: "POST",
                    headers: {
                        Authorization: "Bearer " + jUser.getToken()
                    },
                    url: window.config.url + window.config.api.endpoint,
                    data: {
                        query: `mutation {
                                bearbeiteMandant(id:${id} , mandant: { name:"${name}", karte_latitude: ${lat}, karte_longitude: ${long}, karte_zoom: ${zoom}}){
                                 id
                                 } 
                            }`
                    }
                }).then(function (response) {
                    if (response.status === 200) {
                        // success
                        resolve(response)
                    } else {
                        reject(response)
                    }
                }).catch(function (error) {
                    reject(error)
                })
            })
        } catch (error) {
            console.error(error);
        }
    }
    /*
    Delete Client
    static deleteClient(id) {
        try {
            return new Promise(function (resolve, reject) {
                axios({
                    method: "POST",
                    headers: {
                        Authorization: "Bearer " + jUser.getToken()
                    },
                    url: window.config.url + window.config.api.endpoint,
                    data: {
                        query: `mutation {
                                loescheMandant(id:${id}){
                                 } 
                            }`
                    }
                }).then(function (response) {
                    if (response.status === 200) {
                        // success
                        resolve(response)
                    } else {
                        reject(response)
                    }
                }).catch(function (error) {
                    reject(error)
                })
            })
        } catch (error) {
            console.error(error);
        }
    }
     */
}