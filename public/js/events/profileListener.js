import $ from 'jquery';
import SweetAlert from '../sweetAlert';
import Event from '../events/event.js';

export default class ProfileListener extends Event {
    register() {
        $('.submitProfileUpdate').click(function (e) {
            e.preventDefault();

            let username = $('#username').val();
            let account_type = $('#UserEdit input[type=radio]:checked').parent('label').text().trim();

            SweetAlert.confirm('Username: ' + username + ' \n Account type: ' + account_type, function () {
                $('#UserEdit').submit();
            });
        });
    }
}