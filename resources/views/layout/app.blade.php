<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>LocaZenFaso</title>
  @vite('resources/css/app.css')
 
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

   
  @vite('resources/css/app.css')
  

</head>

<body class="bg-white min-h-sceen">
  <script src="//unpkg.com/alpinejs" defer></script>
 
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> 
  <script>
    AOS.init();
  </script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    if(Notification.permission !== 'granted'){
      Notification.requestPermission().then(permission =>{
        if(permission ==='granted'){
            alert('✅ Notifications activées');

        }else{
          alert('🚫 Notifications refusées');

        }
      })
    }
  
  });
</script>

  <div>
    @yield('content')
  </div>



</body>

</html>