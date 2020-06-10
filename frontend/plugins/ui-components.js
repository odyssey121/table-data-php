import Vue from 'vue';
import vSelect from 'vue-select'
import RightArrow from '@/components/UI/RightArrow';
import LeftArrow from '@/components/UI/LeftArrow';
import 'vue-select/dist/vue-select.css';
// ijection components intro App

Vue.component('v-select', vSelect)
Vue.component('LeftArrow', LeftArrow)
Vue.component('RightArrow', RightArrow)



