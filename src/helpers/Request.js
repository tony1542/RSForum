import store from "../store";

export default class Request {
    constructor(url) {
        this.base = 'http://localhost:9001';
        this.url = url;
    }

    // Return 'thenable' promise
    async call() {
        // TODO check if JWT exist before including them in here
        return await fetch(`${ this.base }/${ this.url }`, {
            headers: {
                'Authorization': `Bearer ${ store.JWT }`
            }
        })

        // return await fetch(`${ this.base }/${ this.url }`)
            .then(response => response.json());
    }
}