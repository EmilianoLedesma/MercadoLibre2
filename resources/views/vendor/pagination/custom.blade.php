@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" style="display: flex; align-items: center; gap: 4px;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span style="min-width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; padding: 0 12px; border: 1px solid #E5E5E5; border-radius: 4px; color: #999; background-color: #F5F5F5; cursor: not-allowed;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" style="min-width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; padding: 0 12px; border: 1px solid #E5E5E5; border-radius: 4px; color: #EE403D; background-color: white; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#FFEBEA'; this.style.borderColor='#EE403D';" onmouseout="this.style.backgroundColor='white'; this.style.borderColor='#E5E5E5';">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span style="min-width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; padding: 0 12px; border: 1px solid #E5E5E5; border-radius: 4px; color: #999; background-color: white;">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page" style="min-width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; padding: 0 12px; border: 1px solid #EE403D; border-radius: 4px; color: white; background-color: #EE403D; font-weight: 600; font-size: 14px;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="min-width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; padding: 0 12px; border: 1px solid #E5E5E5; border-radius: 4px; color: #EE403D; background-color: white; text-decoration: none; font-size: 14px; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#FFEBEA'; this.style.borderColor='#EE403D';" onmouseout="this.style.backgroundColor='white'; this.style.borderColor='#E5E5E5';">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" style="min-width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; padding: 0 12px; border: 1px solid #E5E5E5; border-radius: 4px; color: #EE403D; background-color: white; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#FFEBEA'; this.style.borderColor='#EE403D';" onmouseout="this.style.backgroundColor='white'; this.style.borderColor='#E5E5E5';">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </a>
        @else
            <span style="min-width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; padding: 0 12px; border: 1px solid #E5E5E5; border-radius: 4px; color: #999; background-color: #F5F5F5; cursor: not-allowed;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </span>
        @endif
    </nav>
@endif
