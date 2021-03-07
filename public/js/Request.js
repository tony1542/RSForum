import SweetAlert from "./sweetAlert";

export default class Request {
	static post(url, params) {
		params = params || {};
		$.post('/' + url, params).done(function (data) {
			switch(data.type) {
				case 0: // Success
					SweetAlert.success('Success', data.response);
					break;
				case 1: // Error
					SweetAlert.error('Error', data.response);
					break;
				case 2: // Warning
					SweetAlert.warning('Warning', data.response);
					break;
			}
		});
	}
}