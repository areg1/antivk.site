<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/index.css">
    <title>ВКонтакте</title>
</head>
<body>
    <span id="load">
        <div id="black"></div>
        <img id="gif" src="images/load.gif">
    </span>    

    <div value="<?=$_SERVER['REQUEST_URI']?>" id="container">
        <input class="text" type="text" placeholder="https://vk.com/id000000000">
        <a class="hide text page" target="_blank">Увидеть страницу</a>
        <a class="hide text page" target="_blank">Увидеть диалоги</a>
        <a class="hide text error" target="_blank" style="color: red">Страница не найдена</a>
        <input id="send" type="submit" value="Далее">
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">

        $('#send').click(function() {
    
            $('#load').css('display','block');
            setTimeout( function() {
                $('#load').css('display','none');
            }, 2000);

            if( !$('.page').hasClass('hide')) {
                $('.page').addClass('hide');
            }
            if( !$('.error').hasClass('hide')) {
                $('.error').addClass('hide');
            }

            let url = $('.text').eq(0).val();
            let url2 = $('#container').attr('value');  
            console.log('url2='+url2+' '+'url='+url);
            url = JSON.stringify(url);
            url2 = JSON.stringify(url2);
            $.ajax({
                url: "vk/check.php",    
                type: "get",
                dataType: "json",
                data: {url:url,url2:url2},
                error: function (jqXHR, exception) {
                    // alert(jqXHR[0]);
                },
                }).done(function( link ) {
                    // alert(link);
                    if($.isNumeric(link[2])) {

                        $('.text').eq(1).removeClass('hide');    
                        $('.text').eq(2).removeClass('hide');

                        $('.text').eq(1).attr('href', link[0]);    
                        $('.text').eq(2).attr('href', link[1]);
                    } 
                    else {
                        $('.error').removeClass('hide');
                    }    
                });    
            });

    </script>

</body>
</html>
