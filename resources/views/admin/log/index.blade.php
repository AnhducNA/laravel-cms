<x-layout.admin>
    <section class="is-title-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <ul>
                <li>Admin</li>
                <li>Log</li>
            </ul>
            <a href="{{route('post.create')}}" class="button blue">
                <span>Add new</span>
            </a>
        </div>
    </section>

    <section class="is-hero-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <h1 class="title">
                Logs Manager
            </h1>
        </div>
    </section>

    <section class="section main-section">

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
                        <th>File name</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($data['files'])
                        @foreach($data['files'] as $file)
                            <tr>
                                <td data-label="Name">{{$file}}</td>
                                <td class="actions-cell">
                                    <div class="buttons nowrap">
                                        <a class="button small blue" href="{{route('log.preview', $file)}}">
                                            <span>Preview</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">
                                There are no file
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</x-layout.admin>
