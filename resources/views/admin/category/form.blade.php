<x-layout.admin>
    <section class="is-title-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <ul>
                <li>Admin</li>
                <li><a href="{{route('category.index')}}">Category</a></li>
                <li>Form</li>
            </ul>
            <a href="{{route('category.index')}}" class="button blue">
                <span class="icon"><i class="mdi mdi-keyboard-return"></i></span>
                <span>Return</span>
            </a>
        </div>
        <section class="section main-section">
            <div class="card mb-6">
                <header class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="mdi mdi-ballot"></i></span>
                        Forms
                    </p>
                </header>
                <div class="card-content">
                    @php($action = (!empty($category)) ? route('category.update', $category['id']) : route('category.store') )
                    <form method="post" action="{{$action}}">
                        @csrf
                        <div class="field">
                            <label class="label" for="title">Name</label>
                            <div class="control icons-left">
                                <span class="icon left"><i class="mdi mdi-tag-faces"></i></span>
                                <input class="input" type="text" name="name" id="title" placeholder="Name..." autofocus
                                       value="<?php echo !empty($category) ? $category['name'] : '' ?>">
                            </div>
                            @error('name')
                            <p class="help" style="color: red"><b>{{$message}}</b></p>
                            @enderror
                        </div>
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
    </section>
</x-layout.admin>
