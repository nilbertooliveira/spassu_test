import 'bootstrap';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import $ from 'jquery';
window.$ = $;
window.jQuery = $;


/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

import Swal from 'sweetalert2';
window.Swal = Swal;


import Pusher from 'pusher-js';
window.Pusher = Pusher;

Pusher.logToConsole = true;


window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    //wsHost: import.meta.env.VITE_PUSHER_APP_WS_HOST,
    //wsPort: import.meta.env.VITE_PUSHER_APP_WS_PORT,
    forceTLS: true,
    //disableStats: true,
});

window.Echo.channel('pdf-processing')
    .listen('.ReportGeneratedEvent', (event) => {
        console.log('PDF Gerado!', event.fileUrl);

        showAlertWithLink(event.fileUrl);
    });

function showAlertWithLink(pdfUrl) {
    Swal.fire({
        title: 'PDF Gerado com Sucesso!',
        html: `Clique <a href="${pdfUrl}" target="_blank" style="color: blue;">aqui</a> para baixar o PDF.`,
        icon: 'success',
        confirmButtonText: 'Fechar'
    });
}

