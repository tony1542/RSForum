export default class Request {
    constructor(url) {
        this.base = 'http://localhost:9001';
        this.url = url;
    }

    // Return 'thenable' promise
    async call() {
        return await fetch(`${ this.base }/${ this.url }`)
            .then(response => response.json());
    }
}