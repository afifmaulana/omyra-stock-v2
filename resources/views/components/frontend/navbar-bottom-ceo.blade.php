<div class="bottom-nav">
    <div class="d-flex justify-content-around">
        <a class="text-center py-2 m-0 {{ request()->routeIs(['frontend.dashboard.ceo']) ? 'active' : '' }}" href="{{ route('frontend.dashboard.ceo') }}">
            <div class="text-light-pink {{ request()->routeIs(['frontend.dashboard.ceo']) ? 'text-active-pink' : '' }}">
                <i class="fas fa-home h-40 p-0 m-0"></i>
            </div>
            <p class="font-xs text-light-pink p-0 m-0 {{ request()->routeIs(['frontend.dashboard.ceo']) ? 'text-active-pink' : '' }}">Home</p>
        </a>

        <a class="text-center py-2 m-0 {{ request()->routeIs(['frontend.profile.edit']) ? 'active' : '' }}" href="{{ route('frontend.profile.edit') }}">
            <div class="text-light-pink {{ request()->routeIs(['frontend.profile.edit']) ? 'text-active-pink' : '' }}">
                <i class="fa fa-user h-40 p-0 m-0"></i>
            </div>
            <p class="font-xs text-light-pink p-0 m-0 {{ request()->routeIs(['frontend.profile.edit']) ? 'text-active-pink' : '' }}">Akun</p>
        </a>
    </div>
</div>
