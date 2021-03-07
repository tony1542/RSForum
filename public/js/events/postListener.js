import $ from 'jquery';
import SweetAlert from '../sweetAlert';
import Event from '../events/event.js';

export default class PostListener extends Event {
	register() {
		$('.deletePost').click(function (e) {
			e.preventDefault();

			SweetAlert.confirm('Are you sure you want to delete this post?', function () {
				window.location.href= e.target.href;
			});
		});
	}
}