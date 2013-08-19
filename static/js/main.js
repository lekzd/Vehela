
    function VehelaAjaxTesting(){

        $("#submit").click(function()
        {

            $("#msgbox").removeClass().addClass('messagebox').text('Получение данных...').fadeIn("slow");

            $.get("index.php?module=static&controller=welcome&action=AjaxGettingData",
                function(data)
                {

                    if(data=="Data loaded from Ajax")
                    {
                        $("#msgbox").fadeTo(1,0.01,function()
                        {
                            $(this).html('<div style="color:#00ff00;">Данные успешно получены: ' + data+'</div>').addClass('messageboxerror').fadeTo(900,1);
                        });

                    }

                    else
                    {
                        $("#msgbox").fadeTo(1,0.01,function()
                        {
                            $(this).html('<div style="color:#ff0000;">Неверный логин или пароль</div>').addClass('messageboxok').fadeTo(900,1);
                        });
                    }

                });


        });

    }
