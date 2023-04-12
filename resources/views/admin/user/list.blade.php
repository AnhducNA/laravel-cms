<x-layout.admin>

    <section class="is-title-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <ul>
                <li>Admin</li>
                <li>User</li>
            </ul>
            <a href="{{route('user.create')}}" class="button blue">
                <span>Add new</span>
            </a>
        </div>
    </section>

    <section class="is-hero-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <h1 class="title">
                Users Tables
            </h1>
            <!-- search -->
            <form action="{{route('user.index')}}" method="get" class="navbar-item">
                <label for="filter_data_search">Select: </label>
                <select name="search_option" id="filter_data_search" class="button light">
                    @foreach($list_attribute as $attribute)
                        <option value="{{$attribute}}">{{$attribute}}</option>
                    @endforeach
                </select>
                <div class="control">
                    <input class="input element_check" name="search_value" placeholder="Tìm kiếm...">
                </div>
                <button class="button light">Tìm kiếm</button>
            </form>
        </div>
    </section>
    <section class="section main-section">
        @if(session()->has('success'))
            <!-- Notification -->
            <div class="notification blue">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
                    <div>
                        <span class="icon"><i class="mdi mdi-buffer"></i></span>
                        <b>{{session()->get('success')}}</b>
                    </div>
                    <button class="button small textual --jb-notification-dismiss" type="button">Dismiss</button>
                </div>
            </div>
        @endif
        <div class="card has-table">
            @if($list_users != null)
                <header class="card-header" style="justify-content: space-between">
                    <p class="card-header-title" style="flex-grow: 0">
                        <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
                        Clients
                    </p>
                    <div class="card-header-title">
                        <a class="navbar-item" style="padding-right: 0"><span class="mdi mdi-filter"></span></a>
                        <div class="navbar-item dropdown">
                            <div class="navbar-link">
                                <span>Role</span>
                                <span class="icon"><i class="mdi mdi-account-settings"></i></span>
                            </div>
                            <div class="navbar-dropdown">
                                @if(!empty($list_role_attribute))
                                    @foreach($list_role_attribute as $name_attribute)
                                        <form action="{{route('user.index')}}" method="get" class="navbar-item">
                                            <input type="submit" name="name_role" value="{{$name_attribute}}"
                                                   style="width: 100%;">
                                        </form>
                                        <hr>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="navbar-item dropdown">
                            <div class="navbar-link">
                                <span>Email</span>
                                <span class="icon">
                                <i class="mdi mdi-email"></i>
                            </span>
                            </div>
                            <div class="navbar-dropdown">
                                @if(!empty($list_email_attribute))
                                    @foreach($list_email_attribute as $email_attribute)
                                        <form action="{{route('user.index')}}" method="get" class="navbar-item">
                                            <input type="submit" name="email" value="{{$email_attribute}}"
                                                   style="width: 100%;">
                                        </form>
                                        <hr>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <a class="card-header-icon" href="{{url()->current()}}">
                        <span class="icon"><i class="mdi mdi-reload"></i></span>
                    </a>
                </header>
                <div class="card-content">
                    <table>
                        <thead>
                        <tr>
                            <th class="checkbox-cell">
                                <label class="checkbox">
                                    <input type="checkbox">
                                    <span class="check"></span>
                                </label>
                            </th>
                            <th class="image-cell"></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list_users as $user)
                            @php($str = implode('', $user->roles->pluck('name','name')->all()))
                            @if(str_contains($str, $name_role))
                                <tr>
                                    <td class="checkbox-cell">
                                        <label class="checkbox">
                                            <input type="checkbox">
                                            <span class="check"></span>
                                        </label>
                                    </td>
                                    <td class="image-cell">
                                        <div class="image">
                                            <img class="rounded-full"
                                                 src="https://avatars.dicebear.com/v2/initials/{{$user['name']}}.svg"
                                                 alt="img">
                                        </div>
                                    </td>
                                    <td data-label="Name">{{$user['name']}}</td>
                                    <td data-label="Email">{{$user['email']}}</td>
                                    <td data-label="Role">{{implode('', $user->roles->pluck('name','name')->all())}}</td>
                                    <td data-label="Created">
                                        <small class="text-gray-500"
                                               title="Oct 25, 2021">{{$user['created_at']}}</small>
                                    </td>
                                    <td data-label="Updated At">
                                        <small class="text-gray-500"
                                               title="Oct 25, 2021">{{$user['updated_at']}}</small>
                                    </td>
                                    <td class="actions-cell">
                                        <div class="buttons right nowrap">
                                            <a class="button small blue" href="{{route('user.edit', $user['id'])}}">
                                                <span class="icon"><i class="mdi mdi-pencil"></i></span>
                                            </a>
                                            <button class="button small red --jb-modal" data-target="delete-modal"
                                                    data-url="{{route('user.destroy', $user['id'])}}" type="button">
                                                <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                            @endif
                        @endforeach
                        </tbody>
                    </table>

                    <div class="table-pagination">
                        <div class="flex items-center justify-between">
                            <div class="buttons">
                                @if(($list_users->previousPageUrl()) != null)
                                    <a class="button" href="{{$list_users->previousPageUrl()}}">Previous</a>
                                @endif
                                @for($i = 1; $i <= $list_users->lastPage() ; $i++)
                                    @if($list_users->currentPage() == $i)
                                        <a class="button active"
                                           href="{{url()->current()."?page=".$list_users->currentPage()}}">{{$i}}</a>
                                    @else
                                        <a class="button" href="{{url()->current()."?page=".$i}}">{{$i}}</a>
                                    @endif
                                @endfor
                                @if(!empty($list_users->nextPageUrl()))
                                    <a class="button" href="{{$list_users->nextPageUrl()}}">Next</a>
                                @endif
                            </div>
                            <small>Page {{$list_users->currentPage()}} of 3</small>
                        </div>
                    </div>
                </div>
            @else
                <p>Don't have data</p>
            @endif

        </div>
    </section>

</x-layout.admin>
