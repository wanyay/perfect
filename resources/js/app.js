import './plugins/masonry';
import './plugins/charts';
import './plugins/popover';
import './plugins/scrollbar';
import './plugins/sidebar';
import './plugins/datatable';
import './plugins/datepicker';
import './plugins/utils';

import * as $ from "jquery";

window.addEventListener('load', function load()
{
    const loader = document.getElementById('loader');
    setTimeout(function () {
        loader.classList.add('fadeOut');
    }, 500);
});

require('./bootstrap');


window._ = require('lodash');

window.Vue = require('vue');
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/en'

Vue.use(ElementUI, { locale });

require('./components.js');

function debounce(fn, delay = 300)
{
    var timeoutID = null;

    return function () {
        clearTimeout(timeoutID);

        var args = arguments;
        var that = this;

        timeoutID = setTimeout(function () {
            fn.apply(that, args);
        }, delay);
    }
};

Vue.directive('debounce', (el, binding) => {
    if (binding.value !== binding.oldValue) {
        // window.debounce is our global function what we defined at the very top!
        el.oninput = debounce(ev => {
            el.dispatchEvent(new Event('change'));
        }, parseInt(binding.value) || 300);
    }
});

const app = new Vue({
    el : "#app",
    methods: {
        sidebarToggle()
        {
            $('.app').toggleClass('is-collapsed');
            $('#style-3').toggle();
        }
    }
});
