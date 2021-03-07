export default class Request {
	static post(url, params) {
		params = params || {};
		$.post('/' + url, params);
	}
}