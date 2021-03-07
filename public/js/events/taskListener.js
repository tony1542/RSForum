import SweetAlert from '../sweetAlert';
import Event from '../events/event.js';
import Request from "../Request";

export default class TaskListener extends Event {
    register() {
        this.registerDelete();
        this.registerSort();
    }
    
    registerDelete() {
        $('.deleteButton').click(function (e) {
            e.preventDefault();
        
            SweetAlert.confirm('Click ok to delete this task', function () {
                $('#deleteForm').submit();
            });
        });
    }
    
    registerSort() {
        $('#sortable').sortable({
            // On sort release, make request to update DB
            stop: function (event, ui) {
                let sorted_card_ids = $('.card-sortable').map(function () {
                    return $(this).data('id');
                }).get();
            
                Request.post('Task/Reorder', {
                    'sorted_card_ids': sorted_card_ids
                });
            }
        });
    }
}