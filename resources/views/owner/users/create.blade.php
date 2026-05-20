<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftarkan Staf Karyawan - Catering Nur Baluwarti</title>
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
<body class="bg-luxury-dark min-h-screen text-slate-100 flex flex-col justify-center p-4">

    <div class="luxury-glass max-w-md w-full mx-auto rounded-2xl p-6 md:p-8 space-y-6 shadow-2xl">
        <div class="text-center space-y-1">
            <h2 class="font-serif text-xl md:text-2xl font-bold text-white tracking-wide">Registrasi Karyawan Baru</h2>
            <p class="text-xs text-slate-400">Buat akun kredensial akses masuk panel pimpinan atau staf kasir katering.</p>
        </div>

        @if ($errors->any())
            <div class="p-3.5 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl text-xs font-semibold flex flex-col gap-1 animate-fade-in">
                @foreach ($errors->all() as $error)
                    <p><i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ url('/owner/users') }}" class="space-y-4 text-xs md:text-sm">
            @csrf
            
            <div class="space-y-1.5">
                <label class="text-slate-400 font-bold uppercase tracking-wider text-[10px]">Nama Lengkap Staf</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500 text-xs">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Ketik nama lengkap staf..." 
                           class="luxury-input w-full pl-9 pr-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-white placeholder-slate-600 focus:outline-none">
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-slate-400 font-bold uppercase tracking-wider text-[10px]">Alamat Email Resmi</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500 text-xs">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="staf@cateringsystem.com" 
                           class="luxury-input w-full pl-9 pr-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-white placeholder-slate-600 focus:outline-none">
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-slate-400 font-bold uppercase tracking-wider text-[10px]">Kata Sandi Akses (Min 6 Karakter)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500 text-xs">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input type="password" name="password" required placeholder="Ketik sandi rahasia akun..." 
                           class="luxury-input w-full pl-9 pr-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-white placeholder-slate-600 focus:outline-none">
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-slate-400 font-bold uppercase tracking-wider text-[10px]">Pilih Otoritas Hak Akses (Role)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500 text-xs">
                        <i class="fa-solid fa-user-shield"></i>
                    </span>
                    <select name="role" required class="luxury-input w-full pl-9 pr-4 py-2.5 bg-black/30 border border-white/10 rounded-xl text-slate-300 focus:outline-none cursor-pointer">
                        <option value="admin" class="bg-slate-950 text-slate-200 font-semibold">Staf Admin / Kasir</option>
                        <option value="owner" class="bg-slate-950 text-slate-200 font-semibold">Pimpinan / Co-Owner</option>
                    </select>
                </div>
            </div>

            <div class="flex gap-3 pt-3">
                <a href="{{ url('/owner/users') }}" 
                   class="w-1/2 text-center py-2.5 bg-white/5 border border-white/10 rounded-xl text-slate-300 hover:text-white hover:bg-white/10 font-bold uppercase tracking-wider text-[11px] transition">
                    <i class="fa-solid fa-xmark mr-1"></i> Batal
                </a>
                <button type="submit" 
                        class="w-1/2 py-2.5 bg-[#c29b40] hover:bg-[#b08a35] text-slate-950 font-bold uppercase tracking-wider text-[11px] rounded-xl shadow-lg transition duration-150">
                    <i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Staf
                </button>
            </div>
        </form>
    </div>

</body>
</html>