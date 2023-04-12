<x-layout.admin>
    <section class="is-title-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <ul>
                <li>Admin</li>
                <li>Article</li>
                <li>Post</li>
            </ul>
        </div>
    </section>

    <section class="section main-section">

        <div class="card ">
            <header class="card-header">
                <a class="card-header-icon" href="{{route('log.index')}}">
                    <span class="icon"><i class="mdi mdi-keyboard-return"></i></span>
                    Return
                </a>
            </header>
            <div class="card-content">
                <table class="table">
                    <tbody>
                    <tr>
                        <td>
                            <strong>Level:</strong>
                        </td>
                        <td>
                            <span>{{$log['level_class']}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Date:</strong>
                        </td>
                        <td>
                            <span>{{$log['date']}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Title:</strong>
                        </td>
                        <td>
                            <span>{{$log['text']}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Content:</strong>
                        </td>
                        <td>
                            <span>{{$log['stack']}}</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</x-layout.admin>
