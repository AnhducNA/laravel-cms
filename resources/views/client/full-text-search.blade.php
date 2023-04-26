<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Full Text Search in Laravel using Ajax Example - tutsmake.com</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <br/>
    <h3 align="center">Full Text Search </h3>
    <div class="row">
{{--        <form action="{{url('/search/store')}}" method="post">--}}
            @csrf
            <div class="col-md-6">
                <input type="text" name="full_text_search" id="full_text_search" class="form-control"
                       placeholder="Search">
            </div>
            <div class="col-md-2">
                <button type="button" name="search" id="search" class="btn btn-success">Search</button>
            </div>
{{--        </form>--}}

    </div>
    <br/>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Title</th>
                <th>Excerpt</th>
                <th>Description</th>
                <th>Thumbnail</th>
                <th>Created at</th>
                <th>Updated at</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
</body>
</html>
<script>
    $(document).ready(function () {
        load_data('');

        function load_data(full_text_search_query = '') {
            var _token = $("input[name=_token]").val();
            $.ajax({
                url: "{{ url('/search/store') }}",
                method: "POST",
                data: {full_text_search_query: full_text_search_query, _token: _token},
                dataType: "json",
                success: function (data) {
                    var output = '';
                    if (data.length > 0) {
                        for (var count = 0; count < data.length; count++) {
                            output += '<tr>';
                            output += `<td> ${data[count].title} </td>`;
                            output += `<td> ${data[count].excerpt} </td>`;
                            output += `<td> ${data[count].description} </td>`;
                            output += "<td> <img src=" + data[count].thumbnail +"></td>";
                            output += '<td>' + data[count].created_at + '</td>';
                            output += '<td>' + data[count].updated_at +  '</td>';
                            output += '</tr>';
                        }
                    } else {
                        output += '<tr>';
                        output += '<td colspan="6">No Data Found</td>';
                        output += '</tr>';
                    }
                    $('tbody').html(output);
                }
            });
        }
        $('#search').click(function () {
            var full_text_search_query = $('#full_text_search').val();
            load_data(full_text_search_query);
        });
    });

    //     set src for img
    const figures = document.querySelectorAll("figure img");
    console.log(figures)
    figures.forEach(function (node) {
        console.log(node.querySelector('img'))
        const data_src = node.getAttribute('data-src');
        node.querySelector('img').setAttribute('src', data_src);
    });
</script>
