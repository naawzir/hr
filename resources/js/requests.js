const _token = '6Df1hNOBdWPyfIPI3QDZLu/JB0rRNZPlVlLF7FLsBw0=';
const api = '/api/v1/';
require('./bootstrap');
window.Vue = require('vue');
const requests = new Vue({
    el: '#requests',
    data: {
        allPending : false,
        pending : [],
        allAccepted : false,
        accepted : [],
        allDeclined : false,
        declined : [],
        holidaysPending : [],
        holidaysAccepted : [],
        holidaysDeclined : [],
    },
    mounted() {
        this.getRequests();
        $("ul.tabs li").click(function(){
            $(".request_button").hide();
            $("#selectAllPending").removeAttr('checked');
            $("#selectAllAccepted").removeAttr('checked');
            $("#selectAllDeclined").removeAttr('checked');
            $(".undecidedCheckbox").removeAttr('checked');
            $(".acceptedCheckbox").removeAttr('checked');
            $(".declinedCheckbox").removeAttr('checked');
        });

        // turn this into Vue code
        $(".delete").click(function() {
            var message = confirm("Are you sure you want to decline this holiday request?");
            if (message == true) {
                return true;
            } else {
                return false;
            }
        });

        // turn this into Vue code
        $("#selectAllPending").on('click', function () {
            if ($(this).attr('checked') == 'checked') {
                //$(".undecidedCheckbox").attr('checked', 'checked');
                $("#accept_button").fadeIn();
                $("#decline_button").fadeIn();
            } else {
                //$(".undecidedCheckbox").removeAttr('checked');
                $("#accept_button").fadeOut();
                $("#decline_button").fadeOut();
            }
        });

        // turn this into Vue code
        $("#selectAllAccepted").on('click', function () {
            if ($(this).attr('checked') == 'checked') {
                //$(".acceptedCheckbox").attr('checked', 'checked');
                $("#decline_button").fadeIn();
            } else {
                //$(".acceptedCheckbox").removeAttr('checked');
                $("#decline_button").fadeOut();
            }
        });

        // turn this into Vue code
        $(".acceptedCheckbox").on('click', function () {
            var checked = $(".acceptedCheckbox:checked").length;
            if(checked > 0){
                $("#decline_button").fadeIn();
            } else {
                $("#decline_button").fadeOut();
            }
        });

        // turn this into Vue code
        $("#selectAllDeclined").on('click', function () {
            if ($(this).attr('checked') == 'checked') {

                $(".declinedCheckbox").attr('checked', 'checked');
                $("#accept_button").fadeIn();
            } else {
                $(".declinedCheckbox").removeAttr('checked');
                $("#accept_button").fadeOut();
            }
        });

        // turn this into Vue code
        $(".declinedCheckbox").on('click', function () {
            var checked = $(".declinedCheckbox:checked").length;
            if(checked > 0){
                $("#accept_button").fadeIn();
            } else {
                $("#accept_button").fadeOut();
            }
        });
    },
    computed: {
    },
    watch: {
    },
    methods: {
        selectAllPending : function () {
            let self = this;
            let checked = self.allPending;
            if (!checked) {
                for (let i = 0; i < self.holidaysPending.length; i++) {
                    self.pending.push(self.holidaysPending[i].holiday_id);
                }
            } else {
                self.pending = [];
            }
        },
        pendingClicked : function (event, value) {
            let self = this;
            if (!event.target.checked) {
                self.selectAllPending = false;
            }
        },
        selectAllAccepted : function () {
            let self = this;
            let checked = self.allAccepted;
            if (!checked) {
                for (let i = 0; i < self.holidaysAccepted.length; i++) {
                    self.accepted.push(self.holidaysAccepted[i].holiday_id);
                }
            } else {
                self.accepted = [];
            }
        },
        acceptedClicked : function (event, value) {
            let self = this;
            if (!event.target.checked) {
                self.selectAllAccepted = false;
            }
        },
        selectAllDeclined : function () {
            let self = this;
            let checked = self.allDeclined;
            if (!checked) {
                for (let i = 0; i < self.holidaysDeclined.length; i++) {
                    self.declined.push(self.holidaysDeclined[i].holiday_id);
                }
            } else {
                self.declined = [];
            }
        },
        declinedClicked : function (event, value) {
            let self = this;
            if (!event.target.checked) {
                self.selectAllDeclined  = false;
            }
        },
        getRequests : function () {
            let self = this;
            axios({
                url: api + 'get-requests',
                method: 'GET'
            }).then(function (response) {
                console.log('fine', response);
                if (response.data.error) {
                    return false;
                }
                console.log('holidaysPending', response.data.holidaysPending);
                console.log('holidaysAccepted', response.data.holidaysAccepted);
                console.log('holidaysDeclined', response.data.holidaysDeclined);
                self.holidaysPending = response.data.holidaysPending;
                self.holidaysAccepted = response.data.holidaysAccepted;
                self.holidaysDeclined = response.data.holidaysDeclined;
            }).catch(function (err) {
                console.log('fail');
                console.log(err);
            });
        },
        acceptHolidayRequest: function (holidayId) {
            let self = this;
            axios({
                url: api + 'accept-holiday-request',
                method: 'POST',
                data: {
                    holiday_id : holidayId
                }
            }).then(function (response) {
                console.log('fine', response);
                if (response.data.error) {
                    return false;
                }
                location.reload();
            }).catch(function (err) {
                console.log('fail');
                console.log(err);
            });
        },
        declineHolidayRequest: function (holidayId) {
            let message = confirm("Are you sure you want to decline this holiday request?");
            if (!message) {
                return;
            } else {
                let self = this;
                axios({
                    url: api + 'decline-holiday-request',
                    method: 'POST',
                    data: {
                        holiday_id : holidayId
                    }
                }).then(function (response) {
                    console.log('fine', response);
                    if (response.data.error) {
                        return false;
                    }
                    location.reload();
                }).catch(function (err) {
                    console.log('fail');
                    console.log(err);
                });
            }
        },
        acceptHolidayRequests: function () {
            let self = this;
            let holidayIds = self.pending.concat(self.declined);
            axios({
                url: api + 'accept-holiday-requests',
                method: 'POST',
                data: {
                    holiday_ids : holidayIds
                }
            }).then(function (response) {
                console.log('fine', response);
                if (response.data.error) {
                    return false;
                }
                location.reload();
            }).catch(function (err) {
                console.log('fail');
                console.log(err);
            });
        },
        declineHolidayRequests: function () {
            let self = this;
            let message = confirm("Are you sure you want to decline the holiday/s?");
            if (!message) {
                return false;
            } else {
                let holidayIds = self.pending.concat(self.accepted);
                axios({
                    url: api + 'decline-holiday-requests',
                    method: 'POST',
                    data: {
                        holiday_ids: holidayIds
                    }
                }).then(function (response) {
                    console.log('fine');
                    if (response.data.error) {
                        return false;
                    }
                    location.reload();
                }).catch(function (err) {
                    console.log('fail');
                    console.log(err);
                });
            }
        }
    }
});
