$(document).ready(function () {
    // TODO update to not trigger on every form submit tony you fucking retard thx
    $('form').submit(function () {
        return confirm('Click ok to update your profile');
    });
});
