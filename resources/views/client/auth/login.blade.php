<x-layout.client>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
            src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v16.0&appId=520918020118619&autoLogAppEvents=1"
            nonce="0C4MSIn5"></script>
    <div id="content">
        <div class="container">
            <h1>Login</h1>
            <hr>
            <div class="row">
                <!-- edit form column -->
                <div class="col-md-9 personal-info">
                    <div class="d-flex mb-5">
                        <div class="control px-3">
                            <a href="{{ route('facebook.login') }}" class="btn btn-primary">
                                <span>Login with Facebook</span>
                            </a>
                        </div>
                        <div class="control px-3">
                            <a href="{{ url('auth/google') }}" class="btn btn-primary">
                                <span>Login with Google</span>
                            </a>
                        </div>
                    </div>
                    <form class="form-horizontal" method="post"
                          action="{{route('client.store') }}">
                        @csrf
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><strong>Email:</strong></label>
                            <div class="col-lg-8">
                                <input class="form-control" type="text" name="email">
                            </div>
                            @error('email')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Password:</strong></label>
                            <div class="col-md-8">
                                <input class="form-control" type="password" name="password">
                            </div>
                            @error('password')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <input type="hidden" name="type_login" value="client">
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-8">
                                <input type="submit" class="btn btn-primary" value="Login">
                                <input type="reset" class="btn btn-default" value="Cancel">
                            </div>
                        </div>
                        <hr>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout.client>
