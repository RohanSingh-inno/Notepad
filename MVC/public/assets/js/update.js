/**
 * Jquery code to update the note details.
 */
$(document).ready(function () {
    $("#update").on("click",function(e) {
        e.preventDefault();
        var title = $('#title').val();
        var noteBody = $('#noteBody').val();

        $.ajax({
            url : "/dashboardController/updateNotes",
            type : "POST",
            data : {Notetitle: title , body: noteBody} ,
            success : function(data){
              if(data == 1){
                $('#corrSub').html("Data Updated Successfully");
              }else{
                $('#corrSub').html("Failed to update");
              }
            }

        });
      })
    });
    