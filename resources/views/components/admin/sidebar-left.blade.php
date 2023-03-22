<!-- sidebar left -->
<aside class="aside is-placed-left is-expanded">
    <div class="aside-tools">
        <a href="javascript:">
            <b class="font-black">VNP GROUP</b> Blog
        </a>
    </div>
    <div class="menu is-menu-main">
        <p class="menu-label">General</p>
        <ul class="menu-list">
            <li class="active">
                <a href="{{route('admin.dashboard')}}">
                    <span class="icon"><i class="mdi mdi-monitor"></i></span>
                    <span class="menu-item-label">Dashboard</span>
                </a>
            </li>
        </ul>
        <p class="menu-label">Management</p>
        <ul class="menu-list">

            <li class="--set-active-profile-html">
                <a class="dropdown">
                    <span class="icon"><i class="mdi mdi-account-circle"></i></span>
                    <span class="menu-item-label">User</span>
                    <span class="icon"><i class="mdi mdi-plus"></i></span>
                </a>
                <ul>
                    <li>
                        <a href="{{route('user.index')}}">
                            <span>List user</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('permission.index')}}">
                            <span>Permission</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('role.index')}}">
                            <span>Role</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="--set-active-tables-html">
                <a class="dropdown">
                    <span class="icon"><i class="mdi mdi-newspaper"></i></span>
                    <span class="menu-item-label">Article</span>
                    <span class="icon"><i class="mdi mdi-plus"></i></span>
                </a>
                <ul>
                    <li>
                        <a href="{{route('post.index')}}" >
                            <span>Post</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" >
                            <span>News</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" >
                            <span>Video</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="--set-active-tables-html">
                <a href="{{route('category.index')}}">
                    <span class="icon"><i class="mdi mdi-view-list"></i></span>
                    <span class="menu-item-label">Category</span>
                </a>
            </li>
            <li class="--set-active-tables-html">
                <a href="{{route('tag.index')}}">
                    <span class="icon"><i class="mdi mdi-tag"></i></span>
                    <span class="menu-item-label">Tag</span>
                </a>
            </li>
            <li class="--set-active-tables-html">
                <a href="{{route('log.index')}}">
                    <span class="icon"><i class="mdi mdi-math-log"></i></span>
                    <span class="menu-item-label">Log</span>
                </a>
            </li>
        </ul>
        <p class="menu-label">About</p>
        <ul class="menu-list">
            <li>
                <a class="has-icon" href="#">
                    <span class="icon"><i class="mdi mdi-github"></i></span>
                    <span class="menu-item-label">GitHub</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
