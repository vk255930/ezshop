// 換頁
function changeForm(url){
    location.replace(url);
}
// 查詢
function search(page){
    var url     = '/'+page;
    var search  = [];
    $('.search').each(function(){
        var name    = $(this).attr('name');
        var value   = $(this).val();
        if(value.trim().length>0){
            search.push(name + '=' + value);
        }
    });
    if(search.length>0){
        url+= '?'+search.join('&');
    }
    changeForm(url);
}
// 檢查輸入欄位
function checkInput(check_field){
    $('#error_msg_block').hide().empty();
    var msg = [];
    $.each(check_field, function(key, field){
        var value = $('#'+field).val();
        if(value.trim().length == 0){
            msg.push($('#'+field+'_title').text());
        }
    });
    if(msg.length>0){
        $('#error_msg_block').empty().append('請輸入'+msg.join('、')).show();
        return false;
    }
    return true;
}
// 儲存
function sendForm(action, form){
    $.ajax({
        async: false,
        url: '/'+action,
        type: 'post',
        data: $('#'+form).serialize(),
        dataType: 'json',
        success: function (response) {
            if (response['error']) {
                $('#error_msg_block').show().append('<p>' + response['msg'] + '</p>');
            } else {
                console.log(response);
                if(typeof(response['url']) != "undefined" && response['url'] !== null){
                    changeForm(response['url']);
                }else{
                    // history.go(0);
                }
            }
        },
        error: function (response) {
            $('#error_msg_block').show().append('<p>發生未知的錯誤<p>').show();
        }
    });
}