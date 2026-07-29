@props(['href', 'active' => false, 'label'])

<a href="{{ $href }}"
    {{ $attributes->merge(['class' => 'flex items-center gap-3 px-3 py-2.5 rounded text-[12px] font-medium transition-all duration-150 ' . ($active ? 'bg-brand-navy-800 text-white border-l-[3px] border-brand-cyan-500' : 'text-white/60 hover:text-white hover:bg-white/5 border-l-[3px] border-transparent')]) }}>
    <svg class="w-[18px] h-[18px] flex-shrink-0 {{ $active ? 'text-brand-cyan-500' : 'text-white/40' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        {{ $slot }}
    </svg>
    <span>{{ $label }}</span>
</a>
