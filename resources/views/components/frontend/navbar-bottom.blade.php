<div class="bottom-nav">
    <div class="d-flex justify-content-around">
        <a class="text-center py-2 m-0 {{ request()->routeIs(['frontend.dashboard.index']) ? 'active' : '' }}" href="{{ route('frontend.dashboard.index') }}">
            <div class="text-light-pink {{ request()->routeIs(['frontend.dashboard.index']) ? 'text-active-pink' : '' }}">
                <i class="fas fa-home h-40 p-0 m-0"></i>
            </div>
            <p class="font-xs text-light-pink p-0 m-0 {{ request()->routeIs(['frontend.dashboard.index']) ? 'text-active-pink' : '' }}">Home</p>
        </a>
        @if (Auth::user()->roles->pluck('name')[0] == 'warehouse')
        <a class="text-center py-2 m-0 {{ request()->routeIs(['frontend.plastic.index', 'frontend.plastic.create']) ? 'active' : '' }}" href="{{ route('frontend.plastic.index') }}">
            <div class="text-light-pink {{ request()->routeIs(['frontend.plastic.index', 'frontend.plastic.create']) ? 'text-active-pink' : '' }}">
                <i class="fa fa-archive h-40 p-0 m-0"></i>
            </div>
            <p class="font-xs text-light-pink p-0 m-0 text-center {{ request()->routeIs(['frontend.plastic.index', 'frontend.plastic.create']) ? 'text-active-pink' : '' }}">Plastic</p>
        </a>
        <a class="text-center py-2 m-0 {{ request()->routeIs(['frontend.inner.index', 'frontend.inner.create']) ? 'active' : '' }}" href="{{ route('frontend.inner.index') }}">
            <div class="text-light-pink {{ request()->routeIs(['frontend.inner.index', 'frontend.inner.create']) ? 'text-active-pink' : '' }}">
                <i class="fa fa-cubes h-40 p-0 m-0"></i>
            </div>
            <p class="font-xs text-light-pink p-0 m-0 text-center {{ request()->routeIs(['frontend.inner.index', 'frontend.inner.create']) ? 'text-active-pink' : '' }}">Inner <br>Box</p>
        </a>
        <a class="text-center py-2 m-0 {{ request()->routeIs(['frontend.master.index', 'frontend.master.create']) ? 'active' : '' }}" href="{{ route('frontend.master.index') }}">
            <div class="text-light-pink {{ request()->routeIs(['frontend.master.index', 'frontend.master.create']) ? 'text-active-pink' : '' }}">
                <i class="fa fa-cube h-40 p-0 m-0"></i>
            </div>
            <p class="font-xs text-light-pink p-0 m-0 text-center {{ request()->routeIs(['frontend.master.index', 'frontend.master.create']) ? 'text-active-pink' : '' }}">Master <br>Carton</p>
        </a>
        @endif

        @if (Auth::user()->roles->pluck('name')[0] == 'staff')
        <a class="text-center py-2 m-0 {{ request()->routeIs(['frontend.semi-finish.index', 'frontend.semi-finish.create']) ? 'active' : '' }}" href="{{ route('frontend.semi-finish.index') }}">
            <div class="text-light-pink {{ request()->routeIs(['frontend.semi-finish.index', 'frontend.semi-finish.create']) ? 'text-active-pink' : '' }}">
                <i class="fa fa-cube h-40 p-0 m-0"></i>
            </div>
            <p class="font-xs text-light-pink p-0 m-0 text-center {{ request()->routeIs(['frontend.semi-finish.index', 'frontend.semi-finish.create']) ? 'text-active-pink' : '' }}">Barang <br>1/2 Jadi</p>
        </a>
        <a class="text-center py-2 m-0 {{ request()->routeIs(['frontend.finish.index', 'frontend.finish.create']) ? 'active' : '' }}" href="{{ route('frontend.finish.index') }}">
            <div class="text-light-pink {{ request()->routeIs(['frontend.finish.index', 'frontend.finish.create']) ? 'text-active-pink' : '' }}">
                <i class="fa fa-cubes h-40 p-0 m-0"></i>
            </div>
            <p class="font-xs text-light-pink p-0 m-0 {{ request()->routeIs(['frontend.finish.index', 'frontend.finish.create']) ? 'text-active-pink' : '' }}">Barang<br> Jadi</p>
        </a>
        @endif
        <a class="text-center py-2 m-0 {{ request()->routeIs(['frontend.profile.edit']) ? 'active' : '' }}" href="{{ route('frontend.profile.edit') }}">
            <div class="text-light-pink {{ request()->routeIs(['frontend.profile.edit']) ? 'text-active-pink' : '' }}">
                <i class="fa fa-user h-40 p-0 m-0"></i>
            </div>
            <p class="font-xs text-light-pink p-0 m-0 {{ request()->routeIs(['frontend.profile.edit']) ? 'text-active-pink' : '' }}">Akun</p>
        </a>
    </div>
</div>
