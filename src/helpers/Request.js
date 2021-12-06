import store from "../store";
import Store from "../store";

export default class Request {
    constructor(url) {
        this.base = 'http://localhost:9001';
        this.url = url;
    }

    // Return 'thenable' promise
    async call(parameters, method = 'GET') {
        let options = {
            headers: {
                'Authorization': `Bearer ${ store.JWT }`,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            method: method,
        };

        if (parameters) {
            options.body = JSON.stringify(parameters);
        }

        Store.setWaitingOnAjax(true);

        // TODO check if JWT exist before including them in here
        return await fetch(`${ this.base }/${ this.url }`, options)
            .then(response => {
                Store.setWaitingOnAjax(false);
                return response.json();
            })
    }

    async post(parameters)
    {
        return await this.call(parameters, 'POST');
    }
}