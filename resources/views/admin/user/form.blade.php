<x-layout.admin>
    <section class="is-title-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <ul>
                <li>Admin</li>
                <li><a href="{{route('user.index')}}">User</a></li>
                <li><?php echo (!empty($user)) ? 'Update' : 'Add new' ?></li>
            </ul>
            <a href="{{route('user.index')}}" class="button blue">
                <span>Return</span>
            </a>
        </div>
    </section>

    <section class="section main-section">
        <div class="card mb-6">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon"><i class="mdi mdi-ballot"></i></span>
                    <?php echo (!empty($user)) ? 'Update' : 'Add new' ?>
                </p>
            </header>
            <div class="card-content">
                <?php $action = (!empty($user)) ? route('user.update', $user['id']) : route('user.store') ?>
                <form method="post" action="{{ $action }}">
                    @csrf
                    <input type="hidden" name="id" value="<?php if(!empty($user)) echo $user['id']?>">
                    <div class="field">
                        <label class="label" for="name">Name</label>
                        <div class="control icons-left">
                            <input class="input" type="text" id="name" name="name" placeholder="Name" autofocus
                                   value="<?php if(!empty($user)) echo $user['name']?>">
                            <span class="icon left"><i class="mdi mdi-account"></i></span>
                        </div>
                        @error('name')
                        <b style="color: red">{{ $message }}</b>
                        @enderror

                    </div>
                    <div class="field">
                        <label class="label" for="gmail">Email</label>
                        <div class="control icons-left icons-right">
                            <input class="input" type="email" id="gmail" name="email" placeholder="example@gmail.com"
                                   value="<?php if(!empty($user)) echo $user['email']?>">
                            <span class="icon left"><i class="mdi mdi-mail"></i></span>
                            <span class="icon right"><i class="mdi mdi-check"></i></span>
                        </div>
                        @error('email')
                        <p class="help" style="color: red"><b>{{$message}}</b></p>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label" for="password">Password</label>
                        <div class="control icons-left">
                            <input class="input" type="password" id="password" name="password" placeholder="Password">
                            <span class="icon left"><i class="mdi mdi-lock"></i></span>
                        </div>
                        @error('password')
                        <p class="help" style="color: red"><b>{{$message}}</b></p>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label" for="password_confirmation">Password Confirmation</label>
                        <div class="control icons-left">
                            <input class="input" type="password" id="password_confirmation" name="password_confirmation"
                                   placeholder="Password Confirmation">
                            <span class="icon left"><i class="mdi mdi-lock"></i></span>
                        </div>
                        @error('password')
                        <p class="help" style="color: red"><b>{{$message}}</b></p>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label" for="role">Role</label>
                        <select class="control "
                                name="role_id">
                            <option value="">Select role</option>
                                <?php if (empty($userRole)) {
                                $userRole = '';
                            } ?>
                            @foreach($list_roles as $role)
                                <option value="{{ $role['id'] }}"
                                    {{ in_array($role['name'], [$userRole])
                                        ? 'selected'
                                        : '' }}
                                >{{ $role['name'] }}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                        <p class="help" style="color: red"><b>{{$message}}</b></p>
                        @enderror
                    </div>
                    <hr>
                    <div class="field grouped">
                        <div class="control">
                            <button class="button green" type="submit">
                                Submit
                            </button>
                        </div>
                        <div class="control">
                            <button class="button red" type="reset">
                                Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

</x-layout.admin>
