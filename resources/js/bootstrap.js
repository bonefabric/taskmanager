import 'tailwindcss/tailwind.css';
import '../scss/app.scss';

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
