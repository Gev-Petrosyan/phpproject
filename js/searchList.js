$(document).ready(function(){

        $(".form-control").keyup(function(){
            search($(".form-control").val());
        });
    
        function search(value) {
            $(".list-menu li").each(function(){
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
