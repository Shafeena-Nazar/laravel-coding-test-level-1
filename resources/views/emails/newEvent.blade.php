<html>
<body>
<div>
    <h3>New Event Created</h3>

    <p>Event Name : {{ $event->name }}</p>
    <p>Event Slug : {{ $event->slug }}</p>
    <p>Event Created Date : {{ date('j F Y h:i:s',strtotime($event->createdAt)) }}</p>

    <a href="{{ route('showAllEvents') }}">View All Events</a>
</div>
</body>
</html>
