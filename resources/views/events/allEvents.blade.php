<!DOCTYPE html>
<html lang="en">
<head>
    <title>ACN Events</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>All Events</h2>
    <table class="table table-bordered">
        <tbody>
        @foreach($events as $event)
            <tr>
                <td>{{ $event->name }}</td>
                <td>{{ $event->slug }}</td>
                <td>{{ date('j F Y h:i:s',strtotime($event->createdAt)) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
