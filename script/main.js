$(document).ready(function()
{
    $(document).ready(function() //выводит настройки поиска
    {
        var check = true;
        var xhr = new XMLHttpRequest();
        xhr.open('GET','header/header.php?check='+check,true);
        xhr.setRequestHeader('Content-type', 'application/json');    
        xhr.send();
        xhr.onreadystatechange = function()
        {
            if(xhr.readyState !=4 )
                return;
            var response  = JSON.parse(xhr.responseText);
            if(xhr.status == 200)
            $('#headerMain').append(response);
        }
        return false;
    }); 

    $(document).ready(function() //выводит все книги из библиотеки
    {
        var check = true;
        var xhr = new XMLHttpRequest();
        xhr.open('GET','main/main.php?check='+check,true);
        xhr.setRequestHeader('Content-type', 'application/json');    
        xhr.send();
        xhr.onreadystatechange = function()
        {
            if(xhr.readyState !=4 )
                return;
            var response  = JSON.parse(xhr.responseText);
            if(xhr.status == 200)   
                $('#main').append(response);     
        }
        return false;
    });  

    $('#buttonHeader').click(function() //выводит книги после сортировки
    {
        var genre = $('#genre').val();
        var author = $('#author').val();
        var poisk = $('#poisk').val();
        var publishing = $('#publishing').val();
        var data = {
            gen: genre,
            aut: author,
            poi: poisk,
            pub: publishing
        }
        data = JSON.stringify(data);
        var xhr = new XMLHttpRequest();
        xhr.open('POST','poisk/poisk.php?',true);
        xhr.setRequestHeader('Content-type', 'application/json');    
        xhr.send(data);
        xhr.onreadystatechange = function()
        {
            if(xhr.readyState !=4 )
                return;
            var response  = JSON.parse(xhr.responseText);
            if(xhr.status == 200)  
                $('#main').empty(); 
                $('#main').append(response);    
        }
        return false;
    }); 
    
}); 