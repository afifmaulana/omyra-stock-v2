<div class="bottom-nav">
    <div class="d-flex justify-content-around">
        <a class="text-center py-2 m-0 {{ request()->routeIs(['frontend.dashboard.index']) ? 'active' : '' }}" href="{{ route('frontend.dashboard.index') }}">
            <i class="fas fa-home h-40 p-0 m-0"></i>
            <p class="font-xs text-light-pink p-0 m-0 {{ request()->routeIs(['frontend.dashboard.index']) ? 'text-active-pink' : '' }}">Home</p>
        </a>
        @if (Auth::user()->roles->pluck('name')[0] == 'warehouse')
        <a class="text-center py-2 m-0" href="{{ route('frontend.plastic.index') }}">
            <i class="fa fa-archive h-40 p-0 m-0"></i>
            <p class="font-xs text-light-pink p-0 m-0 text-center">Plastic</p>
        </a>
        <a class="text-center py-2 m-0" href="{{ route('frontend.inner.index') }}">
            <i class="fa fa-cubes h-40 p-0 m-0"></i>
            <p class="font-xs text-light-pink p-0 m-0 text-center">Inner <br>Box</p>
        </a>
        <a class="text-center py-2 m-0" href="{{ route('frontend.master.index') }}">
            <i class="fa fa-cube h-40 p-0 m-0"></i>
            <p class="font-xs text-light-pink p-0 m-0 text-center">Master <br>Carton</p>
        </a>
        @endif

        @if (Auth::user()->roles->pluck('name')[0] == 'staff')
        <a class="text-center py-2 m-0" href="{{ route('frontend.semi-finish.index') }}">
            <i class="fa fa-cube h-40 p-0 m-0"></i>
            <p class="font-xs text-light-pink p-0 m-0 text-center">Barang <br>1/2 Jadi</p>
        </a>
        <a class="text-center py-2 m-0" href="{{ route('frontend.finish.index') }}">
            <i class="fa fa-cubes h-40 p-0 m-0"></i>
            <p class="font-xs text-light-pink p-0 m-0">Barang<br> Jadi</p>
        </a>
        @endif
        <a class="text-center py-2 m-0" href="{{ route('frontend.profile.edit') }}">
            <i class="fa fa-user h-40 p-0 m-0"></i>
            <p class="font-xs text-light-pink p-0 m-0">Akun</p>
        </a>
    </div>
</div>
