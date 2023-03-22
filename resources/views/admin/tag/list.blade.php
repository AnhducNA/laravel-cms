<x-layout.admin>
    <section class="is-title-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <ul>
                <li>Admin</li>
                <li>Tag</li>
            </ul>
            <a href="{{route('tag.create')}}" class="button blue">
                <span>Add new</span>
            </a>
        </div>
    </section>

    <section class="is-hero-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <h1 class="title">
                Category Tables
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
                        <th>Creator</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($list_tags)
                        @foreach($list_tags as $tag)
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
                                             src="https://avatars.dicebear.com/v2/initials/{{$tag['name']}}.svg">
                                    </div>
                                </td>
                                <td data-label="Name">{{$tag['name']}}</td>
                                <td data-label="Role">{{$tag->user['name']}}</td>
                                <td data-label="Created">
                                    <small class="text-gray-500" title="Oct 25, 2021">{{$tag['created_at']}}</small>
                                </td>
                                <td data-label="Updated At">
                                    <small class="text-gray-500" title="Oct 25, 2021">{{$tag['updated_at']}}</small>
                                </td>
                                <td class="actions-cell">
                                    <div class="buttons right nowrap">
                                        <a class="button small blue" href="{{route('tag.edit', $tag['id'])}}">
                                            <span class="icon"><i class="mdi mdi-pencil"></i></span>
                                        </a>
                                        <a class="button small red" href="{{route('tag.destroy', $tag['id'])}}"
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
                            <a class="button" href="{{$list_tags->previousPageUrl()}}">Previous</a>
                            @for($i = 1; $i <= $list_tags->lastPage() ; $i++)
                                @if($list_tags->currentPage() == $i)
                                    <a class="button active" href="{{url()->current()."?page=".$list_tags->currentPage()}}">{{$i}}</a>
                                @else
                                    <a class="button" href="{{url()->current()."?page=".$i}}">{{$i}}</a>
                                @endif
                            @endfor

                            <a class="button" href="{{$list_tags->nextPageUrl()}}">Next</a>
                        </div>
                        <small>Page {{$list_tags->currentPage()}} of 3</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layout.admin>
