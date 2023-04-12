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

    <section class="section main-section">

        <div class="card ">
            <header class="card-header">
                <a class="card-header-icon" href="{{route('post.index')}}">
                    <span class="icon"><i class="mdi mdi-keyboard-return"></i></span>
                    Return
                </a>
            </header>
            <div class="card-content">
                <table class="table">
                    <tbody>
                    <tr>
                        <td>
                            <strong>Title:</strong>
                        </td>
                        <td>
                            <span>{{$post['title']}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Slug:</strong>
                        </td>
                        <td>{{$post['slug']}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Content:</strong>
                        </td>
                        <td>
                            <span>{{$post['description']}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Image:</strong>
                        </td>
                        <td>
                            <span><img src="{{$post['thumbnail']}} " alt="thumbnail" style="max-width: 200px"></span>
                            <span>{{$post['thumbnail']}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Status:</strong>
                        </td>
                        <td>
                            <span>DRAFT</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Created:</strong>
                        </td>
                        <td>
                            <span>{{$post['created_at']}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Updated:</strong>
                        </td>
                        <td>
                            <span>{{$post['updated_at']}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Actions</strong></td>
                        <td>
                            <div class="buttons nowrap">
                                <a class="button small green" href="{{route('post.show', $post['id'])}}">
                                    Clone</a>
                                <a class="button small blue" href="{{route('post.edit', $post['id'])}}">
                                    Edit
                                </a>
                                <button class="button small red --jb-modal" data-target="delete-modal"
                                        data-url="{{route('post.destroy', $post['id'])}}" type="button">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</x-layout.admin>
