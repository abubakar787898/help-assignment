<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <!-- <div class="image">
            <img src="{{ Storage::disk('public')->url('profile/'.Auth::user()->image) }}" width="48" height="48" alt="User" />
        </div> -->
        <div class="name btn btn-danger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white; opacity: 75%;">{{ Auth::user()->name }}</div>
        <div class="info-container">
            
            <!-- <div class="email">{{ Auth::user()->email }}</div> -->
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">

                    <li>
                        {{-- <a href="{{ Auth::user()->role->id == 1 ? route('admin.settings') : route('author.settings')}}"><i class="material-icons">settings</i>Settings</a> --}}
                        <a href="{{ Auth::user() }}"><i class="material-icons">settings</i>Settings</a>
                    </li>

                    <li role="seperator" class="divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i>Sign Out
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>

            @if(Request::is('admin*'))
                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
              
                <li >
                    <a href="{{ route('admin.orders.index') }}">
                        <i class="material-icons">apps</i>
                        <span>New Orders</span>
                    </a>
                </li>
                <li >
                    <a href="{{ route('admin.posts.index') }}">
                        <i class="material-icons">chat</i>
                        <span>Post</span>
                    </a>
                </li>
                <li >
                    <a href="{{ route('admin.dead_lines.index') }}">
                        <i class="material-icons">date_range</i>
                        <span>DeadLine</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.educations.index') }}">
                        <i class="material-icons">library_books</i>
                        <span>Education Level</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.no_words.index') }}">
                        <i class="material-icons">format_list_numbered</i>
                        <span>No Words</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.paper_types.index') }}">
                        <i class="material-icons">photo_album</i>
                        <span>Paper Type</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.reference_styles.index') }}">
                        <i class="material-icons">edit</i>
                        <span>Reference Style</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.subjects.index') }}">
                        <i class="material-icons">subject</i>
                        <span>Subject</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.contacts.index') }}">
                        <i class="material-icons">photo_album</i>
                        <span>Contact </span>
                    </a>
                </li>
                {{-- <li class="{{ Request::is('admin/pending/post') ? 'active' : '' }}">
                    <a href="{{ route('admin.post.pending') }}">
                        <i class="material-icons">library_books</i>
                        <span>Pending Posts</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/favorite') ? 'active' : '' }}">
                    <a href="{{ route('admin.favorite.index') }}">
                        <i class="material-icons">favorite</i>
                        <span>Favorite Posts</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/comments') ? 'active' : '' }}">
                    <a href="{{ route('admin.comment.index') }}">
                        <i class="material-icons">comment</i>
                        <span>Comments</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/authors') ? 'active' : '' }}">
                    <a href="{{ route('admin.author.index') }}">
                        <i class="material-icons">account_circle</i>
                        <span>Authors</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/subscriber') ? 'active' : '' }}">
                    <a href="{{ route('admin.subscriber.index') }}">
                        <i class="material-icons">subscriptions</i>
                        <span>Subscribers</span>
                    </a>
                </li>
                <li class="header">System</li>

                <li class="{{ Request::is('admin/settings') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings') }}">
                        <i class="material-icons">settings</i>
                        <span>Settings</span>
                    </a>
                </li> --}}
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i>
                        <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endif
            @if(Request::is('author*'))
                <li class="{{ Request::is('author/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('author.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('author/post*') ? 'active' : '' }}">
                    <a href="{{ route('author.post.index') }}">
                        <i class="material-icons">library_books</i>
                        <span>Posts</span>
                    </a>
                </li>
                <li class="{{ Request::is('author/favorite') ? 'active' : '' }}">
                    <a href="{{ route('author.favorite.index') }}">
                        <i class="material-icons">favorite</i>
                        <span>Favorite Posts</span>
                    </a>
                </li>

                <li class="{{ Request::is('author/comments') ? 'active' : '' }}">
                    <a href="{{ route('author.comment.index') }}">
                        <i class="material-icons">comment</i>
                        <span>Comments</span>
                    </a>
                </li>

                <li class="header">System</li>
                <li class="{{ Request::is('author/settings') ? 'active' : '' }}">
                    <a href="{{ route('author.settings') }}">
                        <i class="material-icons">settings</i>
                        <span>Settings</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i>
                        <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endif

        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy;  - {{ date("Y") }} All rights reserved. <br>
            <strong> Developed &amp; <i class="far fa-heart"></i> by </strong> Assignment
                        {{-- <a href="https://www.youtube.com/channel/UCwbVAlvrsD2Tpx93bleNbOA" target="_blank">Programming kit</a>. --}}
        </div>
        {{-- <div class="version">
            <b>Version: </b> 1.0.5
        </div> --}}
    </div>
    <!-- #Footer -->
</aside>