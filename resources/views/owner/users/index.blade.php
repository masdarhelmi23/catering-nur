<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Karyawan - Catering Nur Baluwarti</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .bg-luxury-dark { background: radial-gradient(circle at bottom left, #1e1b4b 0%, #0f172a 55%, #020617 100%); }
        .luxury-glass { background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(14px); border: 1px solid rgba(255, 255, 255, 0.05); }
    </style>
</head>
<body class="bg-luxury-dark min-h-screen text-slate-100 flex flex-col">

    @include('owner.layouts.navbar')

    <main class="flex-grow p-4 md:p-8 space-y-6 max-w-[1600px] w-full mx-auto">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white/[0.02] p-6 rounded-2xl border border-white/5 shadow-lg">
            <div>
                <h2 class="font-serif text-xl md:text-2xl font-bold text-white tracking-wide">Kendali Akun Staf & Karyawan</h2>
                <p class="text-xs text-slate-400 mt-0.5">Tambah staf pengelola kasir admin baru atau ubah hak akses otoritas ke dalam sistem katering.</p>
            </div>
            <a href="{{ url('/owner/users/create') }}" class="px-4 py-2.5 bg-[#c29b40] hover:bg-[#b08a35] text-slate-950 text-xs font-bold rounded-xl shadow-lg transition duration-200 flex items-center gap-2">
                <i class="fa-solid fa-user-plus text-sm"></i> Daftarkan Staf Baru
            </a>
        </div>

        @if(session('success'))
            <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-semibold rounded-xl flex items-center gap-2 animate-fade-in">
                <i class="fa-solid fa-circle-check text-sm"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="p-4 bg-red-500/10 border border-red-500/20 text-red-400 text-xs font-semibold rounded-xl flex items-center gap-2 animate-fade-in">
                <i class="fa-solid fa-circle-exclamation text-sm"></i> {{ session('error') }}
            </div>
        @endif

        <div class="luxury-glass rounded-2xl overflow-hidden shadow-2xl">
            <div class="p-5 border-b border-white/5 bg-white/[0.01] flex justify-between items-center">
                <h3 class="font-serif text-base font-bold text-white tracking-wide">Daftar Otoritas Anggota</h3>
                <span class="px-2.5 py-0.5 bg-amber-500/10 text-amber-400 border border-amber-500/20 text-[9px] uppercase font-mono tracking-widest rounded-md">Manajemen User</span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-black/20 text-slate-400 text-[10px] uppercase tracking-wider border-b border-white/5">
                            <th class="py-3.5 px-5">Nama Anggota</th>
                            <th class="py-3.5 px-5">Alamat Email Resmi</th>
                            <th class="py-3.5 px-5 text-center">Level Akses (Role)</th>
                            <th class="py-3.5 px-5 text-center">Aksi Kendali</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs divide-y divide-white/5 text-slate-300">
                        @foreach($users as $user)
                            <tr class="hover:bg-white/[0.01] transition duration-150">
                                <td class="py-4 px-5 font-semibold text-white flex items-center gap-3">
                                    <div class="w-7 h-7 rounded-lg bg-white/5 text-slate-300 border border-white/10 flex items-center justify-center text-[10px] font-mono font-bold">
                                        {{ substr($user->name, 0, 2) }}
                                    </div>
                                    {{ $user->name }}
                                </td>
                                
                                <td class="py-4 px-5 font-mono text-slate-400">{{ $user->email }}</td>
                                
                                <td class="py-4 px-5 text-center">
                                    @if($user->role === 'owner')
                                        <span class="px-2.5 py-1 bg-red-500/10 text-red-400 border border-red-500/20 text-[9px] font-bold rounded-lg uppercase tracking-wide inline-block">
                                            <i class="fa-solid fa-crown mr-1"></i>Owner Utama
                                        </span>
                                    @elseif($user->role === 'admin')
                                        <span class="px-2.5 py-1 bg-blue-500/10 text-blue-400 border border-blue-500/20 text-[9px] font-bold rounded-lg uppercase tracking-wide inline-block">
                                            <i class="fa-solid fa-user-shield mr-1"></i>Staf Admin
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 bg-slate-500/20 text-slate-400 border border-white/5 text-[9px] font-bold rounded-lg uppercase tracking-wide inline-block">
                                            <i class="fa-solid fa-user text-slate-500 mr-1"></i>{{ $user->role }}
                                        </span>
                                    @endif
                                </td>
                                
                                <td class="py-4 px-5">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ url('/owner/users/'.$user->id.'/edit') }}" 
                                           class="w-7 h-7 flex items-center justify-center bg-blue-500/10 border border-blue-500/20 hover:bg-blue-500 text-blue-400 hover:text-white rounded-lg text-xs transition duration-150"
                                           title="Ubah Kredensial User">
                                            <i class="fa-solid fa-user-pen"></i>
                                        </a>
                                        
                                        <form action="{{ url('/owner/users/'.$user->id) }}" method="POST" class="m-0" onsubmit="return confirm('Apakah Anda yakin ingin mencabut hak akses masuk karyawan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="w-7 h-7 flex items-center justify-center bg-red-500/10 border border-red-500/20 hover:bg-red-500 text-red-400 hover:text-white rounded-lg text-xs transition duration-150"
                                                    title="Hapus Akun Karyawan">
                                                <i class="fa-solid fa-user-minus"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer class="w-full text-center py-4 bg-black/40 border-t border-white/5 text-[10px] text-slate-500 uppercase tracking-widest font-semibold mt-12">
        &copy; {{ date('Y') }} Catering Nur Baluwarti Owner Audit System &bull; All Rights Reserved
    </footer>

</body>
</html>