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
        acceptButton : false,
        declineButton : false,
        holidaysPendingCount : 0,
        holidaysAcceptedCount : 0,
        holidaysDeclinedCount : 0,
        pendingRequests : false,
        acceptedRequests : false,
        declinedRequests : false,
        weekendAvailability : '',
        deleteDeclinedRequestsBtn : false
    },
    mounted() {
        this.getRequests();
        this.checkWeekendAvailability();
    },
    computed: {
    },
    watch: {
        'pending' : function () {
            let self = this;
            if (self.pending.length > 0 && self.pending.length < self.holidaysPendingCount) {
                self.acceptAndDeclineButtonsShow();
                self.allPending = false;
            } else if (self.pending.length > 0 && self.pending.length == self.holidaysPendingCount) {
                self.acceptAndDeclineButtonsShow();
                self.allPending = true;
            } else {
                self.acceptAndDeclineButtonsHide();
                self.allPending = false;
            }
        },
        'accepted' : function () {
            let self = this;
            self.acceptAndDeclineButtonsHide();
            if (self.accepted.length > 0 && self.accepted.length < self.holidaysAcceptedCount) {
                self.declineButton = true;
                self.allAccepted = false;
            } else if (self.accepted.length > 0 && self.accepted.length == self.holidaysAcceptedCount) {
                self.declineButton = true;
                self.allAccepted = true;
            } else {
                self.declineButton = false;
                self.allAccepted = false;
            }
        },
        'declined' : function () {
            let self = this;
            self.acceptAndDeclineButtonsHide();
            if (self.declined.length > 0 && self.declined.length < self.holidaysDeclinedCount) {
                self.acceptButton = true;
                self.allDeclined = false;
            } else if (self.declined.length > 0 && self.declined.length == self.holidaysDeclinedCount) {
                self.acceptButton = true;
                self.allDeclined = true;
            } else {
                self.acceptButton = false;
                self.allDeclined = false;
            }
        },
    },
    methods: {
        deleteDeclinedRequests : function () {
            let self = this;
            let message = confirm("Are you sure you want to delete all declined holiday requests?");
            if (!message) {
                return;
            } else {
                axios({
                    url: api + 'delete-declined-requests',
                    method: 'GET'
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
        toggleWeekendAvailability : function () {
            let self = this;
            axios({
                url: api + 'toggle-weekend-availability',
                method: 'POST',
                data: {
                    weekend_availability : self.weekendAvailability
                }
            }).then(function (response) {
                console.log('fine', response);
                if (response.data.error) {
                    return false;
                }
                alert('Updated!');
            }).catch(function (err) {
                console.log('fail');
                console.log(err);
            });
        },
        showTable : function (table = null) {
            let self = this;
            if (table && table === 'declined' && self.holidaysDeclinedCount > 0) {
                self.deleteDeclinedRequestsBtn = true;
            } else {
                self.deleteDeclinedRequestsBtn = false;
            }
            self.acceptButton = false;
            self.declineButton = false;
            self.allPending = false;
            self.allAccepted = false;
            self.allDeclined = false;
            self.pending = [];
            self.accepted = [];
            self.declined = [];
        },
        acceptAndDeclineButtonsShow : function () {
            let self = this;
            self.acceptButton = true;
            self.declineButton = true;
        },
        acceptAndDeclineButtonsHide : function () {
            let self = this;
            self.acceptButton = false;
            self.declineButton = false;
        },
        selectAllPending : function () {
            let self = this;
            self.acceptAndDeclineButtonsHide();
            let checked = self.allPending ? 0 : 1;
            if (checked) {
                for (let i = 0; i < self.holidaysPending.length; i++) {
                    self.pending.push(self.holidaysPending[i].holiday_id);
                }
                self.acceptAndDeclineButtonsShow();
            } else {
                self.pending = [];
                self.acceptAndDeclineButtonsHide();
            }
        },
        selectAllAccepted : function () {
            let self = this;
            self.acceptAndDeclineButtonsHide();
            let checked = self.allAccepted ? 0 : 1;
            if (checked) {
                for (let i = 0; i < self.holidaysAccepted.length; i++) {
                    self.accepted.push(self.holidaysAccepted[i].holiday_id);
                }
                self.declineButton = true;
            } else {
                self.accepted = [];
                self.declineButton = false;
            }
        },
        selectAllDeclined : function () {
            let self = this;
            self.acceptAndDeclineButtonsHide();
            let checked = self.allDeclined ? 0 : 1;
            if (checked) {
                for (let i = 0; i < self.holidaysDeclined.length; i++) {
                    self.declined.push(self.holidaysDeclined[i].holiday_id);
                }
                self.acceptButton = true;
            } else {
                self.declined = [];
                self.acceptButton = false;
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
                //console.log('holidaysPending', response.data.holidaysPending);
                //console.log('holidaysAccepted', response.data.holidaysAccepted);
                //console.log('holidaysDeclined', response.data.holidaysDeclined);
                self.holidaysPending = response.data.holidaysPending;
                self.holidaysAccepted = response.data.holidaysAccepted;
                self.holidaysDeclined = response.data.holidaysDeclined;
                self.holidaysPendingCount = self.holidaysPending.length;
                if (self.holidaysPendingCount > 0) {
                    self.pendingRequests = true;
                }
                self.holidaysAcceptedCount = self.holidaysAccepted.length;
                if (self.holidaysAcceptedCount > 0) {
                    self.acceptedRequests = true;
                }
                self.holidaysDeclinedCount = self.holidaysDeclined.length;
                if (self.holidaysDeclinedCount > 0) {
                    self.declinedRequests = true;
                }
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
        deleteDeclinedHolidayRequest: function (holidayId) {
            let self = this;
            let message = confirm("Are you sure you want to delete this declined holiday request?");
            if (!message) {
                return;
            } else {
                axios({
                    url: api + 'delete-declined-holiday-request',
                    method: 'POST',
                    data: {
                        holiday_id: holidayId
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
        declineHolidayRequests : function () {
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
        },
        checkWeekendAvailability : function () {
            let self = this;
            axios({
                url: api + 'check-weekend-availablity',
                method: 'GET'
            }).then(function (response) {
                console.log('fine');
                if (response.data.error) {
                    return false;
                }
                console.log('a', response.data.checkWeekendAvailability);
                self.weekendAvailability = response.data.checkWeekendAvailability;
            }).catch(function (err) {
                console.log('fail');
                console.log(err);
            });
        }
    }
});
