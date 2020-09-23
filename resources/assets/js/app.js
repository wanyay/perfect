
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/en'

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueSweetalert2);

Vue.use(ElementUI, { locale })

Vue.prototype.$deletefun = function (router, id) {
  this.$swal({
    title: "Delete this status?",
    text: "Are you sure? You won't be able to revert this!",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    confirmButtonText: "Yes, Delete it!",
    icon: "warning"
  }).then(result => {
    if (result.value) {
      axios.delete(router, {
        data : {
          id: id
        }
      }).then(response => {
        if(response.status === 200) {
          this.$swal({
            title: "Success",
            text: "Deleted.",
            confirmButtonText: "OK",
            icon: "success"
          }).then((response) => {
            location.reload();
          });
        }
      }).catch(err => {
        this.$swal({
          title: "Error",
          text: "Whoops! look like something went wrong.",
          confirmButtonText: "OK",
          icon: "error"
        }).then((response) => {
          location.reload();
        });
      })
    }
  });
}

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('item-list', require('./components/ItemList.vue').default);
Vue.component('sale-list', require('./components/SaleList.vue').default);

const app = new Vue({
    el: '#app'
});
