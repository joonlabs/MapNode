import {jStore} from "@/js/jStore";
import axios from "axios";
import router from "@/router";

export class jUser {

    /**
     * Makes an attempt to log in a user. If successful it will resolve the returned promise,
     * otherwise it will reject.
     * @param email
     * @param password
     * @returns {Promise<unknown>}
     */
    static logIn({email, password}) {
        let _this = this
        try {
        return new Promise(function (resolve, reject) {
            axios({
                method: "POST",
                url: window.config.api.endpoint,
                data: {
                    query: `mutation {
                                login( email: "${email}", passwort: "${password}"){
                                 token 
                                 } 
                            }`,
                }
            }).then(function (response) {
                if (response.status === 200) {
                    // success
                    _this._storeUserInfo({
                        token: response.data.data.login.token,
                        email: email,
                    })
                    router.push('/clients')
                } else {
                    reject(response)
                }
            }).catch(function (error) {
                reject(error)
            })
        }) } catch (error) {
            console.error(error);
        }
    }

    /**
     * Logs out a user
     */
    static logOut() {
        if (jUser.isLoggedIn()) {
            jStore.destroy({key: "USER_INFORMATION"})
        } else {
            console.warn("jUser : you're trying to log out a user that is not logged in. See trace: ")
            console.trace()
        }
    }

    /**
     * Stores user information in the local storage
     * @param token
     * @param email
     * @private
     */
    static _storeUserInfo({token, email}) {
        let userInformation = {
            token: token,
            email: email,
        }
        jStore.store({key: "USER_INFORMATION", value: userInformation})
    }

    /**
     * Returns whether you are logged in or not
     * @returns {boolean}
     */
    static isLoggedIn() {
        return this.getToken() !== undefined;
    }

    /**
     * Returns the user information as an JSON object
     * @returns {any|string}
     */
    static getInformation() {
        return jStore.load({key: "USER_INFORMATION"});
    }

    /**
     * Returns the token of the user. If he/she has a MFA token, this one is getting used
     * @returns {*|undefined}
     */
    static getToken() {
        return this.getInformation() !== undefined ? this.getInformation().token : undefined;
    }

    /**
     * Returns the email of the user
     * @returns {*|undefined}
     */
    static getEmail() {
        return this.getInformation() !== undefined ? this.getInformation().email : undefined;
    }
}
