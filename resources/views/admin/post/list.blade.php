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
                        <th class="image-cell"></th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Creator</th>
                        <th>Tag</th>
                        <th>Thumbnail</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th></th>
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
                                <td class="image-cell">
                                    <div class="image">
                                        <img class="rounded-full"
                                             src="https://avatars.dicebear.com/v2/initials/{{$post['title']}}.svg">
                                    </div>
                                </td>
                                <td data-label="Name">{{ Str::limit($post['title'], 50) }}</td>
                                <td data-label="Email">{{ Str::limit($post['description'], 150, " ...") }}</td>
                                <td data-label="Category">{{!empty($post->category['name']) ? Str::ucfirst($post->category['name']) : ''}}</td>
                                <td data-label="Role">{{!empty($post->user['name']) ? Str::ucfirst($post->user['name']) : ''}}</td>
                                <td data-label="Tag">{{!empty($post->tag['name']) ? Str::ucfirst($post->tag['name']) : ''}}</td>
                                <td data-label="Thumbnail"><img src="{{$post['thumbnail']}}" alt=""></td>
                                <td data-label="Created">
                                    <small class="text-gray-500" title="Oct 25, 2021">{{$post['created_at']}}</small>
                                </td>
                                <td data-label="Updated At">
                                    <small class="text-gray-500" title="Oct 25, 2021">{{$post['updated_at']}}</small>
                                </td>
                                <td class="actions-cell">
                                    <div class="buttons right nowrap">
                                        <a class="button small blue" href="{{route('post.edit', $post['id'])}}">
                                            <span class="icon"><i class="mdi mdi-pencil"></i></span>
                                        </a>
                                        <a class="button small red" href="{{route('post.destroy', $post['id'])}}"
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
                            <a class="button" href="{{$list_posts->previousPageUrl()}}">Previous</a>
                            @for($i = 1; $i <= $list_posts->lastPage() ; $i++)
                                @if($list_posts->currentPage() == $i)
                                    <a class="button active"
                                       href="{{url()->current()."?page=".$list_posts->currentPage()}}">{{$i}}</a>
                                @else
                                    <a class="button" href="{{url()->current()."?page=".$i}}">{{$i}}</a>
                                @endif
                            @endfor

                            <a class="button" href="{{$list_posts->nextPageUrl()}}">Next</a>
                        </div>
                        <small>Page {{$list_posts->currentPage()}} of 3</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layout.admin>
