<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>SPA App.</title>
   <!-- Styles -->
   <link rel="stylesheet" href="{{ asset('css/app.css') }}">
   <!-- Scripts -->
   <script src="{{ mix('/js/app.js') }}" defer></script>
</head>

<body>
   <div id="app">
      <!-- navigation links -->
      <router-view></router-view>

      <!-- main component -->
      {{-- <application></application> --}}

      <!-- example component -->
      {{-- <example-component></example-component> --}}
   </div>
</body>

</html>
