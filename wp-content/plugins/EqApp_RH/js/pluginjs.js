function responsive_jqgrid(jqgrid) {
    jqgrid.find(".ui-jqgrid").addClass("clear-margin span12").css("width", "");
    jqgrid.find(".ui-jqgrid-view").addClass("clear-margin span12").css("width", "");
    jqgrid.find(".ui-jqgrid-view > div").eq(1).addClass("clear-margin span12").css("width", "").css("min-height", "0");
    jqgrid.find(".ui-jqgrid-view > div").eq(2).addClass("clear-margin span12").css("width", "").css("min-height", "0");
    jqgrid.find(".ui-jqgrid-sdiv").addClass("clear-margin span12").css("width", "");
    jqgrid.find(".ui-jqgrid-pager").addClass("clear-margin span12").css("width", "");
}

function setTextAreaForm(form, id){
    
    $tr = form.find("#"+id), 
    $label = $tr.children("td.CaptionTD"),
    $data = $tr.children("td.DataTD");
    $data.attr("colspan", "3");
    $data.children("textarea").css("width", "100%");
    var textAreaId = $data.children("textarea").attr('id')
    tinymce.editors = new Array();
    jQuery('#'+textAreaId).tinymce({
        mode : "none",
        theme : "modern",
        plugins: "table code",
        tools: "inserttable"
    });
}

function noHTMLTags(string){return string.replace(/(<([^>]+)>)/ig,'');}

function imageExist(url) 
{
   var img = new Image();
   img.src = url;
   return (img.height != 0)? true : false;
}

function ajaxFileUpload(id, url, elementId, oper, parentRelationShip, gridId) 
{
    if(jQuery('#'+elementId).val() != ""){
        jQuery("#loading")
        .ajaxStart(function () {
            jQuery(this).show();
        })
        .ajaxComplete(function () {
            jQuery(this).hide();
        });

        jQuery.ajaxFileUpload
        (
            {
                url: url,
                secureuri: false,
                fileElementId: elementId,
                dataType: 'json',
                data: { parentId: id, oper: oper, parentRelationShip: parentRelationShip, idFile: elementId },
                success: function (data, status) {

                    if (typeof (data.msg) != 'undefined') {
                        if (data.msg == "success") {
                            return;
                        } else {
                            alert(data.error);
                        }
                    }
                    else {
                        return alert('Failed to upload file!');
                    }
                },
                complete: function(response){
                    jQuery('#'+gridId).jqGrid().trigger('reloadGrid');
                },
                error: function (data, status, e) {
                    return alert('Failed to upload file!');
                }
            }
        ) 
    }
 }  
 
function getFormData(id, params){
    jQuery.ajax({   type: "POST"
                    ,url: "admin-ajax.php"
                    ,data: params
                }).done(function(data){
                        var objJson = jQuery.parseJSON(data);
                        if(data == "[]"){
                            jQuery('#'+id).find('#oper').val("add");
                        }
                        else{
                            jQuery('#'+id).find('#oper').val("edit");
                            setformData(id, objJson);
                        }
                    });
}

function reSetformData(id){
    jQuery('#'+id).trigger("reset");
}

function setformData(id, obj){
    for(xx in obj[0]){
        if(jQuery("#"+xx))
            jQuery("#"+xx).val(obj[0][xx]);
    }
}

function disableElements(el) {
    for (var i = 0; i < el.length; i++) {
        el[i].disabled = true;

        disableElements(el[i].children);
    }
}

function enableElements(el) {
    for (var i = 0; i < el.length; i++) {
        el[i].disabled = false;

        enableElements(el[i].children);
    }
}


function miVidometro($){
    jQuery.ajax({   type: "POST"
                    ,url: "admin-ajax.php"
                    ,data: {action: "action", id: "integrantes", method:"getVidometro"}
                }).done(function(data){
                        var objJson = jQuery.parseJSON(data);
                        var dataValue = parseInt(objJson.rows[0].cell[0]);
                        if(dataValue){
                            var gaugeOptions = {

                                        chart: {
                                            type: 'solidgauge'
                                        },

                                        title: null,

                                        pane: {
                                            center: ['50%', '85%'],
                                            size: '100%',
                                            startAngle: -90,
                                            endAngle: 90,
                                            background: {
                                                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
                                                innerRadius: '60%',
                                                outerRadius: '100%',
                                                shape: 'arc'
                                            }
                                        },

                                        tooltip: {
                                            enabled: false
                                        },

                                        // the value axis
                                        yAxis: {
                                            stops: [
                                                [0.59, '#DF5353'], // red  
                                                [0.79, '#DDDF0D'], // yellow
                                                [1, '#55BF3B'] // green
                                            ],
                                            lineWidth: 0,
                                            minorTickInterval: null,
                                            tickPixelInterval: 400,
                                            tickWidth: 0,
                                            title: {
                                                y: -70
                                            },
                                            labels: {
                                                y: 16
                                            }
                                        },

                                        plotOptions: {
                                            solidgauge: {
                                                dataLabels: {
                                                    y: 5,
                                                    borderWidth: 0,
                                                    useHTML: true
                                                }
                                            }
                                        }
                                    };

                                    $('#vidometro-gauge').highcharts(Highcharts.merge(gaugeOptions, {
                                        yAxis: {
                                            min: 0,
                                            max: 100,
                                            title: {
                                                text: 'Vidometro'
                                            }
                                        },

                                        credits: {
                                            enabled: false
                                        },

                                        series: [{
                                            name: 'Vida',
                                            data: [dataValue],
                                            dataLabels: {
                                                format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                                                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
                                                       '<span style="font-size:12px;color:silver">% Vida</span></div>'
                                            },
                                            tooltip: {
                                                valueSuffix: ' % Vida'
                                            }
                                        }]

                                    }));
                        }
                    });
    
}

function miPerfil($){
    jQuery.ajax({   type: "POST"
                    ,url: "admin-ajax.php"
                    ,data: {action: "action", id: "integrantes", method:"getFillProfile"}
                }).done(function(data){
                        var objJson = jQuery.parseJSON(data);
                        var dataValue = parseInt(objJson.rows[0].cell[1]);
                        if(dataValue){
                            var gaugeOptions = {

                                        chart: {
                                            type: 'solidgauge'
                                        },

                                        title: null,

                                        pane: {
                                            center: ['50%', '85%'],
                                            size: '100%',
                                            startAngle: -90,
                                            endAngle: 90,
                                            background: {
                                                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
                                                innerRadius: '60%',
                                                outerRadius: '100%',
                                                shape: 'arc'
                                            }
                                        },

                                        tooltip: {
                                            enabled: false
                                        },

                                        // the value axis
                                        yAxis: {
                                            stops: [
                                                [0.8, '#DF5353'], // red  
                                                [0.95, '#DDDF0D'], // yellow
                                                [1, '#55BF3B'] // green
                                            ],
                                            lineWidth: 0,
                                            minorTickInterval: null,
                                            tickPixelInterval: 400,
                                            tickWidth: 0,
                                            title: {
                                                y: -70
                                            },
                                            labels: {
                                                y: 16
                                            }
                                        },

                                        plotOptions: {
                                            solidgauge: {
                                                dataLabels: {
                                                    y: 5,
                                                    borderWidth: 0,
                                                    useHTML: true
                                                }
                                            }
                                        }
                                    };

                                    $('#perfil-gauge').highcharts(Highcharts.merge(gaugeOptions, {
                                        yAxis: {
                                            min: 0,
                                            max: 100,
                                            title: {
                                                text: 'Perfil integrante'
                                            }
                                        },

                                        credits: {
                                            enabled: false
                                        },

                                        series: [{
                                            name: 'Integrante',
                                            data: [dataValue],
                                            dataLabels: {
                                                format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                                                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
                                                       '<span style="font-size:12px;color:silver">% Completo</span></div>'
                                            },
                                            tooltip: {
                                                valueSuffix: ' % Completo'
                                            }
                                        }]

                                    }));
                        }
                    });
    
}

jQuery(document).ready(function($){
    jQuery(".ui-jqgrid-titlebar").hide();
    
    miVidometro($);
    miPerfil($);
});