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
                <form method="post" action="{{$action}}" enctype="multipart/form-data">
                    @csrf
                    <div class="field">
                        <label class="label" for="title">Title</label>
                        <div class="control icons-left">
                            <span class="icon left"><i class="mdi mdi-format-title"></i></span>
                            <input class="input" type="text" name="title" id="title" placeholder="Title" autofocus
                                   value="<?php echo ($post) ? $post['title'] : '' ?>">
                        </div>
                        @error('title')
                        <b style="color: red">{{$message}}</b>
                        @enderror
                    </div>

                    <input class="input" type="hidden" name="slug">

                    <div class="field">
                        <label class="label" for="description">Description</label>
                        <div class="control">
                            <textarea class="textarea ckeditor" name="description" id="description"
                                      placeholder="Description">
                                @if(!empty($post))
                                        <?php echo ($post) ? $post['description'] : '' ?>
                                @endif
                            </textarea>
                        </div>
                        @error('description')
                        <b style="color: red">{{$message}}</b>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label icons-left" for="thumbnail">
                            <span class="icon left"><i class="mdi mdi-image-area"></i></span>
                            Thumbnail</label>
                        <div class="field-body">
                            <div class="field file">
                                <label class="upload control">
                                    <a class="button blue">
                                        Upload
                                    </a>
                                    <input class="input" type="file" name="thumbnail" id="thumbnail" value="">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label" for="list_category_select2">Category</label>
                        <div class="control">
                            <div class="select">
                                <select id="list_category_select2" name="category_id" class="form-control js-select2">
                                    @if(!empty($post->category))
                                        <option value="{{$post->category['id']}}"
                                                selected>{{$post->category['name']}}</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        @error('category_id')
                        <b style="color: red">{{$message}}</b>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label" for="list_tags_select2">Assign Tag
                            <button class="button">Add tag</button>
                        </label>
                        <div class="control">
                            <div class="select">
                                <select id="list_tags_select2" name="list_id_tags[]" class="form-control js-select2" multiple>
                                    @if(!empty($post->tags))
                                        @foreach($post->tags as $tag)
                                            <option
                                                value="{{ $tag['id'] }}" <?php if (str_contains($list_name_tag_of_post, $tag['name'])) echo 'selected' ?>>{{$tag['name']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label" for="status">Status</label>
                        <div class="control">
                            <div class="select">
                                <select id="status" name="status" class="form-control">
                                    @php
                                        $published_selected = "";
                                        $draft_selected = "";
                                    if(!empty($post['status']) && $post['status'] == "PUBLISHED"){
                                        $published_selected = "selected";
                                    }elseif(!empty($post['status']) && $post['status'] == "DRAFT")
                                        $draft_selected = "selected";
                                    @endphp
                                        <option value="PUBLISHED" {{$published_selected}}>PUBLISHED</option>
                                        <option value="DRAFT" {{$draft_selected}}>DRAFT</option>
                                </select>
                            </div>
                        </div>
                        @error('category_id')
                        <b style="color: red">{{$message}}</b>
                        @enderror
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
