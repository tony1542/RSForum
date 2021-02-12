import '../scss/app.scss';

import $ from "jquery";

import EventListener from "./Listeners/eventListener";
import Nav from "./Listeners/nav";

$(document).ready(function () {
    EventListener.registerListeners([
        new Nav()
    ]);
});