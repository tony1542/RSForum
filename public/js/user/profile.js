$(document).ready(function () {
    // TODO update to not trigger on every form submit tony you fucking retard thx
    $('#UserEdit').submit(function (e) {
        return confirm('Click ok to update your profile');
    });
});
$(document).ready(function () {
    $('#TaskEdit').submit(function (e) {
        return confirm('Press ok to add task');
    });
});

