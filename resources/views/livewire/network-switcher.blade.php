<div>
  <div class="network-switcher dropdown inline-block relative" x-data="{ open: false }" @click.away="open = false">

    <div class="bg-gray-300 font-semibold px-4 rounded block text-xs text-theme-text-thead text-right" @click="open = true">
      Network
    </div>
    <button class="bg-gray-300 font-semibold pb-2 px-4 rounded inline-flex items-center" @click="open = true">
          <span class="mr-1 selected-network">{{ $selectedNetwork }}</span>
          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/> </svg>
    </button>

    <ul class="dropdown-menu absolute pt-1 bg-white rounded w-full shadow pb-2 network-switcher-menu" x-show="open">
      @foreach($availableNetworks as $network)
          <li><a title="{{ $network['title'] }}" class="rounded-t bg-gray-200 hover:bg-gray-400 pt-3 pb-1 px-5 block whitespace-no-wrap theme-text" href="#" wire:click="changeNetwork('{{ $network['value'] }}')" @click="open = false">{{ $network['value']}}</a></li>
      @endforeach
    </ul>

  </div>
</div>
