<div>
    <div class="bg-white py-3 flex items-center justify-between px-6">
        <div class="flex flex-col items-center w-full">
            <div class="m-5">
                <p class="text-md leading-5 text-gray-700">
                    Showing
                    <span class="font-medium">{{ $page }}</span>
                    to
                    <span class="font-medium">{{ $page + ( $limit - 1 ) }}</span>
                    of
                    <span class="font-medium">{{ $pageCount }}</span>
                    {{ $contextLabel }}
                </p>
            </div>

            <div>
                <nav
                    class="relative inline-flex h-10"
                    x-data=" { inputPage: '{{ $inputPage }}', pageCount: {{ $pageCount }}, 'initialPage': '{{ $page }}'}">

                    <button
                        :disabled="initialPage < 2"
                        type="button"
                        class="inline-flex text-white bg-grey text-3xl leading-none ml-2 mr-5 rounded px-1 pr-2"
                        aria-label="Previous"
                        onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
                        wire:click="page({{ $page - 1}})">◄</button>

                    <div class="border-b border-b-2 border-teal-500 py-2 w-32">

                        <input
                            class="appearance-none bg-transparent border-none w-full text-grey font-bold mr-3 py-1 px-2 leading-tight focus:outline-none"
                            placeholder="1"
                            aria-label="Page counter"
                            maxlength="{{ strlen($pageCount) }}"
                            min="0"
                            type="number"
                            max="{{ $pageCount }}"
                            wire:page="page"
                            @keydown.enter="window.scrollTo({top: 0, behavior: 'smooth'})"
                            wire:keydown.enter="page({{ $inputPage }})"
                            wire:model="inputPage">
                    </div>

                    <button
                        :disabled="initialPage === inputPage && inputPage > pageCount"
                        type="button"
                        class="inline-flex text-white bg-grey text-sm leading-none ml-4 rounded px-3 font-bold"
                        aria-label="Next"
                        wire:page="page"
                        onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
                        wire:click="page({{ $inputPage }})">Go</button>

                    <button
                        :title="`Go to page {{ $page + 1}}`"
                        :disabled="initialPage >= pageCount"
                        type="button"
                        type="button"
                        class="inline-flex text-white bg-grey text-3xl leading-none ml-5 rounded px-2 pr-1"
                        aria-label="Next"
                        onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
                        wire:click="page({{ $page + 1}})"
                        wire:keyup="showSubmitButton = true">►</button>
                </nav>
            </div>
        </div>
    </div>
</div>
