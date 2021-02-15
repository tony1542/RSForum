import $ from 'jquery';
import SweetAlert from '../sweetAlert';
import Event from '../events/event.js';

export default class ProfileListener extends Event {
    register() {
        $('.submitProfileUpdate').click(function (e) {
            e.preventDefault();

            SweetAlert.confirm('Click ok to update your username to: ' + $('#username').val(), function () {
                $('#UserEdit').submit();
            });
        });
    }
}