<x-app-layout>
    <x-slot name="title">Hubungi Kami — BisnisGrowth</x-slot>

    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <span class="text-amber-600 text-[10px] font-black uppercase tracking-[0.3em] mb-4 block">Kontak Resmi</span>
                <h1 class="text-4xl md:text-6xl font-black text-slate-900 tracking-tight mb-8">Ada Pertanyaan? <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-amber-700">Hubungi Kami</span></h1>
                <p class="text-gray-500 text-lg font-medium leading-relaxed">Kami siap membantu Anda mengoptimalkan pertumbuhan bisnis Anda melalui solusi direktori dan edukasi terbaik.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Info Cards -->
                <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100 text-center group hover:shadow-2xl hover:shadow-slate-200 transition-all duration-500">
                    <div class="h-16 w-16 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 mx-auto mb-8 group-hover:bg-amber-500 group-hover:text-white transition-all">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-4">Email</h3>
                    <p class="text-gray-500 font-medium">{{ $footerSetting->email ?? 'hello@bisnisgrowth.id' }}</p>
                </div>

                <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100 text-center group hover:shadow-2xl hover:shadow-slate-200 transition-all duration-500">
                    <div class="h-16 w-16 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 mx-auto mb-8 group-hover:bg-amber-500 group-hover:text-white transition-all">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-4">WhatsApp</h3>
                    <p class="text-gray-500 font-medium">{{ $footerSetting->phone ?? '+62 812-3456-7890' }}</p>
                </div>

                <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100 text-center group hover:shadow-2xl hover:shadow-slate-200 transition-all duration-500">
                    <div class="h-16 w-16 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 mx-auto mb-8 group-hover:bg-amber-500 group-hover:text-white transition-all">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-4">Kantor</h3>
                    <p class="text-gray-500 font-medium leading-relaxed">{{ $footerSetting->address ?? 'Jakarta, Indonesia.' }}</p>
                </div>
            </div>

            <!-- Simple Contact Form -->
            <div class="mt-20 max-w-4xl mx-auto bg-white p-12 rounded-[4rem] shadow-2xl shadow-slate-200 border border-gray-100">
                @if(session('success'))
                    <div class="mb-10 bg-emerald-50 border border-emerald-100 text-emerald-600 px-8 py-5 rounded-3xl text-sm font-black animate-pulse">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Nama Lengkap</label>
                            <input type="text" name="name" placeholder="Masukkan nama Anda" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm focus:ring-2 focus:ring-amber-500 font-medium" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Alamat Email</label>
                            <input type="email" name="email" placeholder="email@contoh.com" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm focus:ring-2 focus:ring-amber-500 font-medium" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Pesan Anda</label>
                        <textarea name="message" rows="6" placeholder="Apa yang bisa kami bantu?" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-sm focus:ring-2 focus:ring-amber-500 font-medium" required></textarea>
                    </div>
                    <button type="submit" class="w-full bg-slate-900 text-white py-5 rounded-3xl text-[10px] font-black uppercase tracking-[0.3em] hover:bg-amber-500 hover:text-slate-900 transition-all shadow-xl shadow-slate-900/10 uppercase">
                        Kirim Pesan Sekarang
                    </button>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
