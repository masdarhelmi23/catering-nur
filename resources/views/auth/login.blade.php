<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Panel Catering Nur Baluwarti</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
        }
        .font-serif { 
            font-family: 'Playfair Display', serif; 
        }
        /* Latar belakang luar: Gradasi Gelap, Mewah, & Sinematik */
        .bg-luxury-dark {
            background: radial-gradient(circle at center, #1e1b4b 0%, #0f172a 60%, #020617 100%);
        }
        /* Efek pendaran cahaya emas halus di latar belakang luar */
        .glow-effect {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(194, 155, 64, 0.04) 0%, transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-25%, -50%);
            pointer-events: none;
        }
        /* Transisi kolom input */
        .luxury-input {
            transition: all 0.25s ease-in-out;
        }
        .luxury-input:focus {
            background-color: #ffffff;
            border-color: #c29b40;
            box-shadow: 0 0 0 4px rgba(194, 155, 64, 0.08);
        }
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

            <div class="my-auto py-6">
                <div class="mb-6">
                    <h2 class="font-serif text-2xl font-bold text-[#1a2232] tracking-wide">Login Akun</h2>
                    <p class="text-xs text-gray-600 font-medium mt-1">Silakan masuk untuk mengakses halaman panel pengelola katering.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-50 border border-red-100 text-red-600 rounded-xl text-xs font-semibold flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-4 h-4 shrink-0 mt-0.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                        </svg>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ url('/login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-1.5">Alamat Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" 
                               placeholder="admin@gmail.com" required autofocus
                               class="luxury-input w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm text-gray-800 placeholder-gray-500 focus:outline-none">
                    </div>

                    <div class="mb-5">
                        <label for="password" class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-1.5">Kata Sandi</label>
                        <input id="password" type="password" name="password" 
                               placeholder="••••••••" required
                               class="luxury-input w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm text-gray-800 placeholder-gray-500 focus:outline-none">
                    </div>

                    <div class="flex items-center mb-5">
                        <input id="remember" type="checkbox" name="remember" 
                               class="w-3.5 h-3.5 rounded border-gray-300 text-[#1a2232] focus:ring-0 accent-[#1a2232] cursor-pointer">
                        <label for="remember" class="ml-2 text-xs text-gray-600 cursor-pointer select-none font-semibold">Tetap simpan sesi masuk saya</label>
                    </div>

                    <button type="submit" class="w-full bg-[#1a2232] text-white hover:bg-[#2d3748] active:scale-[0.99] py-3 px-4 text-xs uppercase tracking-widest font-semibold rounded-xl transition duration-200 shadow-sm border border-transparent focus:outline-none">
                        Masuk Ke Panel
                    </button>

                    <div class="relative flex py-4 items-center">
                        <div class="flex-grow border-t border-gray-200"></div>
                        <span class="flex-shrink mx-4 text-[10px] text-gray-400 uppercase tracking-widest font-semibold">atau masuk dengan</span>
                        <div class="flex-grow border-t border-gray-200"></div>
                    </div>

                    <a href="{{ url('/auth/google') }}" class="w-full flex items-center justify-center gap-3 bg-white hover:bg-gray-50 active:scale-[0.99] border border-gray-300 py-2.5 px-4 rounded-xl text-xs font-bold text-gray-700 transition duration-200 shadow-sm">
                        <svg class="w-4 h-4" viewBox="0 0 24 24">
                            <path fill="#EA4335" d="M12.24 10.285V14.4h6.887c-.275 1.565-1.88 4.604-6.887 4.604-4.33 0-7.866-3.577-7.866-8s3.536-8 7.866-8c2.46 0 4.105 1.025 5.047 1.926l3.227-3.103C18.228 1.956 15.48.75 12.24.75c-6.22 0-11.25 5.03-11.25 11.25s5.03 11.25 11.25 11.25c6.488 0 10.8-4.546 10.8-10.996 0-.74-.08-1.3-.176-1.854H12.24z"/>
                        </svg>
                        Akun Google Resmi
                    </a>

                </form>
            </div>

            <div>
                <p class="text-[9px] text-gray-500 uppercase tracking-widest font-semibold">&copy; {{ date('Y') }} Nur Baluwarti</p>
            </div>

        </div>

        <div class="w-full md:w-1/2 relative min-h-[250px] md:min-h-full bg-slate-900">
            
            <img src="https://images.unsplash.com/photo-1547573854-74d2a71d0826?q=80&w=2070" 
                 alt="Luxury Bright Catering Layout" 
                 class="absolute inset-0 w-full h-full object-cover">
            
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

            <div class="absolute bottom-8 left-8 right-8 z-10 hidden md:block">
                <span class="text-[10px] uppercase tracking-[0.35em] text-[#d97706] font-bold block mb-2 drop-shadow-md">Warisan Kuliner</span>
                <h3 class="font-serif text-xl text-white leading-relaxed font-semibold drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">
                    Menyajikan hidangan istimewa dengan standar pelayanan terbaik untuk setiap momen berharga Anda.
                </h3>
                <div class="h-[2px] w-8 bg-[#d97706] mt-4 shadow-sm"></div>
            </div>

        </div>

    </div>

</body>
</html>