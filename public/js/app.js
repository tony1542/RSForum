// Custom scss
import '../scss/app.scss';

// jQuery
import $ from 'jquery';

// JS-portion of Bootstrap
import 'bootstrap';

// FontAwesome
import '@fortawesome/fontawesome-free/js/all.js';

import EventListener from './events/eventListener';
import ProfileListener from './events/profileListener';
import TaskListener from "./events/taskListener";

$(document).ready(function () {
    EventListener.registerListeners([
        new ProfileListener(),
        new TaskListener()
    ]);
});