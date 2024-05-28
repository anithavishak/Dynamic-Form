<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container">
        <h1>Welcome to the Admin Dashboard</h1>
        <p>This is the admin panel where you can create dynamic forms.</p>
        <ul>
            <li><a href="{{ route('admin.forms.formlist') }}">Manage Forms</a></li>
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                    Logout
                </a></li> 
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> -->
            @csrf
        </form>
    </div>
</body>

</html>