import '../scss/app.scss';

import $ from 'jquery';

import EventListener from './events/eventListener';
import ProfileListener from './events/profileListener';
import TaskListener from "./events/taskListener";

$(document).ready(function () {
    EventListener.registerListeners([
        new ProfileListener(),
        new TaskListener()
    ]);
});