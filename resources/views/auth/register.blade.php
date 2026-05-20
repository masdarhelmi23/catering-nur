<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru - Panel Catering Nur Baluwarti</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .bg-luxury-dark { background: radial-gradient(circle at center, #1e1b4b 0%, #0f172a 60%, #020617 100%); }
        .glow-effect {
            position: absolute; width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(194, 155, 64, 0.04) 0%, transparent 70%);
            top: 50%; left: 50%; transform: translate(-25%, -50%); pointer-events: none;
        }
        .luxury-input { transition: all 0.25s ease-in-out; }
        .luxury-input:focus { background-color: #ffffff; border-color: #c29b40; box-shadow: 0 0 0 4px rgba(194, 155, 64, 0.08); }
    </style>
</head>
<body class="bg-luxury-dark min-h-screen flex items-center justify-center p-4 md:p-8 relative overflow-hidden">

    <div class="glow-effect"></div>

    <div class="w-full max-w-[880px] bg-white rounded-2xl shadow-2xl md:shadow-amber-950/20 overflow-hidden flex flex-col md:flex-row min-h-[550px] z-10 border border-white/5">
        
        <div class="w-full md:w-1/2 p-8 lg:p-12 flex flex-col justify-between bg-white">
            <div>
                <a href="/" class="font-serif text-lg tracking-[0.2em] font-bold text-[#1a2232] hover:text-[#c29b40] transition duration-300 inline-block">
                    NUR BALUWARTI
                </a>
                <p class="text-[9px] uppercase tracking-[0.3em] text-gray-500 font-semibold mt-1">Cita Rasa Otentik & Katering</p>
            </div>

            <div class="my-auto py-4">
                <div class="mb-4">
                    <h2 class="font-serif text-2xl font-bold text-[#1a2232] tracking-wide">Daftar Akun</h2>
                    <p class="text-xs text-gray-600 font-medium mt-1">Lengkapi data di bawah untuk membuat akun pengelola baru.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-50 border border-red-100 text-red-600 rounded-xl text-xs font-semibold flex items-start gap-2">
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ url('/register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-1">Nama Lengkap</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap Anda" required autofocus
                               class="luxury-input w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-1">Alamat Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="admin@gmail.com" required
                               class="luxury-input w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-1">Kata Sandi</label>
                        <input id="password" type="password" name="password" placeholder="••••••••" required
                               class="luxury-input w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none">
                    </div>

                    <button type="submit" class="w-full bg-[#1a2232] text-white hover:bg-[#2d3748] py-2.5 px-4 text-xs uppercase tracking-widest font-semibold rounded-xl transition duration-200 shadow-sm border border-transparent focus:outline-none">
                        Daftar Akun Baru
                    </button>

                    <div class="flex items-center my-4">
                        <div class="flex-grow h-px bg-gray-200"></div>
                        <span class="px-3 text-[10px] text-gray-400 font-bold uppercase tracking-widest bg-white">Atau</span>
                        <div class="flex-grow h-px bg-gray-200"></div>
                    </div>

                    <div class="mb-2">
                        <a href="{{ route('google.login') }}" class="w-full flex items-center justify-center gap-3 bg-white border border-gray-300 hover:border-gray-400 text-gray-700 py-2.5 px-4 text-xs font-bold rounded-xl transition duration-200 shadow-sm focus:outline-none">
                            <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google Logo" class="w-4 h-4">
                            DAFTAR DENGAN GOOGLE
                        </a>
                    </div>

                    <div class="mt-4 text-center">
                        <p class="text-xs text-gray-600">Sudah punya akun? <a href="{{ url('/login') }}" class="text-[#c29b40] font-bold hover:underline">Masuk di sini</a></p>
                    </div>
                </form>
            </div>

            <div>
                <p class="text-[9px] text-gray-500 uppercase tracking-widest font-semibold">&copy; {{ date('Y') }} Nur Baluwarti</p>
            </div>
        </div>

        <div class="w-full md:w-1/2 relative min-h-[200px] md:min-h-full bg-slate-900">
            <img src="https://images.unsplash.com/photo-1547573854-74d2a71d0826?q=80&w=2070" alt="Luxury" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent"></div>
        </div>
    </div>

</body>
</html>