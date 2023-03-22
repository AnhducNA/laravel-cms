<x-layout.admin>
    <section class="is-title-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <ul>
                <li>Admin</li>
                <li><a href="{{route('post.index')}}">Post</a></li>
                <li>Forms</li>
            </ul>
            <a href="{{route('post.index')}}" class="button blue">
                <span class="icon"><i class="mdi mdi-keyboard-return"></i></span>
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
                <?php $action = (!empty($post)) ? route('post.update', $post['id']) : route('post.store') ?>
                <form method="post" action="{{$action}}">
                    @csrf
                    <div class="field">
                        <label class="label" for="title">Title</label>
                        <div class="control icons-left">
                            <span class="icon left"><i class="mdi mdi-format-title"></i></span>
                            <input class="input" type="text" name="title" id="title" placeholder="Title" autofocus
                                   value="<?php echo ($post) ? $post['title'] : '' ?>">
                        </div>
                    </div>

                    <input class="input" type="hidden" name="slug">

                    <div class="field">
                        <label class="label" for="description">Description</label>
                        <div class="control">
                            <textarea class="textarea" name="description" id="description"
                                      placeholder="Description"><?php echo ($post) ? $post['description'] : '' ?></textarea>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label  icons-left" for="thumbnail">
                            <span class="icon left"><i class="mdi mdi-image-area"></i></span>
                            Thumbnail</label>
                        <div class="field-body">
                            <div class="field file">
                                <label class="upload control">
                                    <a class="button blue">
                                        Upload
                                    </a>
                                    <input class="input" type="file" name="thumbnail" id="thumbnail">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label" for="category">Category</label>
                        <div class="control">
                            <div class="select">
                                <select id="category" name="category_id">
                                    <option value="">Select Category</option>
                                    @foreach($list_categories as $category)
                                        @if(!empty($post->category) && $post->category['name'] == $category['name'])
                                            <option value="{{$category['id']}}" selected>{{$category['name']}}</option>
                                        @else
                                            <option value="{{$category['id']}}">{{$category['name']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label" for="user">Creator</label>
                        <div class="control">
                            <div class="select">
                                <select id="user" name="user_id">
                                    <option value="">Select User</option>
                                    @foreach($list_users as $user)
                                        @if(!empty($post->user) && $post->user['name'] == $user['name'])
                                            <option value="{{$user['id']}}" selected>{{$user['name']}}</option>
                                        @else
                                            <option value="{{$user['id']}}">{{$user['name']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label" for="tag">Tag</label>
                        <div class="control">
                            <div class="select">
                                <select id="tag" name="tag_id">
                                    <option value="">Select Tag</option>
                                    @foreach($list_tags as $tag)
                                        @if(!empty($post->tag) && $post->tag['name'] == $tag['name'])
                                            <option value="{{$tag['id']}}" selected>{{$tag['name']}}</option>
                                        @else
                                            <option value="{{$tag['id']}}">{{$tag['name']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
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
