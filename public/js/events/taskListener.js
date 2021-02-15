import $ from 'jquery';
import SweetAlert from '../sweetAlert';
import Event from '../events/event.js';

export default class TaskListener extends Event {
    register() {
        $('.deleteButton').click(function (e) {
            e.preventDefault();

            SweetAlert.confirm('Click ok to delete this task', function () {
                $('#deleteForm').submit();
            });
        });
    }
}