<x-app-layout>
    <x-slot name="seo">
        <x-seo-head 
            title="Hubungi Kami - BisnisGrowth"
            description="Punya pertanyaan atau butuh bantuan? Tim BisnisGrowth siap membantu Anda digitalisasi bisnis."
        />
    </x-slot>

    <div class="bg-white">
        <!-- Header Section -->
        <div class="pt-16 pb-12 px-4 border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 lg:px-8">
                <span class="text-gold-600 text-[10px] font-black uppercase tracking-[0.3em] mb-4 block">Get in Touch</span>
                <h1 class="text-4xl md:text-6xl font-black text-burgundy-900 tracking-tighter leading-none mb-6 uppercase">
                    Hubungi <span class="text-gold-600">Kami</span>
                </h1>
                <p class="text-gray-500 text-sm md:text-base font-medium max-w-2xl leading-relaxed">
                    Kami selalu siap mendengar masukan, pertanyaan, atau tawaran kerjasama dari Anda. Jangan ragu untuk menghubungi kami melalui formulir atau kontak resmi di bawah ini.
                </p>
            </div>
        </div>

        <main class="bg-gray-50/30 py-20 px-4">
            <div class="max-w-7xl mx-auto px-4 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
                    
                    <!-- Left: Contact Form -->
                    <div class="lg:col-span-7 bg-white p-8 md:p-12 rounded-[2.5rem] shadow-xl shadow-burgundy-900/5 border border-gray-100">
                        <h2 class="text-2xl font-black text-burgundy-900 mb-8 uppercase tracking-tight">Kirim Pesan</h2>
                        
                        <form action="#" method="POST" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-1">Nama Lengkap</label>
                                    <input type="text" placeholder="Masukkan nama Anda..." class="w-full bg-gray-50 border border-gray-100 rounded-xl py-4 px-5 text-sm focus:outline-none focus:ring-2 focus:ring-burgundy-600/10 focus:border-burgundy-600 transition-all">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-1">Alamat Email</label>
                                    <input type="email" placeholder="nama@email.com" class="w-full bg-gray-50 border border-gray-100 rounded-xl py-4 px-5 text-sm focus:outline-none focus:ring-2 focus:ring-burgundy-600/10 focus:border-burgundy-600 transition-all">
                                </div>
                            </div>
                            
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-1">Subjek</label>
                                <input type="text" placeholder="Apa yang ingin Anda bicarakan?" class="w-full bg-gray-50 border border-gray-100 rounded-xl py-4 px-5 text-sm focus:outline-none focus:ring-2 focus:ring-burgundy-600/10 focus:border-burgundy-600 transition-all">
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-1">Pesan Anda</label>
                                <textarea rows="5" placeholder="Tuliskan pesan lengkap Anda di sini..." class="w-full bg-gray-50 border border-gray-100 rounded-xl py-4 px-5 text-sm focus:outline-none focus:ring-2 focus:ring-burgundy-600/10 focus:border-burgundy-600 transition-all"></textarea>
                            </div>

                            <button type="submit" class="w-full bg-burgundy-600 text-white font-black py-5 px-10 rounded-xl text-[10px] uppercase tracking-[0.2em] hover:bg-burgundy-800 transition-all shadow-lg shadow-burgundy-600/20">
                                Kirim Pesan Sekarang
                            </button>
                        </form>
                    </div>

                    <!-- Right: Contact Info -->
                    <aside class="lg:col-span-5 space-y-12">
                        <!-- Info Cards -->
                        <div class="space-y-8">
                            <div class="flex gap-6">
                                <div class="shrink-0 w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-gold-600 shadow-md border border-gray-100">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <h3 class="text-[10px] font-black uppercase tracking-widest text-burgundy-900 mb-1">Email Resmi</h3>
                                    <p class="text-gray-500 font-medium">hello@bisnisgrowth.id</p>
                                    <p class="text-gray-400 text-xs mt-1">Balasan dalam 1x24 jam kerja.</p>
                                </div>
                            </div>

                            <div class="flex gap-6">
                                <div class="shrink-0 w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-gold-600 shadow-md border border-gray-100">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <h3 class="text-[10px] font-black uppercase tracking-widest text-burgundy-900 mb-1">WhatsApp CS</h3>
                                    <p class="text-gray-500 font-medium">+62 812-3456-7890</p>
                                    <p class="text-gray-400 text-xs mt-1">Tersedia Senin - Jumat (09:00 - 17:00).</p>
                                </div>
                            </div>

                            <div class="flex gap-6">
                                <div class="shrink-0 w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-gold-600 shadow-md border border-gray-100">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <div>
                                    <h3 class="text-[10px] font-black uppercase tracking-widest text-burgundy-900 mb-1">Kantor Pusat</h3>
                                    <p class="text-gray-500 font-medium leading-relaxed">Jl. Business Growth No. 12, Kebayoran Baru, Jakarta Selatan, 12110.</p>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Placeholder -->
                        <div class="bg-burgundy-900 p-10 rounded-[2.5rem] text-white relative overflow-hidden group shadow-2xl">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full translate-x-1/2 -translate-y-1/2 transition-transform group-hover:scale-125 duration-700"></div>
                            <h3 class="text-xl font-bold mb-4 relative z-10">Bantuan Cepat</h3>
                            <p class="text-burgundy-100 text-xs mb-8 opacity-80 relative z-10 leading-relaxed font-medium">Temukan jawaban instan untuk pertanyaan umum Anda di pusat bantuan kami.</p>
                            <a href="#" class="text-gold-400 font-black text-[10px] uppercase tracking-widest flex items-center gap-2 group/link relative z-10">
                                Lihat Pusat Bantuan 
                                <svg class="w-3.5 h-3.5 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    </aside>

                </div>
            </div>
        </main>
    </div>
</x-app-layout>
