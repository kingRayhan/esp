{{--
    Created by KingRayhan<https://github.com/kingRayhan>.
    Date: 3/20/2018
    Time: 7:25 AM
--}}
<nav class="navbar navbar-expand-md navbar-dark dokan-navbar bg-dark mb-3">
    <div class="container-fluid">
        <button  class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header_nav" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="header_nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                        <span class="badge badge-primary">{{Auth::user()->role}}</span>
                        &nbsp;&nbsp; {{ Auth::user()->name }}

                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a href="{{ route('settings.show') }}" class="dropdown-item">Settings</a>
                        <form action="{{ route('logout')  }}" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End of Sticky Navigation -->