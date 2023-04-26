@php use Illuminate\Support\Facades\Auth; @endphp
<x-layout.client>
    <div id="content">
        <div class="container">
            <h1>Edit Profile</h1>
            <hr>
            <div class="row">
                <!-- edit form column -->
                <div class="col-md-9 personal-info">
                    <h3>Personal info</h3>

                    <form class="form-horizontal" method="post"
                          action="{{route('client.change_password', Auth::id())}}">
                        @csrf
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><strong>Old password:</strong></label>
                            <div class="col-lg-8">
                                <input class="form-control" type="password" name="old_password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>New Password:</strong></label>
                            <div class="col-md-8">
                                <input class="form-control" type="password" name="password">
                            </div>
                            @error('password')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><strong>Confirm new password:</strong></label>
                            <div class="col-md-8">
                                <input class="form-control" type="password" name="password_confirmation">
                            </div>
                            @error('password')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-8">
                                <input type="submit" class="btn btn-primary" value="Save Changes">
                                <input type="reset" class="btn btn-default" value="Cancel">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <hr>
    </div>
</x-layout.client>
