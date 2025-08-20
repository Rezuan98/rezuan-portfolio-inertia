<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon: blue rounded "R" -->
<link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%20viewBox%3D%220%200%2064%2064%22%3E%0A%20%20%3Ccircle%20cx%3D%2232%22%20cy%3D%2232%22%20r%3D%2228%22%20fill%3D%22%232563eb%22/%3E%0A%20%20%3Ctext%20x%3D%2232%22%20y%3D%2240%22%20text-anchor%3D%22middle%22%20font-size%3D%2236%22%20font-family%3D%22Inter%2C%20ui-sans-serif%2C%20system-ui%2C%20-apple-system%2C%20Segoe%20UI%2C%20Roboto%2C%20Helvetica%20Neue%2C%20Arial%22%20fill%3D%22%23ffffff%22%20font-weight%3D%22700%22%3ER%3C/text%3E%0A%3C/svg%3E">

    
    <!-- Scripts -->
    {{-- @routes --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @inertiaHead
</head>
<body class="font-sans antialiased">
    @inertia
</body>
</html>