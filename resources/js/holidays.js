const _token = '6Df1hNOBdWPyfIPI3QDZLu/JB0rRNZPlVlLF7FLsBw0=';
const api = '/api/v1/';
require('./bootstrap');
window.Vue = require('vue');

const myCalendar = new Vue({
    el: '#myCalendar',
    data: {
        submitRequestsButton : false
    },
    mounted() {
        let self = this;
        var v = $('#calendar .halfrequest_sent').length / 2;
        var w = $('#calendar .halfrequest').length / 2;
        var x = $('#calendar .request').length;
        var y = $('#calendar .request_sent').length;
        var z = v + w + x + y;
        $('#counter_requested').html(z);

        console.log(x);
        console.log(y);
        if (x > 0 || w > 0) {
            $(".request_button").show();
            //self.submitRequestsButton = true;
        }

        var a = $('#calendar .halfbooked').length / 2;
        var b = $('#calendar .booked').length;
        var booked_total = a + b;
        $('#counter_booked').html(booked_total);

        var hol_ent = $("#hol_entitlement").text();
        var holidays_remaining = z + booked_total;
        $('#requests_booked').html(hol_ent - holidays_remaining);

        var startTime;
        $('#calendar .day_container span').mousedown(function() {
            var Time = new Date();
            startTime = Time.getTime();
        });

        $('#calendar .day_container span').on("mouseup",function(){
            if (new Date().getTime() - startTime > 500) {
                var id = $(this).attr('id');
                if($(this).hasClass('halfrequest'))
                {
                    $(this).removeClass('halfrequest');
                    $(this).addClass('weekday');
                    var hol_ent = $("#hol_entitlement").text();
                    var tt = $("#calendar .halfbooked").length / 2;
                    var uu = $("#calendar .halfrequest").length / 2;
                    var vv = $("#calendar .halfrequest_sent").length / 2;
                    var ww = $('#calendar .booked').length;
                    var xx = $('#calendar .request').length;
                    var yy = $('#calendar .request_sent').length;
                    var zz = tt + uu + vv + ww + xx + yy;
                    var holidays_remaining = zz;
                    $('#requests_booked').html(hol_ent - holidays_remaining);

                    var request = $('#calendar .request').length;
                    var halfrequest = $('#calendar .halfrequest').length / 2;
                    var requests = request + halfrequest;
                    if (requests == 0) {
                        $(".request_button").fadeOut();
                        //self.submitRequestsButton = false;
                    }
                    axios({
                        url: api + 'calendar/cancel-holiday-request',
                        method: 'POST',
                        data: {
                            daynumber : id,
                            userId    : $("#userId").text()
                        }
                    }).then(function (response) {
                        console.log('fine');
                        if (response.data.error) {
                            return false;
                        }
                    }).catch(function (err) {
                        console.log('fail');
                        console.log(err);
                    });
                    // }
                } else if($(this).hasClass('halfrequest_sent')) {
                    var message = confirm("Are you sure you want to remove this half holiday request?");
                    if(message == true) {
                        $(this).removeClass('halfrequest_sent');
                        $(this).addClass('weekday');

                        axios({
                            url: api + 'calendar/cancel-holiday-request',
                            method: 'POST',
                            data: {
                                daynumber : id,
                                userId    : $("#userId").text()
                            }
                        }).then(function (response) {
                            console.log('fine');
                            if (response.data.error) {
                                return false;
                            }
                        }).catch(function (err) {
                            console.log('fail');
                            console.log(err);
                        });
                    } else {
                        return false;
                    }
                } else if($(this).hasClass('weekday')) {
                    var hol_ent = $("#hol_entitlement").text();
                    var t = $("#calendar .halfbooked").length / 2;
                    var u = $("#calendar .halfrequest").length / 2;
                    var v = $("#calendar .halfrequest_sent").length / 2;
                    var w = $('#calendar .booked').length;
                    var x = $('#calendar .request').length;
                    var y = $('#calendar .request_sent').length;
                    var z = t + u + v + w + x + y;

                    if (hol_ent - z == 0) {
                        alert('You cannot request or book any more holidays');
                    } else {
                        $(this).removeClass('weekday');
                        $(this).addClass('halfrequest');
                        var t = $("#calendar .halfbooked").length / 2;
                        var u = $("#calendar .halfrequest").length / 2;
                        var v = $("#calendar .halfrequest_sent").length / 2;
                        var w = $('#calendar .booked').length;
                        var x = $('#calendar .request').length;
                        var y = $('#calendar .request_sent').length;
                        var z = t + u + v + w + x + y;
                        var holidays_remaining = z;
                        $('#requests_booked').html(hol_ent - holidays_remaining);
                        //self.submitRequestsButton = true;
                        $(".request_button").show();
                        axios({
                            url: api + 'calendar/make-holiday-request',
                            method: 'POST',
                            data: {
                                daynumber : id,
                                userId    : $("#userId").text(),
                                type      : 'Half Request'
                            }
                        }).then(function (response) {
                            console.log('fine');
                            if (response.data.error) {
                                return false;
                            }
                        }).catch(function (err) {
                            console.log('fail');
                            console.log(err);
                        });
                    }
                }
                var t = $("#calendar .halfbooked").length / 2;
                var u = $("#calendar .halfrequest").length / 2;
                var v = $("#calendar .halfrequest_sent").length / 2;
                var w = $('#calendar .booked').length;
                var x = $('#calendar .request').length;
                var y = $('#calendar .request_sent').length;
                var z = u + v + x + y;
                $('#counter_requested').html(z);
                //self.requestedCalculation;
            } else {
                var id = $(this).attr('id');
                if($(this).hasClass('request'))
                {
                    $(this).removeClass('request');
                    $(this).addClass('weekday');
                    var request = $('#calendar .request').length;
                    var halfrequest = $('#calendar .halfrequest').length / 2;
                    var requests = request + halfrequest;

                    if(requests == 0)
                    {
                        $(".request_button").fadeOut();
                        //self.submitRequestsButton = false;
                    }
                    axios({
                        url: api + 'calendar/cancel-holiday-request',
                        method: 'POST',
                        data: {
                            daynumber : id,
                            userId    : $("#userId").text()
                        }
                    }).then(function (response) {
                        console.log('fine');
                        if (response.data.error) {
                            return false;
                        }
                    }).catch(function (err) {
                        console.log('fail');
                        console.log(err);
                    });
                } else if($(this).hasClass('weekday')) {
                    var hol_ent = $("#hol_entitlement").text();
                    var t = $("#calendar .halfbooked").length / 2;
                    var u = $("#calendar .halfrequest").length / 2;
                    var v = $("#calendar .halfrequest_sent").length / 2;
                    var w = $('#calendar .booked').length;
                    var x = $('#calendar .request').length;
                    var y = $('#calendar .request_sent').length;
                    var z = t + u + v + w + x + y;
                    var holidays_remaining = z;
                    $('#requests_booked').html(hol_ent - holidays_remaining);
                    if(hol_ent - z >=0 && hol_ent - z <= 0.9) {
                        alert('You cannot request or book any more holidays');
                    } else {
                        $(this).removeClass('weekday');
                        $(this).addClass('request');
                        $(".request_button").show();
                        axios({
                            url: api + 'calendar/make-holiday-request',
                            method: 'POST',
                            data: {
                                daynumber : id,
                                userId    : $("#userId").text(),
                                type      : 'Request'
                            }
                        }).then(function (response) {
                            console.log('fine');
                            if (response.data.error) {
                                return false;
                            }
                        }).catch(function (err) {
                            console.log('fail');
                            console.log(err);
                        });
                    }
                } else if ($(this).hasClass('request_sent')) {
                    var message = confirm("Are you sure you want to remove this holiday request?");
                    if (message == true) {
                        $(this).removeClass('request_sent');
                        $(this).addClass('weekday');
                        axios({
                            url: api + 'calendar/cancel-holiday-request',
                            method: 'POST',
                            data: {
                                daynumber : id,
                                userId    : $("#userId").text()
                            }
                        }).then(function (response) {
                            console.log('fine');
                            if (response.data.error) {
                                return false;
                            }
                        }).catch(function (err) {
                            console.log('fail');
                            console.log(err);
                        });
                    } else {
                        return false;
                    }
                }
            }

            var v = $("#calendar .halfrequest_sent").length / 2;
            var w = $("#calendar .halfrequest").length / 2;
            var x = $('#calendar .request').length;
            var y = $('#calendar .request_sent').length;
            var z = v + w + x + y;
            $('#counter_requested').html(z);
            //self.requestedCalculation;

            var a = $('#calendar .halfbooked').length / 2;
            var b = $('#calendar .booked').length;
            var booked_total = a + b;
            var holidays_remaining = z + booked_total;
            var hol_ent = $("#hol_entitlement").text();
            $('#requests_booked').html(hol_ent - holidays_remaining);

            $(".close").click(function() {
                $("#myModal").hide();
                $(".close").hide();
            });
            var x = $("#hide_calendar").length;
            if(x > 0){
                $("#calendar").hide();
            }
            $("#holidays").addClass("active");
        });
    },
    computed: {
        requestedCalculation: function() {
            var v = $("#calendar .halfrequest_sent").length / 2;
            var w = $("#calendar .halfrequest").length / 2;
            var x = $('#calendar .request').length;
            var y = $('#calendar .request_sent').length;
            var z = v + w + x + y;
            return z;
        },
        bookedCalculation: function () {
            var a = $('#calendar .halfbooked').length / 2;
            var b = $('#calendar .booked').length;
            var booked_total = a + b;
            return booked_total;
        },
        submitRequestsButtonShow : function () {
            var w = $("#calendar .halfrequest").length / 2;
            var x = $('#calendar .request').length;
            if (w > 0 || x > 0) {
                return true;
            }
        }
    },
    watch: {
    },
    methods: {
/*        makeRequest: function (dayId) {
            let self = this;
            self.mousedown = 0;
            console.log(dayId);
            window.setTimeout(function() {
                self.mousedown = 1
            }, 500);
        },
        makeRequestUp: function (dayId) {
            let self = this;
            if (self.mousedown) {
                self.isRequest = false;
                self.isHalfRequest = true;
            } else {
                self.isHalfRequest = false;
                self.isRequest = true;
            }
            //console.log('mouseup', self.mousedown);
            self.mousedown = 0;
        },
        makeLongRequest: function () {
            alert('long click');
        },*/
        submitHolidayRequests: function() {
            $(window).scrollTop(0);
            $("#calendar").hide();
            $("#calendar_ajax").show();
            axios({
                url: api + 'calendar/submit-holiday-requests',
                method: 'POST',
                data: {
                    userId : $("#userId").text()
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
});
