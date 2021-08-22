export class jStore{
    /**
     * jStore's non persistent store
     * @type {{}}
     */
    static nonPersitantStore = {}

    /**
     * Stores a value in the localStorage
     * @param key
     * @param value
     * @param persistent
     */
    static store({key, value, persistent}){
        if(persistent!==false) persistent = true

        if(persistent && typeof value === 'object'){
            value = JSON.stringify(value)
        }

        if(persistent){
            window.localStorage.setItem(key, value)
        }else{
            this.nonPersitantStore[key] = value
        }
    }

    /**
     * Returns whether an item exists or not
     * @param key
     * @param persistent
     * @returns {boolean}
     */
    static exists({key, persistent}){
        if(persistent!==false) persistent = true
        if(persistent){
            return window.localStorage.getItem(key) !== null;
        }else{
            return Object.prototype.hasOwnProperty.call(jStore.nonPersitantStore, key)
        }

    }

    /**
     * Loads a value from the local storage
     * @param key
     * @param persistent
     */
    static load({key, persistent}){
        if(persistent!==false) persistent = true

        let value = undefined

        if(persistent){
            value = window.localStorage.getItem(key)
        }else{
            return jStore.nonPersitantStore[key]
        }

        if(value === null || value === undefined)
            return undefined

        if(this.isJSON({text: value})){
            return JSON.parse(value)
        }else{
            return value
        }
    }

    /**
     * Removes an item from localStorage
     * @param key
     * @param persistent
     */
    static destroy({key, persistent}){
        if(persistent!==false) persistent = true

        if(persistent){
            window.localStorage.removeItem(key)
        }else{
            delete jStore.nonPersitantStore[key]
        }
    }

    /**
     * Returns whether a String is in JSON-format or not
     * @param text
     * @returns {boolean}
     * @private
     */
    static isJSON({text}){
        /*eslint-disable no-useless-escape*/
        return (typeof text === "string") && (/^[\],:{}\s]*$/.test(text.replace(/\\["\\\/bfnrtu]/g, '@').
        replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').
        replace(/(?:^|:|,)(?:\s*\[)+/g, '')))
    }
}
