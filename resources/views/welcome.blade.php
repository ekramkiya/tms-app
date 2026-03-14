<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome-page</title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Smooth Persian font (you can download Vazir or use Google Fonts) */
    @import url('https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/font-face.css');
    body {
      font-family: 'Vazir', sans-serif;
    }
  </style>
</head>
<body class="bg-gradient-to-r from-purple-400 via-pink-400 to-red-400 min-h-screen flex items-center justify-center">

  <div class="container mx-auto px-4">
    <div class="max-w-md mx-auto bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl p-10 text-center transform hover:scale-105 transition-transform duration-500">
      
      <!-- Logo -->
      <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="mx-auto w-36 h-36 mb-6 rounded-full shadow-lg">

      <!-- Welcome Message -->
      <h1 class="text-4xl font-extrabold mb-4 text-gray-900">به وبسایت ما خوش آمدید!</h1>
      <p class="text-gray-700 mb-8 text-lg">لطفاً برای ادامه وارد شوید</p>

      <!-- Login Button -->
      <a href="{{ url('/admin/login') }}" 
         class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-full shadow-md hover:shadow-xl transition-all duration-300">
        ورود
      </a>
    </div>
  </div>

</body>
</html>