const _token = '6Df1hNOBdWPyfIPI3QDZLu/JB0rRNZPlVlLF7FLsBw0=';
const api = '/api/v1/';
require('./bootstrap');
window.Vue = require('vue');
const users = new Vue({
    el: '#users',
    data: {
        users: [],
    },
    mounted() {
        let self = this;
        //self.getUsers();
    },
    computed: {

    },
    methods: {
       /* getUsers: function () {
            let self = this;
            axios({
                url: api + 'users',
                method: 'GET'
            }).then(function (response) {
                self.users = response.data.data;
            });
        }*/
    }
});
