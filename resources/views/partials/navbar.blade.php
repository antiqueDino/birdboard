<div class="flex justify-between items-center py-2"> 
    <h1>
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="/images/logo.svg" alt="Birdboard">
        </a>
    </h1>
        
    <div class="flex items-center ml-auto list-reset text-default">

        <!-- Right Side Of Navbar -->
        <ul class="flex navbar-nav ml-auto list-reset">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item inline-block  px-3">
                        <a class="nav-link " href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif
                
                @if (Route::has('register'))
                    <li class="nav-item inline-block  px-3">
                        <a class="nav-link mr-5" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else

                <theme-switcher></theme-switcher>

                <li class="nav-item dropdown flex space-x-4">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle flex-1" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right flex-1" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item inline-block" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</div>

