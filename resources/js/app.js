/* eslint-disable no-undef */
require( './bootstrap' );

import Vue from 'vue';

import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';
import Chartkick from 'vue-chartkick';
import Chart from 'chart.js';

// noinspection JSUnresolvedVariable
Vue.mixin( { methods: { route } } );
Vue.use( InertiaApp );
Vue.use( Chartkick.use( Chart ) );
Vue.use( InertiaForm );
Vue.use( PortalVue );

const app = document.getElementById( 'app' );

new Vue( {
    render: ( h ) =>
        h( InertiaApp, {
            props: {
                initialPage: JSON.parse( app.dataset.page ),
                resolveComponent: ( name ) => require( `./Pages/${name}` ).default,
            },
        } ),
} ).$mount( app );
