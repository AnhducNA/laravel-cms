<x-layout.client>
    <div class="detail-page" id="content">
        <div class="container">
            <div class="box">
                <div class="d-flex justify-content-between align-items-center" style="margin-bottom: 20px">
                    <a href="{{ url()->previous() }}">
                    <span class="icon-return d-inline">
                        <i class="fa-solid fa-angle-left"></i>
                    </span>
                        <p class="p-return d-inline">Quay lại</p>
                    </a>
                    <div>
                        <a class="btn btn-darkgreen" href="javascript: ">{{$post->category->name}}</a>
                    </div>
                </div>
                <div class="box-content">
                    <p class="p-headding">{{$post->title}} </p>
                    <div class="d-flex justify-content-between flex-column flex-md-row text-center">
                        <ul>
                            <li><a href="{{route('client.category', $post->category->slug)}}">
                                    <p>{{$post->category->name}}</p></a></li>
                            @if($post->user_id)
                                <li><span class="dot"><svg fill="none" height="4" viewBox="0 0 3 4" width="3"
                                                           xmlns="http://www.w3.org/2000/svg">
                                <circle cx="1.5" cy="1.56641" fill="#3B4144" r="1.5"/></svg></span></li>
                                <li><p>Quang Anh Trần</p></li>
                            @endif
                            @if($post->created_at)
                                <li><span class="dot"><svg fill="none" height="4" viewBox="0 0 3 4" width="3"
                                                           xmlns="http://www.w3.org/2000/svg">
                                <circle cx="1.5" cy="1.56641" fill="#3B4144" r="1.5"/></svg></span></li>
                                <li><p>24/02/2020</p></li>
                            @endif
                            @if($post->pageview)
                                <li style="color: black"><span class="dot"><svg fill="none" height="4" viewBox="0 0 3 4"
                                                                                width="3"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="1.5" cy="1.56641" fill="#3B4144" r="1.5"/></svg></span></li>
                                <li><p><strong>{{$post->pageview}}</strong> lượt xem</p></li>
                            @endif
                        </ul>
                        <div class="box-btn d-flex justify-content-around">
                            <a class="btn btn-send-mail btn-grey" href="javascript:">
                                <p class="d-flex justify-content-around align-items-center"><i
                                        class="fa-solid fa-envelope"></i>
                                    <span class="d-none d-lg-block">Gửi mail</span></p>
                            </a>
                            <a class="btn btn-facebook" href="javascript:">
                                <p class="d-flex justify-content-around align-items-center"><i
                                        class="fab fa-facebook"></i>
                                    <span class="d-none d-lg-block">Chia sẻ</span></p>

                            </a>
                            <a class="btn-heart btn btn-outline-dark" href="javascript:">
                                <p class="d-flex justify-content-around align-items-center"><i
                                        class="fa-solid fa-heart"></i>
                                    <span class="d-none d-lg-block">Lưu</span></p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <p style="margin-bottom: 36px">
                    <a href="#"><img alt="main-news.png" src="{{$post->thumbnail}}"></a>
                </p>
                <p class="p-content1">
                    {!! $post->description !!}
                </p>
                <div class="tag">
                    @foreach($post->tags as  $tag)
                        <a class="btn btn-key_word" href="">#{{$tag->name}}</a>
                    @endforeach
                </div>
            </div>

            <div class="list-news">
                <div class=" list-news-title d-flex justify-content-between align-items-center">
                    <div>
                        <p class="p-headding3 align-items-center d-inline">Tin cùng chuyên mục</p>
                        <span class="btn-darkgreen d-inline">{{$post->category->name}}</span>
                    </div>
                    <div class="box-view-all">
                        <p class="p-view-all d-none">Xem tất cả</p>
                        <p class="icon-angle-right"><i class="fa-solid fa-angle-right"></i></p>
                    </div>
                </div>
                <nav class="list-news-content box d-flex flex-column">
                    @foreach($list_post_similar as $post_similar)
                        <div class="item-news-item flex-column">
                            <div class="box-content d-block d-md-none " style="margin-bottom: 8px">
                                <p class="p-title">{{$post_similar->name}}</p>
                                <ul>
                                    <li><a href="#"><p>Xã hội</p></a></li>
                                    <li><span class="dot"><svg fill="none" height="4" viewBox="0 0 3 4" width="3"
                                                               xmlns="http://www.w3.org/2000/svg">
                                <circle cx="1.5" cy="1.56641" fill="#3B4144" r="1.5"/></svg></span></li>
                                    <li><p>Quang Anh Trần</p></li>
                                    <li><span class="dot"><svg fill="none" height="4" viewBox="0 0 3 4" width="3"
                                                               xmlns="http://www.w3.org/2000/svg">
                                <circle cx="1.5" cy="1.56641" fill="#3B4144" r="1.5"/></svg></span></li>
                                    <li><p>24/02/2020</p></li>
                                </ul>
                            </div>

                            <div class="d-flex justify-content-between">
                                <div class="box-content">
                                    <a class="w-100 h-100" href="{{route('client.post', $post_similar->slug)}}">
                                        <img alt="main-news.png" class="img-main-news round"
                                             src="{{asset($post_similar->thumbnail)}}">
                                    </a>
                                </div>
                                <div class="box-content box-content2 col-12">
                                    <div class="d-none d-md-block">
                                        <a href="{{route('client.post', $post_similar->slug)}}"><p
                                                class="p-title">{{$post_similar->title}}</p></a>
                                        <ul>
                                            <li><a href="{{route('client.category', $post_similar->category->slug)}}">
                                                    <p>{{$post_similar->category->name}}</p></a></li>
                                            <li><span class="dot"><svg fill="none" height="4" viewBox="0 0 3 4"
                                                                       width="3"
                                                                       xmlns="http://www.w3.org/2000/svg">
                                <circle cx="1.5" cy="1.56641" fill="#3B4144" r="1.5"/></svg></span></li>
                                            <li><p>Quang Anh Trần</p></li>
                                            <li><span class="dot"><svg fill="none" height="4" viewBox="0 0 3 4"
                                                                       width="3"
                                                                       xmlns="http://www.w3.org/2000/svg">
                                <circle cx="1.5" cy="1.56641" fill="#3B4144" r="1.5"/></svg></span></li>
                                            <li><p>24/02/2020</p></li>
                                        </ul>
                                    </div>
                                    <p class="p-content">{{$post_similar->excerpt}}</p>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </nav>
            </div>

        </div>
    </div>
    <footer id="footer">

    </footer>
    <script type="text/javascript">
        const show_menu_md = document.getElementById('show_menu_md');
        document.getElementById('menu_md').addEventListener("click", function () {
            // console.log(show_menu_md.style.display);
            if (show_menu_md.style.display === '' || show_menu_md.style.display === 'none') {
                show_menu_md.style.cssText = `
            display: block;
       `
                document.getElementById('menu_md').style.display = 'none';
                document.getElementById('btn_close_menu_md').style.display = 'block';
            }
        });
        document.getElementById('btn_close_menu_md').addEventListener("click", function () {
            if (show_menu_md.style.display === 'block') {
                show_menu_md.style.cssText = `
           display: none;
       `
                document.getElementById('menu_md').style.display = 'block';
                document.getElementById('btn_close_menu_md').style.display = 'none';
            }
        });

        //     set src for img
        const figures = document.querySelectorAll("figure img");
        figures.forEach(function (node) {
            const data_src = node.getAttribute('data-src');
            node.setAttribute('src', data_src);
        });
        //  set style for tag video
        const videos = document.querySelectorAll("video");
        videos.forEach(function (node) {
            node.style = "width: 100%";
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js"></script>
</x-layout.client>
