$(document).ready(function()
{
    $(document).ready(function() //раскрывающиеся блоки
    {
        $('.spoiler').css({'display':'none'});  
        $('.zagolovok').click(function(){
            $(this).next('.spoiler').slideToggle(500)
        });
    }); 

    $(document).ready(function() //выводит настройки поиска
    {
        var checkSearchSettings = true;
        var xhr = new XMLHttpRequest();
        xhr.open('GET','logics.php?checkSearchSettings='+checkSearchSettings,true);
        xhr.setRequestHeader('Content-type', 'application/json');    
        xhr.send();
        xhr.onreadystatechange = function()
        {
            if(xhr.readyState !=4 )
                return;
            var response  = JSON.parse(xhr.responseText);
            if(xhr.status == 200)
            $('#poiskRoot').append(response);
            buttonPoiskAdmin()
            buttonPoiskModer()
        }
        return false;
    }); 

    function buttonPoiskAdmin() { //поиск по книгам при нажатии на кнопку для админа
        $('button[name="sendData"]').click(function() 
        {
            var genre = $('#genrePoisk').val();
            var author = $('#authorPoisk').val();
            var poisk = $('#poiskPoisk').val();
            var publishing = $('#publishingPoisk').val();
            var data = {
                gen: genre,
                aut: author,
                poi: poisk,
                pub: publishing
            }
            data = JSON.stringify(data);
            var xhr = new XMLHttpRequest();
            xhr.open('POST','poiskAdmin.php?',true);
            xhr.setRequestHeader('Content-type', 'application/json');    
            xhr.send(data);
            xhr.onreadystatechange = function()
            {
                if(xhr.readyState !=4 )
                    return;
                var response  = JSON.parse(xhr.responseText);
                if(xhr.status == 200)  
                    $('#allBooksAdmin').empty(); 
                    $('#allBooksAdmin').append(response);    
                    buttonDelete();
                    buttonChange();
            }
            return false;
        }); 
    }

    function buttonPoiskModer() { //поиск по книгам при нажатии на кнопку для модера
        $('button[name="sendData"]').click(function() 
        {
            var genre = $('#genrePoisk').val();
            var author = $('#authorPoisk').val();
            var poisk = $('#poiskPoisk').val();
            var publishing = $('#publishingPoisk').val();
            var data = {
                gen: genre,
                aut: author,
                poi: poisk,
                pub: publishing
            }
            data = JSON.stringify(data);
            var xhr = new XMLHttpRequest();
            xhr.open('POST','poiskModer.php?',true);
            xhr.setRequestHeader('Content-type', 'application/json');    
            xhr.send(data);
            xhr.onreadystatechange = function()
            {
                if(xhr.readyState !=4 )
                    return;
                var response  = JSON.parse(xhr.responseText);
                if(xhr.status == 200)  
                    $('#allBooksModer').empty(); 
                    $('#allBooksModer').append(response);    
                    buttonDelete();
                    buttonChange();
            }
            return false;
        }); 
    }

    $(document).ready(function() //выводит таблицу с книгами
    {
        bookOutputAdmin();
        bookOutputModer();
    }); 

    function bookOutputAdmin() { //генерирует таблицу с книгами для админа
        var allBooksAdmin = true;
        var xhr = new XMLHttpRequest();
        xhr.open('GET','logics.php?allBooksAdmin='+allBooksAdmin,true);
        xhr.setRequestHeader('Content-type', 'application/json');    
        xhr.send();
        xhr.onreadystatechange = function()
        {
            if(xhr.readyState !=4 )
                return;
            var response  = JSON.parse(xhr.responseText);
            if(xhr.status == 200)
            {
                $('#allBooksAdmin').empty(); 
                $('#allBooksAdmin').append(response);
                buttonDelete();
                buttonChange();
            }
        }
        return false;
    }

    function bookOutputModer() { //генерирует таблицу с книгами для модера
        var allBooksModer = true;
        var xhr = new XMLHttpRequest();
        xhr.open('GET','logics.php?allBooksModer='+allBooksModer,true);
        xhr.setRequestHeader('Content-type', 'application/json');    
        xhr.send();
        xhr.onreadystatechange = function()
        {
            if(xhr.readyState !=4 )
                return;
            var response  = JSON.parse(xhr.responseText);
            if(xhr.status == 200)
            {
                $('#allBooksModer').empty(); 
                $('#allBooksModer').append(response);
                buttonDelete();
                buttonChange();
            }
        }
        return false;
    }

    function buttonDelete() //удаление книги при нажатии на кнопку
    {
        $('button[name="delete"]').click(function() 
        {
            var id = $(this).attr("value");
            var type = $(this).attr("name");
            var data = {
                id: id,
                type: type
            }
            data = JSON.stringify(data);
            var xhr = new XMLHttpRequest();
            xhr.open('POST','bookOperations.php',true);
            xhr.setRequestHeader('Content-type', 'application/json');    
            xhr.send(data);
            xhr.onreadystatechange = function()
            {
                if(xhr.readyState !=4 )
                    return;
                var response  = JSON.parse(xhr.responseText);
                if(xhr.status == 200) 
                    alert('Kнига удалена!');
                    $('#allBooksAdmin').empty();  
                    $('#allBooksAdmin').append(response);   
                    buttonDelete();  
                    buttonChange();
            }
            return false;
        }); 
    }

    function buttonChange() { //выводит форму для изменения параметров книги
        $('button[name="change"]').click(function() 
        {
            var id = $(this).attr("value");
            var type = $(this).attr("name");
            var data = {
                id: id,
                type: type
            }
            data = JSON.stringify(data);
            var xhr = new XMLHttpRequest();
            xhr.open('POST','bookOperations.php',true);
            xhr.setRequestHeader('Content-type', 'application/json');    
            xhr.send(data);
            xhr.onreadystatechange = function()
            {
                if(xhr.readyState !=4 )
                    return;
                var response  = JSON.parse(xhr.responseText);
                if(xhr.status == 200) 
                    $('#allBooksAdmin').empty();  
                    $('#allBooksAdmin').append(response); 
                    $('#allBooksModer').empty();  
                    $('#allBooksModer').append(response);  
                    buttonChangeData();
            }
            return false;
        }); 
    }

    function buttonChangeData() //изменяет параметры книги
    {
        $('button[name="changeData"]').click(function() {
            var id = $('#buttonChangeBookValuesSend').val();
            var name = $('#selectСhangeBookName').val();
            var author = $('#selectСhangeAuthor').val();
            var genre = $('#selectСhangeGenre').val();
            var publishing = $('#selectСhangePublishing').val();
            var age = $('#selectСhangeAge').val();
            var price = $('#selectСhangeSalePrice').val();
            var picture = $('#selectСhangePicture').val();
            var data = {
                id: id,
                name: name,
                author: author,
                genre: genre,
                publishing: publishing,
                age: age,
                price: price,
                picture: picture
            }
            data = JSON.stringify(data);
            var xhr = new XMLHttpRequest();
            xhr.open('POST','changeBookData.php',true);
            xhr.setRequestHeader('Content-type', 'application/json');    
            xhr.send(data);
            xhr.onreadystatechange = function()
            {
                if(xhr.readyState !=4 )
                    return;
                var response  = JSON.parse(xhr.responseText);
                if(xhr.status == 200)  
                    alert(response);
                    updateTable();
            }
            return false;
        }); 
    }
    function updateTable() //обновляет таблицу после изменения параметров
    {
        bookOutputAdmin()
        bookOutputModer()
    }

    $(document).ready(function() //выводит таблицу с издателями при загрузке страницы
    {
        Publishing();
    }); 

    function Publishing() { //создает таблицу с издателями
        var checkAllPublishing = true;
        var xhr = new XMLHttpRequest();
        xhr.open('GET','logics.php?checkAllPublishing='+checkAllPublishing,true);
        xhr.setRequestHeader('Content-type', 'application/json');    
        xhr.send();
        xhr.onreadystatechange = function()
        {
            if(xhr.readyState !=4 )
                return;
            var response  = JSON.parse(xhr.responseText);
            if(xhr.status == 200)
                $('#allPublishing').empty(); 
                $('#allPublishing').append(response);
                $('#poiskPublishingValue').val('');
        }
        return false;
    }

    $('#poiskPublishingButton').click(function() //поиск по издателям при нажатии на кнопку
    {
        var value = $('#poiskPublishingValue').val();
        var xhr = new XMLHttpRequest();
        xhr.open('GET','poiskPublishing.php?value='+value,true);
        xhr.setRequestHeader('Content-type', 'application/json');    
        xhr.send();
        xhr.onreadystatechange = function()
        {
            if(xhr.readyState !=4 )
                return;
            var response  = JSON.parse(xhr.responseText);
            if(xhr.status == 200)
                $('#allPublishing').empty(); 
                $('#allPublishing').append(response);
        }
        return false;
    });

    $('#poiskPublishingСlear').click(function() //возвращает таблицу с издателями к начальному виду
    {
        Publishing();
        $('#poiskPublishingValue').val('');
    });

    $(document).ready(function() //выводит поля и списки для добавления книги
    {
        var checkAddBook = true;
        var xhr = new XMLHttpRequest();
        xhr.open('GET','logics.php?checkAddBook='+checkAddBook,true);
        xhr.setRequestHeader('Content-type', 'application/json');    
        xhr.send();
        xhr.onreadystatechange = function()
        {
            if(xhr.readyState !=4 )
                return;
            var response  = JSON.parse(xhr.responseText);
            if(xhr.status == 200) 
                $('#addBookValue').append(response);
        }
        return false;
    }); 

    $('#addBookSend').click(function() //добавляет книгу
    {
        var name = $('#nameBook').val();
        var author = $('#author').val();
        var genre = $('#genre').val();
        var publishing = $('#publishing').val();
        var age = $('#age').val();
        var price = $('#price').val();
        var picture = $('#picture').val();
        var addBook = {
            name: name,
            author: author,
            genre: genre,
            publishing: publishing,
            age: age,
            price: price,
            picture: picture
        }
        addBook = JSON.stringify(addBook);
        var xhr = new XMLHttpRequest();
        xhr.open('POST','addBook.php?',true);
        xhr.setRequestHeader('Content-type', 'application/json');    
        xhr.send(addBook);
        xhr.onreadystatechange = function()
        {
            if(xhr.readyState !=4 )
                return;
            var response  = JSON.parse(xhr.responseText);
            if(xhr.status == 200)  
                $('#nameBook').val('');
                $('#author').val('');
                $('#genre').val('');
                $('#publishing').val('');
                $('#age').val('');
                $('#price').val('');
                $('#picture').val('');
                alert(response);   
        }
        return false;
    }); 

    $(document).ready(function() //очищает поля ввода жанра автора издательства
    {
        $('#addGenreValue').val('');
        $('#addAuthorValue').val(''); 
        $('#addPublishingValue').val('');
    });

    $('#addGenreSend').click(function() //добавляет жанр
    {
        var addGenre = $('#addGenreValue').val();
        var addParameter = {
            value: addGenre,
            check: 1,
        }
        addParameter = JSON.stringify(addParameter);
        var xhr = new XMLHttpRequest();
        xhr.open('POST','add.php?',true);
        xhr.setRequestHeader('Content-type', 'application/json');    
        xhr.send(addParameter);
        xhr.onreadystatechange = function()
        {
            if(xhr.readyState !=4 )
                return;
            var response  = JSON.parse(xhr.responseText);
            if(xhr.status == 200)  
                $('#addGenreValue').val('');
                alert(response);  
        }
        return false;
    }); 

    $('#addAuthorSend').click(function() //добавляет автора
    {
        var addAuthor = $('#addAuthorValue').val();
        var addParameter = {
            value: addAuthor,
            check: 2,
        }
        addParameter = JSON.stringify(addParameter);
        var xhr = new XMLHttpRequest();
        xhr.open('POST','add.php?',true);
        xhr.setRequestHeader('Content-type', 'application/json');    
        xhr.send(addParameter);
        xhr.onreadystatechange = function()
        {
            if(xhr.readyState !=4 )
                return;
            var response  = JSON.parse(xhr.responseText);
            if(xhr.status == 200) 
                $('#addAuthorValue').val(''); 
                alert(response);   
        }
        return false;
    }); 

    $('#addPublishingSend').click(function() //добавляет издателя
    {
        var addPublishing = $('#addPublishingValue').val();
        var addParameter = {
            value: addPublishing,
            check: 3,
        }
        addParameter = JSON.stringify(addParameter);
        var xhr = new XMLHttpRequest();
        xhr.open('POST','add.php?',true);
        xhr.setRequestHeader('Content-type', 'application/json');    
        xhr.send(addParameter);
        xhr.onreadystatechange = function()
        {
            if(xhr.readyState !=4 )
                return;
            var response  = JSON.parse(xhr.responseText);
            if(xhr.status == 200)   
                $('#addPublishingValue').val('');
                alert(response);  
        }
        return false;
    }); 
}); 