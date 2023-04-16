$(document).ready(function () {
    $("#register").on("click",function(e) {
        e.preventDefault();
        var title = $('#title').val();
        var noteBody = $('#noteBody').val();

        $.ajax({
            url : "/dashboardController/addNote",
            type : "POST",
            data : {Notetitle: title , body: noteBody} ,
            success : function(data){
              if(data == 1){
                $('#corrSub').html("Data Inserted Successfully");
              }else{
                $('#corrSub').html("Data not insert");
              }
            }

        });
      })
    });
    