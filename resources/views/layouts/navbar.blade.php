@if(Auth::user() && Auth::user()->type == 'admin')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('new') }}">New Booking</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('show_all') }}">All bookings</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('show_bookings', ['id' => Auth::user()->id]) }}">My bookings</a>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Tours
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="nav-link" href="{{ route('tours') }}">Show tours</a>
            <a class="nav-link" href="{{ route('set_tours') }}">Set Tours</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Bookers
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach($bookers as $booker)
                <a class="dropdown-item" href="{{ route('show_bookings', ['id' => $booker->id]) }}">{{ $booker->name }}</a>
            @endforeach
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('booker_details') }}">Details</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Guides
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach($guides as $guide)
                <a class="dropdown-item" href="{{ route('guide', ['id' => $guide->id]) }}">{{ $guide->name }}</a>
            @endforeach
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('new_guide') }}">Add Guide</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Food items
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach($items as $item)
                <a class="dropdown-item">{{ $item->name }}</a>
            @endforeach
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('new_item') }}">Add Item</a>
        </div>
    </li>

@elseif(Auth::user() && Auth::user()->type == 'booker')

    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('show_bookings', ['id' => Auth::user()->id]) }}">Bookings</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('new') }}">New Booking</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Show by months
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach($months as $month)
                <a class="dropdown-item" href="{{ route('month', ['month' => $month->month]) }}">{{ date("F", mktime(0, 0, 0, $month->month, 1)) }}</a>
            @endforeach
        </div>
    </li>
    @endif