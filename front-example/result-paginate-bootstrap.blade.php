<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Result Paginate</title>
</head>
<body>
    {{-- Paginator --}}
    <ul class="pagination pagination-lg justify-content-center">
        <li class="page-item {{ ($api['paginator']['current_page'] == $api['paginator']['prev_page']) ? "disabled" : "" }}"><a class="page-link" href="{{ route($current_route, [ 'page' => $api['paginator']['prev_page'] ]) }}"><span aria-hidden="true">&laquo;</span></a></li>

        @foreach($api['paginator']['page_keys'] as $page_key)
        <li class="page-item {{ ($page_key == $api['paginator']['current_page']) ? "disabled" : "" }}">
            <a class="page-link" href="{{ route($current_route, [ 'page' => $page_key ]) }}">{{ $page_key }}</a>
        </li>
        @endforeach

        <li class="page-item {{ ($api['paginator']['current_page'] == $api['paginator']['last_page']) ? "disabled" : "" }}"><a class="page-link" href="{{ route($current_route, [ 'page' => $api['paginator']['next_page'] ]) }}"><span aria-hidden="true">&raquo;</span></a></li>
    </ul>
    {{-- End Paginator --}}
</body>
</html>