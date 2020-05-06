<div>
    <nav role="navigation" class="header min-h-50px md:min-h-80px mb-5 sm:mb-10 xl:rounded-md">

        <!-- Main Logo -->
        <a href="/" title="Home" class="logo-container w-50px md:w-80px h-50px md:h-80px flex-none bg-theme-accents text-2xl xl:rounded-l-md flex justify-center items-center router-link-exact-active router-link-active">
            <img alt="Graphic of ARK Blochain Explorer" src="{{asset('images/logo.png')}}" class="logo max-w-25px md:max-w-38px"/>
        </a>

        <!-- Navigation items -->
        <ul class="w-full relative flex px-4 md:px-8 overflow-auto flex-now-wrap">
            @foreach($navigationItems as $item)
                <li>
                    <a href="{{ $item['path'] }}" title="{{ $item['title'] }} "class="px-2 py-4 flex flex-none items-center border-b-2 mt-2px h-50px md:h-80px border-transparent hover:border-theme-accents hover:text-blue transition">
                        {{ $item['name'] }}
                    </a>
                </li>
                <span class="border-r mx-2 md:mx-4 lg:mx-6 my-4 flex"></span>
            @endforeach
        </ul>
    </nav>
</div>
