        <!-- Filter PJU -->
        <div class="filter-pju d-flex justify-content-center mb-3 bg-white rounded">
            <a class="dropdown-item mr-2 {{ request()->is('pju1') ? 'active' : '' }}" href="{{ route('pju1') }}">PJU 1</a>
            <a class="dropdown-item mr-2 {{ request()->is('pju2') ? 'active' : '' }}" href="{{ route('pju2') }}">PJU 2</a>
            <a class="dropdown-item mr-2 {{ request()->is('pju3') ? 'active' : '' }}" href="{{ route('pju3') }}">PJU 3</a>
            <a class="dropdown-item mr-2 {{ request()->is('pju4') ? 'active' : '' }}" href="{{ route('pju4') }}">PJU 4</a>
            <a class="dropdown-item mr-2 {{ request()->is('pju5') ? 'active' : '' }}" href="{{ route('pju5') }}">PJU 5</a>
            <a class="dropdown-item mr-2 {{ request()->is('pju6') ? 'active' : '' }}" href="{{ route('pju6') }}">PJU 6</a>
            <a class="dropdown-item mr-2 {{ request()->is('pju7') ? 'active' : '' }}" href="{{ route('pju7') }}">PJU 7</a>
            <a class="dropdown-item mr-2 {{ request()->is('pju8') ? 'active' : '' }}" href="{{ route('pju8') }}">PJU 8</a>
            <a class="dropdown-item mr-2 {{ request()->is('pju9') ? 'active' : '' }}" href="{{ route('pju9') }}">PJU 9</a>
            <a class="dropdown-item mr-2 {{ request()->is('pju10') ? 'active' : '' }}" href="{{ route('pju10') }}">PJU 10</a>
            <a class="dropdown-item {{ request()->is('pju') ? 'active' : '' }}" href="{{ route('pju') }}">PJU All</a>
        </div>