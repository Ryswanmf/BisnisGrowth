@if(session('success'))
<div x-data="{ show: true }" 
     x-show="show" 
     x-init="setTimeout(() => show = false, 5000)"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform translate-y-4"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100 transform translate-y-0"
     x-transition:leave-end="opacity-0 transform translate-y-4"
     class="fixed bottom-10 right-10 z-[100] max-w-md w-full">
    <div class="bg-slate-900 border border-white/10 rounded-3xl p-6 shadow-2xl shadow-slate-900/50 flex items-center gap-5">
        <div class="h-12 w-12 bg-emerald-500 rounded-2xl flex items-center justify-center text-slate-900 shrink-0 shadow-lg shadow-emerald-500/20">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <div class="flex-1">
            <p class="text-[10px] font-black text-emerald-400 uppercase tracking-widest mb-1">Berhasil Disimpan</p>
            <p class="text-sm font-bold text-white leading-snug">{{ session('success') }}</p>
        </div>
        <button @click="show = false" class="text-white/20 hover:text-white transition-colors">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>
@endif

@if(session('error') || $errors->any())
<div x-data="{ show: true }" 
     x-show="show" 
     x-init="setTimeout(() => show = false, 8000)"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform translate-y-4"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100 transform translate-y-0"
     x-transition:leave-end="opacity-0 transform translate-y-4"
     class="fixed bottom-10 right-10 z-[100] max-w-md w-full">
    <div class="bg-slate-900 border border-white/10 rounded-3xl p-6 shadow-2xl shadow-slate-900/50 flex items-center gap-5">
        <div class="h-12 w-12 bg-red-500 rounded-2xl flex items-center justify-center text-white shrink-0 shadow-lg shadow-red-500/20">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>
        <div class="flex-1">
            <p class="text-[10px] font-black text-red-400 uppercase tracking-widest mb-1">Terjadi Kesalahan</p>
            <p class="text-sm font-bold text-white leading-snug">
                {{ session('error') ?: 'Mohon periksa kembali isian formulir Anda.' }}
            </p>
        </div>
        <button @click="show = false" class="text-white/20 hover:text-white transition-colors">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>
@endif
