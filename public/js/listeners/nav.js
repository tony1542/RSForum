import $ from 'jquery';
import EventListener from './eventListener';

export default class Nav extends EventListener {
    register() {
        this.registerSideNav();
    }

    registerSideNav() {
        let side_nav = $('.side-nav');
        let side_nav_button = $('.side-nav-button');
        let side_nav_close_button = $('.side-nav-close-button');

        $('html').click(function () {
            side_nav.hide();
        });

        side_nav.click(function (e) {
            e.stopPropagation();
        });

        side_nav_button.click(function (e) {
            e.stopPropagation();
            side_nav.toggle();
        });

        side_nav_close_button.click(function (e) {
            e.stopPropagation();
            side_nav.hide();
        });
    }
}
