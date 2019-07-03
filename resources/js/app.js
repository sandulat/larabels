import Vue from 'vue';
import VCard from './components/VCard.vue';
import VTabs from './components/VTabs.vue';

Vue.component('v-card', VCard);
Vue.component('v-tabs', VTabs);

new Vue({
  el: '#app',
});
