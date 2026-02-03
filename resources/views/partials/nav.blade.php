{{-- Menu items are automatically provided by MenuComposer --}}
@php
@endphp
<ul class="flex overflow-visible md:overflow-visible max-h-[calc(100vh-4.5rem)] flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 dark:border-gray-700">
    @foreach($menuItems as $item)
        <li class="{{ $item['has_mega'] ?? false ? 'has-mega relative' : '' }}" 
            @if($item['has_mega'] ?? false) id="megaMenuItem" @endif>
            <a href="{{ $item['url'] }}"
                class="{{ ($item['has_mega'] ?? false) ? 'flex items-center z-10 gap-1' : 'block' }} py-2 px-3 md:p-0 rounded-sm {{ request()->routeIs($item['route']) ? 'text-white bg-blue-700 md:bg-transparent md:text-primary-800 md:dark:text-blue-500 font-bold md:after:bg-primary-800 after:absolute after:w-1/3 after:h-[1px] transform after:translate-y-[2px] after:bottom-0 after:left-0 after:dark:bg-primary-600 relative ' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary-700 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }}"
                @if(request()->routeIs($item['route'])) aria-current="page" @endif>
                {{ $item['label'] }}
                @if(isset($item['icon']))
                    <i data-lucide="{{ $item['icon'] }}" class="w-4"></i>
                @endif
            </a>

            @if($item['has_mega'] ?? false)
                <!-- Mega menu -->
                <div id="megaMenuContent"
                    class="mega-menu hidden transition-all duration-300 md:absolute rounded-2xl left-1/2 transform md:-translate-x-1/2 top-full mt-2 md:bg-white md:dark:bg-brand-gray md:shadow-lg md:min-w-5xl z-50">
                    <div class="grid md:grid-cols-{{ count($item['mega_menu']) }} gap-6 p-6">
                        @foreach($item['mega_menu'] as $column)
                            <div>
                                <h3 class="md:text-sm text-[13px] font-semibold text-gray-900 dark:text-white uppercase mb-3">
                                    {{ $column['title'] }}
                                </h3>
                                <ul class="space-y-2 text-gray-600 dark:text-gray-300 text-sm">
                                    @foreach($column['items'] as $subItem)
                                        <li>
                                            <a href="{{ $subItem['url'] ?? '#' }}" class="hover:text-blue-600">
                                                {{ $subItem['label'] ?? $subItem }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </li>
    @endforeach
</ul>
