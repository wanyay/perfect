var axios = require('axios');

let token = document.head.querySelector('meta[name="csrf-token"]');

if (!token) {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

var config = {
    baseURL: 'http://localhost/api/v1',
    headers: {
        common: {
            'X-Requested-With' : 'XMLHttpRequest',
            'Accept': 'application/json',
            'X-CSRF-TOKEN' : token.content
        },
    }
};

var axiosInstance = axios.create(config);

module.exports = axiosInstance;





