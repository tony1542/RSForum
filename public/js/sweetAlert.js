import swal from 'sweetalert';

export default class SweetAlert {
    static error(title, text) {
        this.alert(title, text, 'error');
    }

    static success(title, text) {
        this.alert(title, text, 'success');
    }
    
    static warning(title, text) {
        this.alert(title, text, 'warning');
    }

    static alert(title, text, type) {
        swal(title, text, type);
    }

    static confirm(text, callback) {
        swal({
            title: "Are you sure?",
            text: text,
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then((if_confirmed) => {
            if (if_confirmed) {
                callback();
            }
        });
    }
}