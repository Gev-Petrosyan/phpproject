$(document).ready(function(){

    $(".table-users-search .btn-outline-secondary").click(function(){
        search($(".table-users-search .form-control").val());
    });

    function search(value) {
        $("tbody tr").each(function(){
            var found = false;
            $(this).each(function(){
                if ($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0) {
                    found = true;
                }
            });
            if (found == true) {
                $(this).show();
            }
            else {
                $(this).hide();
            }
        });
    };


})