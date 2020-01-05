<!DOCTYPE html>
<html lang="en">
<head>
    <!--<meta http-equiv="refresh" content="120" />-->
    <title>2020 Holiday Calendar</title>

    <link type="text/css" rel="stylesheet" href="/css/global.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
    <!--end of CSS-->
</head>

<body>
<div id="calendar_wrapper" style="margin:0 auto;">
    <div id="userId" style="display:none;">{{ \Auth::user()->id }}</div>
</div>

<div id="content_wrapper" style="margin:0 auto;">
    <div id="content" style="margin:0 auto;">
        <div id="content_title">
            <h1>Requestsabcdef</h1>
        </div><!--end of content_title-->

        <form method='post' class='holiday_form'>
            <div id="tabs">
                <ul class='tabs'>
                    <li><a href='#tabs-1'>Requests put in ({{ $holidaysRequested->count() }})</a></li>
                    <li><a href='#tabs-2'>Requests accepted ({{ $holidaysAccepted->count() }})</a></li>
                    <li><a href='#tabs-3'>Requests declined ({{ $holidaysDeclined->count() }})</a></li>
                </ul>

                <div id='tabs-1'>
                    <table class='myTable tablesorter'>
                        <thead>
                            <tr>
                                <th style='width: 5%; position: relative;'>
                                    <input type='checkbox' id='selectAllUndecided' name='select_all' />
                                </th>
                                <th class='no'>No</th>
                                <th class='name'>Name</th>
                                <th class='job_title'>Date Sent</th>
                                <th class='department'>Holiday Date</th>
                                <th class='booked'>Full/Half Day</th>
                                <th class='accept'>Accept</th>
                                <th class='decline'>Decline</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $x = 1; @endphp
                        @foreach($holidaysRequested as $hol)
                            @php
                            if ($hol->booked == 'Request sent') {
                                $booked = 'Full day';
                            } else {
                                $booked = 'Half a day';
                            }
                            @endphp
                        <tr>
                            <td class='checkbox-custom checkbox-primary mb5'>
                                <input type='checkbox' class='undecidedCheckbox' name='request[]' value='{{ $hol->holiday_id }}' />
                            </td>
                            <td class='no'>{{ $x++ }}</td>
                            <td class='name'>{{ $hol->user->name }}</td>
                            <td class='Job Title hide_divs'>{{ $hol->request_date }}</td>
                            <td class='lastcontact hide_divs'>{{ $hol->requested_date }}</td>
                            <td class='booked hide_divs'>{{ $booked }}</td>
                            <td class='accept'><a href='acceptrequest.php?id={{ $hol->holiday_id }}' title='Accept request'>Accept</a></td>
                            <td class='delete'><a class='' href='declinerequest.php?id={{ $hol->holiday_id }}' title='Decline request'>Decline</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div id='tabs-2'><!-- accepted -->
                    <table class='myTable tablesorter'>
                        <thead>
                        <tr>
                            <th style='width: 5%; position: relative;'>
                                <input type='checkbox' id='selectAllAccepted' name='select_all' />
                            </th>
                            <th class='no'>No</th>
                            <th class='name'>Name</th>
                            <th class='job_title'>Date Sent</th>
                            <th class='department'>Holiday Date</th>
                            <th class='booked'>Full/Half Day</th>
                            <th class='decline'>Decline</th>
                        </tr>

                        </thead>
                        <tbody>
                        @php $x = 1; @endphp
                        @foreach($holidaysAccepted as $hol)
                            @php
                                if ($hol->booked == 'Request sent') {
                                    $booked = 'Full day';
                                } else {
                                    $booked = 'Half a day';
                                }
                            @endphp
                            <tr>
                                <td class='checkbox-custom checkbox-primary mb5'>
                                    <input type='checkbox' class='undecidedCheckbox' name='request[]' value='{{ $hol->holiday_id }}' />
                                </td>
                                <td class='no'>{{ $x++ }}</td>
                                <td class='name'>{{ $hol->user->name }}</td>
                                <td class='Job Title hide_divs'>{{ $hol->request_date }}</td>
                                <td class='lastcontact hide_divs'>{{ $hol->requested_date }}</td>
                                <td class='booked hide_divs'>{{ $booked }}</td>
                                <td class='delete'><a class='' href='declinerequest.php?id={{ $hol->holiday_id }}' title='Decline request'>Decline</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div id='tabs-3'><!-- declined -->
                    <table class='myTable tablesorter'>
                        <thead>
                        <tr>
                            <th style='width: 5%; position: relative;'>
                                <input type='checkbox' id='selectAllDeclined' name='select_all' />
                            </th>
                            <th class='no'>No</th>
                            <th class='name'>Name</th>
                            <th class='job_title'>Date Sent</th>
                            <th class='department'>Holiday Date</th>
                            <th class='booked'>Full/Half Day</th>
                            <th class='decline'>Decline</th>
                        </tr>

                        </thead>
                        <tbody>
                        @php $x = 1; @endphp
                        @foreach($holidaysDeclined as $hol)
                            @php
                                if ($hol->booked == 'Request sent') {
                                    $booked = 'Full day';
                                } else {
                                    $booked = 'Half a day';
                                }
                            @endphp
                            <tr>
                                <td class='checkbox-custom checkbox-primary mb5'>
                                    <input type='checkbox' class='undecidedCheckbox' name='request[]' value='{{ $hol->holiday_id }}' />
                                </td>
                                <td class='no'>{{ $x++ }}</td>
                                <td class='name'>{{ $hol->user->name }}</td>
                                <td class='Job Title hide_divs'>{{ $hol->request_date }}</td>
                                <td class='lastcontact hide_divs'>{{ $hol->requested_date }}</td>
                                <td class='booked hide_divs'>{{ $booked }}</td>
                                <td class='accept'><a href='acceptrequest.php?id={{ $hol->holiday_id }}' title='Accept request'>Accept</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </form>
        <div class='clear'></div>
    </div><!--end of content-->
</div><!--end of content_wrapper-->

    <!--JavaScript-->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/axios.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    <script src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <script src="/js/requests.js"></script>
</body>
</html>
