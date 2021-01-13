/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import VueRouter from 'vue-router';
require('./bootstrap');
window.Vue = require('vue');

Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
/** Login component */
let oLoginComponent = Vue.component('', require('./components/pages/LoginComponent.vue').default);

let oSubRoutes = [
    {
        path      : '/',
        name      : 'login',
        component : oLoginComponent
    }
];

/** route components **/
let oRouter = new VueRouter({
    routes : [{
        path      : '/',
        name      : 'main',
        component : Vue.component('main_app', require('./components/MainComponent.vue').default),
        children  : oSubRoutes
    }]
});

const app = new Vue({
    el: '#app',

    router : oRouter,

    data : {
        oLoadingScreen : {
            bActive : false
        }
    },

    created() {
        this.activateLoadingScreen();
    },

    methods : {
        /**
         * Activate loading screen
         */
        activateLoadingScreen : function() {
            this.oLoadingScreen.bActive = true;
        },

        /**
         * Deactivate loading screen
         */
        deactivateLoadingScreen : function() {
            this.oLoadingScreen.bActive = false;
        },

        /**
         * Axios GET request
         *
         * @param sUrl
         * @param mThen
         * @param oParam
         * @returns {Promise<unknown>}
         */
        getRequest : function (sUrl, mThen, oParam = []) {
            return new Promise((mResolve) => {
                axios({
                    method : 'get',
                    url    : sUrl,
                    params : oParam
                })
                    .then(function (oResponse) {
                        if (oResponse.data.code === 200) {
                            mThen(oResponse.data.data);
                        } else {
                            this.catchResponse(oResponse);
                        }
                    })
                    .catch(this.catchRequest);
                mResolve();
            })
        },

        /**
         * Axios POST request
         *
         * @param sUrl   string
         * @param oParam object
         * @param mThen  mixed
         * @return {Promise<any>}
         */
        postRequest: function (sUrl, oParam, mThen) {
            return new Promise((mResolve) => {
                axios.post(sUrl, oParam, {headers: oHeaders})
                    .then((oResponse) => {
                        if (oResponse.data.code === 200) {
                            mThen(oResponse.data.data);
                        } else {
                            this.catchResponse(oResponse);
                        }
                    })
                    .catch(this.catchRequest);
                mResolve();
            });
        },

        /**
         * Catch axios response
         *
         * @param oResponse
         */
        catchResponse : function(oResponse) {

        },

        /**
         * Catch axios request error
         */
        catchRequest : function(oError) {

        },

    }
});
