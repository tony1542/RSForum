$(document).ready(function () {
    $('.deleteButton').submit(function (e) {
        return confirm('Click ok to delete this task');
    });
});