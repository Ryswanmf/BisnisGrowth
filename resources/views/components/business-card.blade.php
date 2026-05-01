@props(['business'])

<div class="card flex flex-col h-full hover:shadow-lg transition-shadow">
    <div class="flex items-center gap-4 mb-4">
        <div class="relative">
            <img src="{{ $business->logo ? asset($business->logo) : 'https://ui-avatars.com/api/?name=' . urlencode($business->name) . '&background=7B1F2E&color=FFF8E7' }}" 
                 alt="{{ $business->name }}" 
                 class="w-16 h-16 rounded object-cover border-2 border-gray-50"
                 loading="lazy">
            @if($business->is_verified)
                <div class="absolute -bottom-1 -right-1 bg-gold-400 text-burgundy-800 rounded p-1" title="Terverifikasi">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
            @endif
        </div>
        <div>
            <h3 class="font-bold text-burgundy-900 line-clamp-1">{{ $business->name }}</h3>
            <p class="text-xs text-gray-500">{{ $business->city }} · {{ $business->category->name }}</p>
        </div>
    </div>
    
    <p class="text-sm text-gray-600 line-clamp-2 mb-6 flex-grow">
        {{ $business->tagline ?? Str::limit($business->description, 80) }}
    </p>

    <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-50">
        <div class="flex items-center text-xs text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            {{ number_format($business->view_count) }}
        </div>
        <a href="/{{ $business->slug }}" class="text-sm font-semibold text-burgundy-600 hover:text-burgundy-800 transition-colors inline-flex items-center">
            Lihat Profil
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
        </a>
    </div>
</div>
