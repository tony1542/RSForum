$(document).ready(function () {
    // TODO update to not trigger on every form submit tony you fucking retard thx
    $('#UserEdit').submit(function (e) {
        return confirm('Click ok to update your profile');
    });
});


