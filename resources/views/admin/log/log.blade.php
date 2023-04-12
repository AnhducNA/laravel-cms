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
                <a class="card-header-icon" href="#">
                    <span class="icon"><i class="mdi mdi-reload"></i></span>
                </a>
            </header>
            <div class="card-content">
                <table id="table-log">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Level</th>
                        <th>Created</th>
                        <th>Content</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($num = 1)
                    @foreach($data['logs'] as $key => $log)
                        <tr>
                            <td>{{$num++}}</td>
                            <td data-label="Level">
                                @if($log['level_class'] == 'danger')
                                    <b style="color: red">{{$log['level_class']}}</b>
                                @elseif($log['level_class'] == 'info')
                                    <b style="color: cadetblue">{{$log['level_class']}}</b>
                                @else
                                    <b style="color: yellow">{{$log['level_class']}}</b>
                                @endif
                            </td>
                            <td data-label="Created">
                                <small class="text-gray-500" title="Oct 25, 2021">{{$log['date']}}</small>
                            </td>
                            <td data-label="Content">{{$log['text']}}</td>
                            <td class="actions-cell">
                                <div class="buttons right nowrap">
                                    <a class="button small blue" href="{{route('log.show', $key)}}">
                                        <span class="icon"><i class="mdi mdi-eye"></i></span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="table-pagination">
                    <div class="flex items-center justify-between">
                        <div class="buttons">
                            @if($data['logs']->currentPage() > 1)
                                <a class="button" href="{{url()->current()."?page=".($data['logs']->currentPage()-1)}}">Previous</a>
                            @endif
                            @for($i=-2; $i<=2; $i++)
                                @if($data['logs']->currentPage()>=2)
                                        <a class="button" href="{{url()->current()."?page=".($data['logs']->currentPage()+$i)}}">{{$data['logs']->currentPage()+$i}}</a>
                                @endif
                            @endfor
                            @if($data['logs']->currentPage() < $data['logs']->lastPage())
                                <a class="button" href="{{url()->current()."?page=".($data['logs']->currentPage()+1)}}">Next</a>
                            @endif
                        </div>
                        <small>Page {{$data['logs']->currentPage()}} of {{ceil($data['logs']->total() / $data['logs']->perPage())}}</small>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout.admin>
