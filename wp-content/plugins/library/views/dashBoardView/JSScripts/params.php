<?php

?>
jQuery(document).ready(function($){
    $( "#customer" ).change(function() {
        postDataObj = jQuery("#dashBoard").jqGrid("getGridParam","postData");
        postDataObj["filter"] = $( this ).val();
        
        jQuery("#dashBoard").jqGrid("setGridParam",{postData: postDataObj})
                        .trigger("reloadGrid");
                        
        postDataObj = jQuery("#vehiculos").jqGrid("getGridParam","postData");
        postDataObj["filter"] = $( this ).val();
        
        jQuery("#vehiculos").jqGrid("setGridParam",{postData: postDataObj})
                        .trigger("reloadGrid");
    });
    jQuery.ajax({   type: "POST"
                    ,url: "admin-ajax.php"
                    ,data: {action: "action", id: "dashBoard",method: "getCustomers"}
                }).done(function(data){
                        var objJson = jQuery.parseJSON(data);
                        if(data != "[]"){
                            $.each(objJson.rows, function(index, item) {
                                $("#customer").append( 
                                    $("<option></option>") 
                                        .text(item.cell[1])
                                        .val(item.cell[0])
                                );
                            }); 
                        }
                    });
});

