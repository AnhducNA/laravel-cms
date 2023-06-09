<x-layout.admin-auth>
    <section class="section main-section">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon"><i class="mdi mdi-lock"></i></span>
                    Login Admin
                </p>
            </header>
            <div class="card-content">
                <form method="post" action="{{ route('admin.login') }}">
                    @csrf
                    <div class="field spaced">
                        <label class="label">Email</label>
                        <div class="control icons-left">
                            <input class="input" type="text" name="email" placeholder="example@gmail.com" autocomplete="username">
                            <span class="icon is-small left"><i class="mdi mdi-account"></i></span>
                        </div>
                        <p class="help ">
                            Please enter your email
                        </p>
                    </div>

                    <div class="field spaced">
                        <label class="label">Password</label>
                        <p class="control icons-left">
                            <input class="input" type="password" name="password" placeholder="Password" autocomplete="current-password">
                            <span class="icon is-small left"><i class="mdi mdi-lock"></i></span>
                        </p>
                        <p class="help">
                            Please enter your password
                        </p>
                    </div>

                    <div class="field spaced">
                        <div class="control">
                            <label class="checkbox"><input type="checkbox" name="remember" value="1" checked>
                                <span class="check"></span>
                                <span class="control-label">Remember</span>
                            </label>
                        </div>
                    </div>
                    @if(!empty($type_login))
                        <input type="hidden" name="type_login" value="{{$type_login}}">
                    @endif
                    <hr>

                    <div class="field grouped">
                        <div class="control">
                            <button type="submit" class="button blue">
                                Login
                            </button>
                        </div>
                        <div class="control">
                            <a href="index.html" class="button">
                                Back
                            </a>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </section>
</x-layout.admin-auth>
