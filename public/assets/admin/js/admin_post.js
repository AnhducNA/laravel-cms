// select 2
$("#list_users_select2").select2({
    placeholder: "Choose users", minimumInputLength: 2, ajax: {
        url: window.location.origin + "/admin/user/find", dataType: 'json', data: function (params) {
            return {
                q: $.trim(params.term)
            };
        }, processResults: function (data) {
            return {
                results: data
            };
        }, cache: true
    }
});
$("#list_tags_select2").select2({
    placeholder: "Choose tags", minimumInputLength: 2, ajax: {
        url: window.location.origin + "/admin/tag/find", dataType: 'json', data: function (params) {
            return {
                q: $.trim(params.term)
            };
        }, processResults: function (data) {
            return {
                results: data
            };
        }, cache: true
    }
});

$("#list_category_select2").select2({
    placeholder: "Choose category...", minimumInputLength: 2, ajax: {
        url: window.location.origin + "/admin/category/find", dataType: 'json', data: function (params) {
            return {
                q: $.trim(params.term)
            };
        }, processResults: function (data) {
            return {
                results: data
            };
        }, cache: true
    }
});

//sort
function sort_admin_post_title(event) {
    sort(event, 'title')
}

function sort_admin_post_category(event) {
    sort(event, 'category');
}

function sort(event, sort_col) {
    let sort_col_element = document.getElementById('sort_col');
    let sort_type_element = document.getElementById('sort_type');
    console.log(event.target)
    if (event.target.classList.contains('asc_sort')) {
        event.target.classList.remove('asc_sort');
        event.target.innerHTML = '';
        event.target.innerHTML = sort_col.charAt(0).toUpperCase() + sort_col.slice(1) + '<i class="mdi mdi-triangle-small-down"></i>';

        sort_col_element.setAttribute('value', sort_col);
        sort_type_element.setAttribute('value', 'desc');
    } else {
        event.target.classList.add('asc_sort');
        event.target.innerHTML = '';
        event.target.innerHTML = sort_col.charAt(0).toUpperCase() + sort_col.slice(1) + '<i class="mdi mdi-triangle-small-up"></i>';

        sort_col_element.setAttribute('value', sort_col);
        sort_type_element.setAttribute('value', 'asc');
    }
}
//     set src for img
const figures = document.querySelectorAll("figure img");
figures.forEach(function (node) {
    const data_src = node.getAttribute('data-src');
    node.setAttribute('src', data_src);
});

// Preview an image before it is uploaded in form
const thumbnailPost_input = document.querySelector("#thumbnailPost_input");
const thumbnailPost_img = document.querySelector("#thumbnailPost_img");
thumbnailPost_input.onchange = evt => {
    const [file] = thumbnailPost_input.files
    if (file) {
        thumbnailPost_img.src = URL.createObjectURL(file)
    }
}
