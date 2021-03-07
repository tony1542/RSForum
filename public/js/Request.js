export default class Request {
	static post(url, params) {
		params = params || {};
		$.post('/' + url, params).done(function (response) {
			return response;
		});
	}
}