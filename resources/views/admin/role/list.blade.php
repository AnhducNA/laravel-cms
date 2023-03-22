<x-layout.admin>
    <section class="is-title-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <ul>
                <li>Admin</li>
                <li><a href="{{route('role.index')}}">Role</a></li>
            </ul>
            <a href="{{route('role.create')}}" class="button blue">
                <span>Add new</span>
            </a>
        </div>
    </section>
    <section class="is-hero-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <h1 class="title">
                Roles Tables
            </h1>
            <button class="button light">Button</button>
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
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
                    Clients
                </p>
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
                                <input type="checkbox" onclick="all_check(this)">
                                <span class="check"></span>
                            </label>
                        </th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Permissions</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($list_roles)
                        @foreach($list_roles as $role)
                            <tr>
                                <td class="checkbox-cell">
                                    <label class="checkbox">
                                        <input type="checkbox" class="element_check">
                                        <span class="check"></span>
                                    </label>
                                </td>
                                <td data-label="ID">{{$role['id']}}</td>
                                <td data-label="Name">{{$role['name']}}</td>
                                <td data-label="Permissions">
                                        <?php foreach ($role->permissions as $permission) {
                                        echo $permission['name'] . ", ";
                                    } ?>
                                </td>
                                <td data-label="Created">
                                    <small class="text-gray-500" title="Oct 25, 2021">{{$role['created_at']}}</small>
                                </td>
                                <td data-label="Updated At">
                                    <small class="text-gray-500" title="Oct 25, 2021">{{$role['updated_at']}}</small>
                                </td>
                                <td class="actions-cell">
                                    <div class="buttons right nowrap">
                                        <a class="button small blue " href="{{route('role.edit', $role['id'])}}">
                                            <span class="icon"><i class="mdi mdi-pencil"></i></span>
                                        </a>
                                        <a class="button small red " href="{{route('role.destroy', $role['id'])}}"
                                           onclick="return confirm('Are you sure to delete?')">
                                            <span class="icon"><i class="mdi mdi-delete"></i></span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">
                                There are no data
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>

                <div class="table-pagination">

                    <div class="flex items-center justify-between">

                        <div class="buttons">
                            <a class="button" href="{{$list_roles->previousPageUrl()}}">Previous</a>
                            @for($i = 1; $i <= $list_roles->lastPage() ; $i++)
                                @if($list_roles->currentPage() == $i)
                                    <a class="button active"
                                       href="{{url()->current()."?page=".$list_roles->currentPage()}}">{{$i}}</a>
                                @else
                                    <a class="button" href="{{url()->current()."?page=".$i}}">{{$i}}</a>
                                @endif
                            @endfor

                            <a class="button" href="{{$list_roles->nextPageUrl()}}">Next</a>
                        </div>
                        <small>Page {{$list_roles->currentPage()}} of 3</small>
                    </div>
                </div>
            </div>
        </div>
    </section>


</x-layout.admin>
