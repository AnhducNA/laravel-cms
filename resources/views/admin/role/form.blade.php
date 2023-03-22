<x-layout.admin>
    <section class="is-title-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <ul>
                <li>Admin</li>
                <li><a href="{{route('role.index')}}">Role</a></li>
                <li>Forms</li>
            </ul>
            <a href="{{route('role.index')}}" class="button blue">
                <span>Return</span>
            </a>
        </div>
    </section>
    <section class="section main-section">
        <div class="card mb-6">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon"><i class="mdi mdi-ballot"></i></span>
                    Forms
                </p>
            </header>
            <div class="card-content">
                <?php $action = (!empty($role)) ? route('role.update', $role['id']) : route('role.store') ?>
                <form method="post" action="{{$action}}">
                    @csrf
                    <div class="field">
                        <label class="label" for="title">Title</label>
                        <div class="control icons-left">
                            <span class="icon left"><i class="mdi mdi-format-title"></i></span>
                            <input class="input" type="text" name="name" id="title" placeholder="Name" autofocus
                                   value="<?php echo ($role) ? $role['name'] : '' ?>">
                        </div>
                    </div>
                    <br>
                    <label for="permissions" class="form-label">
                        <strong>Assign Permissions</strong>
                    </label>

                    <table class="table table-striped">
                        <thead>
                        <th scope="col" width="1%">
                            <input type="checkbox" onclick="all_check(this)" name="all_permission">
                        </th>
                        <th scope="col" width="2%">ID</th>
                        <th scope="col" width="20%">Name</th>
                        </thead>
                        @foreach($list_permission as $permission)
                            <tr>
                                <td>
                                    <input type="checkbox"
                                           name="permissions[{{ $permission['id'] }}]"
                                           value="{{ $permission['name'] }}"
                                           class="element_check"
                                            <?php if (str_contains($name_permission_of_role, $permission['name'])) echo 'checked'?>
                                    >
                                </td>
                                <td>{{$permission['id']}}</td>
                                <td>{{ $permission['name'] }}</td>
                            </tr>
                        @endforeach
                    </table>
                    <hr>
                    <div class="field grouped">
                        <div class="control">
                            <button type="submit" class="button green">
                                Submit
                            </button>
                        </div>
                        <div class="control">
                            <button type="reset" class="button red">
                                Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>

</x-layout.admin>
