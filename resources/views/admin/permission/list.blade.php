<x-layout.admin>
    <section class="is-title-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <ul>
                <li>Admin</li>
                <li>Permission</li>
            </ul>
            <a href="{{route('permission.create')}}" class="button blue">
                <span>Add new</span>
            </a>
        </div>
    </section>

    <section class="is-hero-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <h1 class="title">
                Category Tables
            </h1>
            <!-- search -->
            <form action="{{route('user.index')}}" method="get" class="navbar-item">
                <label for="filter_data_search">Select: </label>
                <select name="search_option" id="filter_data_search" class="button light">
                    <option value="">Select option</option>
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
                        <th>Roles</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($list_permissions)
                        @foreach($list_permissions as $permission)
                            <tr>
                                <td class="checkbox-cell">
                                    <label class="checkbox">
                                        <input type="checkbox" class="element_check">
                                        <span class="check"></span>
                                    </label>
                                </td>
                                <td data-label="ID">{{$permission['id']}}</td>
                                <td data-label="Name">{{$permission['name']}}</td>
                                <td data-label="Roles">
                                        <?php foreach ($permission->roles as $role) {
                                        echo $role['name'] . ", ";
                                    } ?>
                                </td>
                                <td data-label="Created At">
                                    <small class="text-gray-500"
                                           title="Oct 25, 2021">{{$permission['created_at']}}</small>
                                </td>
                                <td data-label="Updated At">
                                    <small class="text-gray-500"
                                           title="Oct 25, 2021">{{$permission['updated_at']}}</small>
                                </td>
                                <td class="actions-cell">
                                    <div class="buttons right nowrap">
                                        <a class="button small blue"
                                           href="{{route('permission.edit', $permission['id'])}}">
                                            <span class="icon"><i class="mdi mdi-pencil"></i></span>
                                        </a>
                                        <a class="button small red"
                                           href="{{route('permission.destroy', $permission['id'])}}"
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
                            <a class="button" href="{{$list_permissions->previousPageUrl()}}">Previous</a>
                            @for($i = 1; $i <= $list_permissions->lastPage() ; $i++)
                                @if($list_permissions->currentPage() == $i)
                                    <a class="button active"
                                       href="{{url()->current()."?page=".$list_permissions->currentPage()}}">{{$i}}</a>
                                @else
                                    <a class="button" href="{{url()->current()."?page=".$i}}">{{$i}}</a>
                                @endif
                            @endfor

                            <a class="button" href="{{$list_permissions->nextPageUrl()}}">Next</a>
                        </div>
                        <small>Page {{$list_permissions->currentPage()}} of 3</small>
                    </div>
                </div>
            </div>
        </div>
    </section>


</x-layout.admin>
