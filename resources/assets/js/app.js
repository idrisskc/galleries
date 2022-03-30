/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

window.Vue.use(VueRouter);

import ImagesIndex from './components/images/ImagesIndex.vue';
import ImageEdit from './components/images/ImageEdit.vue';
import CommentsIndex from './components/comments/Comments.vue';


const routes = [
    {
        path: '/',
        components: {
            imagesIndex: ImagesIndex
        }
    },
    {path: '/edit-image/:id', component: ImageEdit, name: 'editImage'},

    {path: '/comments', component: CommentsIndex, name: 'indexComments'},



]

Vue.component('comments', require('./components/comments/Comments'));

const router = new VueRouter({ routes });

const app = new Vue({ router }).$mount('#app');