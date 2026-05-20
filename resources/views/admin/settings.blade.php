<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - Catering Nur Baluwarti</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .bg-luxury-dark { background: radial-gradient(circle at bottom left, #1e1b4b 0%, #0f172a 55%, #020617 100%); }
        .luxury-glass { background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(14px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .luxury-input { transition: all 0.2s ease-in-out; }
        .luxury-input:focus { border-color: #c29b40; background-color: rgba(15, 23, 42, 0.8); box-shadow: 0 0 0 3px rgba(194, 155, 64, 0.15); }
    </style>
</head>
<body class="bg-luxury-dark min-h-screen text-slate-100 flex flex-col">

    @include('admin.layouts.navbar')

    <main class="flex-grow p-4 md:p-8 max-w-[650px] w-full mx-auto space-y-6">
        
        <div class="space-y-0.5 border-b border-white/5 pb-4">
            <h2 class="font-serif text-xl md:text-2xl font-bold text-white tracking-wide">Pengaturan Keamanan Profil</h2>
            <p class="text-xs text-slate-400">Kelola nama kredensial login dan pembaruan sandi akun enkripsi admin.</p>
        </div>

        @if(session('success'))
            <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-semibold rounded-xl flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-sm"></i> {{ session('success') }}
            </div>
        @endif

        <div class="luxury-glass rounded-2xl p-6 md:p-8 border border-white/5 shadow-2xl">
            <form method="POST" action="{{ url('/admin/settings') }}">
                @csrf
                @method('PUT')

                <div class="space-y-2 mb-5">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Nama Lengkap Administrator</label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required 
                           class="luxury-input w-full px-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm text-white focus:outline-none">
                </div>

                <div class="space-y-2 mb-5">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Password Baru (Kosongkan jika tidak diganti)</label>
                    <input type="password" name="password" 
                           class="luxury-input w-full px-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm text-white focus:outline-none">
                </div>

                <div class="space-y-2 mb-6">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" 
                           class="luxury-input w-full px-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-sm text-white focus:outline-none">
                </div>

                <div class="flex justify-end pt-2 border-t border-white/5">
                    <button type="submit" class="px-5 py-2.5 bg-[#c29b40] hover:bg-[#b08a35] text-slate-950 text-xs font-bold uppercase tracking-widest rounded-xl shadow-lg transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>

    <footer class="w-full text-center py-4 bg-black/40 border-t border-white/5 text-[10px] text-slate-500 uppercase tracking-widest font-semibold mt-12">
        &copy; {{ date('Y') }} Catering Nur Baluwarti System &bull; All Rights Reserved
    </footer>

</body>
</html>