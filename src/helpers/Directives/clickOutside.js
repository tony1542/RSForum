// TODO tie this into our Vue instance and use it for Settings.vue
export default {
    bind: function (el, binding, vNode) {
        el.clickOutsideEvent = function (event) {
            if (!(el == event.target || el.contains(event.target))) {
                vNode.context[binding.expression](event);
            }
        };

        document.body.addEventListener('click', el.clickOutsideEvent);
    },
    unbind: function (el) {
        document.body.removeEventListener('click', el.clickOutsideEvent);
    }
};