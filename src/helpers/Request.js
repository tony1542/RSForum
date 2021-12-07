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
                'Authorization': `Bearer ${ Store.JWT }`,
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

    // TODO catch the error response in here and add it to the top-level store's error to show errors from App.vue?

    async post(parameters)
    {
        return await this.call(parameters, 'POST');
    }
}