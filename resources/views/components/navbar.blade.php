<nav class="w-full bg-white flex justify-between items-center px-[5%] h-[60px] border-b-[1px] z-50" style="position: sticky;top: 0">
    @if ( request()->routeIs('login') )
        <a href="/" class="font-bold tracking-[0.1em]">UNJAYA</a>
    @else
        <a href="/home" class="font-bold tracking-[0.1em]">UNJAYA</a>
    @endif

    <ul {{ request()->routeIs('login') ? 'hidden' : '' }}>
        @if(session()->has('user'))

        <label class="absolute top-4 right-6 group">
            <span class="text-[20px]"><i class="fa-solid fa-user"></i></span>
            <input type="checkbox" name="" id="" class="peer opacity-0">
            <div class="absolute hidden peer-checked:block right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                <div class="py-1" role="none">
                  <a href="/profile" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Profile</a>
                  <form action="/logout" method="POST">
                    @csrf
                    <button class="text-gray-700 block w-full px-4 py-2 text-left text-sm" type="submit">Logout</button>
                </form>
                </div>
              </div>
        </label>

        @else
            <!-- Pengguna belum masuk -->
            <li><a href="login" class="text-white bg-black px-8 py-2 rounded-full hover:opacity-80">Login</a></li>
        @endif
    </ul>
</nav>
