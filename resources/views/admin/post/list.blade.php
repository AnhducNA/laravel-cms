@php use Illuminate\Support\Str; @endphp
<x-layout.admin>
    <section class="is-title-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <ul>
                <li>Admin</li>
                <li>Article</li>
                <li>Post</li>
            </ul>
            <a href="{{route('post.create')}}" class="button blue">
                <span>Add new</span>
            </a>
        </div>
    </section>

    <section class="is-hero-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <h1 class="title">
                Post Tables
            </h1>
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
            <header class="card-header" style="justify-content: space-between">
                <form action="{{route('post.index')}}" method="GET">
                    <div class="card-header-title">
                        <a class="navbar-item" style="padding-right: 0"><span class="mdi mdi-filter"></span></a>

                        <div class="navbar-item form-group mb-3 select">
                            <select class="select2-multiple form-control" name="tags_id" id="list_tags_select2">
                                <option value="">Select tag</option>
                            </select>
                        </div>
                        <div class="navbar-item form-group mb-3 select">
                            <select class="select2-multiple form-control" name="category_id" id="list_category_select2">
                                <option value="">Select category</option>
                            </select>
                        </div>
                        <div class="navbar-item form-group mb-3 select">
                            <select class="select2-multiple form-control" name="users_id" id="list_users_select2">
                                <option value="">Select user</option>
                            </select>
                        </div>
                        <div class="navbar-item form-group mb-3 select">
                            <select class="select2-multiple form-control" name="status" id="status">
                                <option value="">Select status</option>
                                <option value="PUBLISHED">PUBLISHED</option>
                                <option value="DRAFT">DRAFT</option>
                            </select>
                        </div>
                        <input type="hidden" name="sort_col" id="sort_col">
                        <input type="hidden" name="sort_type" id="sort_type" value="asc">
                        <button class="button small green">
                            <span><b>Filter</b></span>
                        </button>
                    </div>
                </form>
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
                        <th><a href="javascript: " onclick="sort_admin_post_title(event)" style="display: flex">Title</a></th>
                        <th>Status</th>
                        <th><a href="javascript: " onclick="sort_admin_post_category(event)" style="display: flex">Category</a></th>
                        <th>Creator</th>
                        <th>Tag</th>
                        <th>Thumbnail</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($list_posts)
                        @foreach($list_posts as $post)
                            <tr>
                                <td class="checkbox-cell">
                                    <label class="checkbox">
                                        <input type="checkbox" class="element_check">
                                        <span class="check"></span>
                                    </label>
                                </td>
                                <td data-label="Name">{{ Str::limit($post['title'], 50) }}</td>
                                <td data-label="Email">{{$post['status']}}</td>
                                <td data-label="Category">{{!empty($post->category['name']) ? Str::ucfirst($post->category['name']) : ''}}</td>
                                <td data-label="Role">{{!empty($post->user['name']) ? Str::ucfirst($post->user['name']) : ''}}</td>
                                <td data-label="Tag">{{!empty($post['list_name_tag']) ? Str::ucfirst($post['list_name_tag']) : ''}}</td>
                                <td data-label="Thumbnail"><img src="{{$post['thumbnail']}}" alt=""></td>
                                <td data-label="Created">
                                    <small class="text-gray-500" title="Oct 25, 2021">{{$post['created_at']}}</small>
                                </td>
                                <td data-label="Updated At">
                                    <small class="text-gray-500" title="Oct 25, 2021">{{$post['updated_at']}}</small>
                                </td>
                                <td class="actions-cell">
                                    <div class="buttons right nowrap">
                                        <a class="button small green" href="{{route('post.show', $post['id'])}}">
                                            <span class="icon"><i class="mdi mdi-eye-plus mdi-24px"></i></span>
                                        </a>
                                        <a class="button small blue" href="{{route('post.edit', $post['id'])}}">
                                            <span class="icon"><i class="mdi mdi-pencil mdi-24px"></i></span>
                                        </a>
                                        <button class="button small red --jb-modal" data-target="delete-modal"
                                                data-url="{{route('post.destroy', $post['id'])}}" type="button">
                                            <span class="icon"><i class="mdi mdi-trash-can mdi-24px"></i></span>
                                        </button>
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
                            <a class="button" href="{{$list_posts->previousPageUrl()}}">Previous</a>
                            @if($list_posts->lastPage()>3)
                                @for($i = $list_posts->lastPage()-3; $i <= $list_posts->lastPage() ; $i++)
                                    @if($list_posts->currentPage() == $i)
                                        <a class="button active"
                                           href="{{url()->current()."?page=".$list_posts->currentPage()}}">{{$i}}</a>
                                    @else
                                        <a class="button" href="{{url()->current()."?page=".$i}}">{{$i}}</a>
                                    @endif
                                @endfor
                            @endif
                            <a class="button" href="{{$list_posts->nextPageUrl()}}">Next</a>
                        </div>
                        <small>Page <strong>{{$list_posts->currentPage()}}</strong>
                            of {{ceil($list_posts->total()/$list_posts->perPage())}}</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layout.admin>
