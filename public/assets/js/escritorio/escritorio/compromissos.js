var evento = {};
$(document).ready(function() {
    var dialog;
    dialog = $("#dialog-compromisso").dialog({
        autoOpen: false,
        height: 300,
        width: 450,
        modal: true,
        buttons: {
            "Salvar": function() {
                salvarCompromisso(dialog);
            },
            Cancel: function() {
                resetForm();
                dialog.dialog("close");
            }
        }
    });

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        selectHelper: true,
        select: function(start, end) {
            $("#dialog-compromisso").dialog('option', 'title', 'Novo evento');
            evento = {};
            abrirDialogCompromisso(dialog, start, end);
        },
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: events,
        eventClick: function(calEvent, jsEvent, view) {
            $("#dialog-compromisso").dialog('option', 'title', 'Editar evento');
            evento = calEvent;
            abrirDialogCompromisso(dialog, event.start, event.end, calEvent);
        },
        eventRender: function(event, element) {
            element.qtip({
                content: event.descricao,
                position: {
                    my: 'center center'
                }
            });
        }
    });
});

var start, end;

function abrirDialogCompromisso(dialog, s, e, event) {
    //console.log("abrir");
    start = s;
    end = e;

    console.log(event);
    if (event) {
        $("#evento_id").val(event.title);
        $("#evento_titulo").val(event.title);
        $("#evento_descricao").val(event.descricao);

        var auxS = moment(event.start._d).utc();
        var auxE = moment(event.end._d).utc();
    } else {
        var auxS = moment(s._d).utc();
        var auxE = moment(e._d).utc();
    }
    $("#evento_inicio").val(dtBanco2View(auxS.format("YYYY-MM-DD HH:mm:ss"), auxS._d));
    $("#evento_fim").val(dtBanco2View(auxE.format("YYYY-MM-DD HH:mm:ss"), auxE._d));

    dialog.dialog("open");
}

function resetForm() {
    $("#evento_id").val("");
    $("#evento_titulo").val("");
    $("#evento_inicio").val("");
    $("#evento_fim").val("");
    $("#evento_descricao").val("");
}

function dtBanco2View(dtB, dtB2) {
    if ($.isArray(dtB)) {
        var data = [];
        data.push("0000" + dtB[0]);
        data.push("0000" + dtB[1]);
        data.push("0000" + dtB[2]);
        data.push("0000" + dtB[3]);
        data.push("0000" + dtB[4]);

        return data[2].substr(-2) + "/" + data[1].substr(-2) + "/" + data[0].substr(-4) + " " + data[3].substr(-2) + ":" + data[4].substr(-2);
    }
    var ar = dtB.split(" ");
    var dt = ar[0].split("-");
    var hr = ar[1].split(":");

    //console.log(dtB, dtB2);
    var aux = dtB2.toString().split(" ");
    var ret2 = aux[4].substr(-6);

    var ret = dt[2] + "/" + dt[1] + "/" + dt[0] + " " + hr[0] + ":" + hr[1] + ":00";
    ret = ret.substr(0, 13) + ret2;
    return ret.substr(0, 16);
}

function dtView2Banco(data) {
    var ar = data.split(" ");
    var dt = ar[0].split("/");
    var hr = ar[1].split(":");

    return dt[2] + "-" + dt[1] + "-" + dt[0] + "T" + hr[0] + ":" + hr[1] + ":00";
}

function salvarCompromisso(dialog) {
    var id = $("#evento_id").val();
    var title = $("#evento_titulo").val();
    var descricao = $("#evento_descricao").val();
    var s = dtView2Banco($("#evento_inicio").val());
    var e = dtView2Banco($("#evento_fim").val());

    resetForm();

    var eventData;
    //console.log(s, e);
    if (title) {
        if (id) {
            eventData = evento;
            eventData.title = title;
            eventData.start = s;
            eventData.end = e;
            eventData.descricao = descricao;

            if (s.substr(-8) == "00:00:00" && e.substr(-8) == "00:00:00") {
                eventData.allDay = true;
            } else {
                eventData.allDay = false;
            }

            //console.log(s, e);
            //console.log(moment(s), moment(e));
            //console.log(eventData);

            $('#calendar').fullCalendar('updateEvent', eventData);
        } else {
            eventData = {};
            eventData.title = title;
            eventData.start = moment(s);
            eventData.end = moment(e);
            eventData.descricao = descricao;

            if (s.substr(-8) == "00:00:00" && e.substr(-8) == "00:00:00") {
                eventData.allDay = true;
            } else {
                eventData.allDay = false;
            }

            $('#calendar').fullCalendar('renderEvent', eventData, true);
        }
    }
    $('#calendar').fullCalendar('unselect');

    dialog.dialog("close");
}

function enviarCompromissos() {
    //console.log("enviar");
    var eventos = $('#calendar').fullCalendar('clientEvents');

    var params = [];
    $.each(eventos, function(index, evento) {
        params.push({
            title: evento.title,
            start: evento.start._d,
            end: evento.end._d,
            id: evento._id,
            allDay: evento.allDay,
            descricao: evento.descricao
        });
    });

    //console.log(params, eventos);

    $("#compromissosJson").val(JSON.stringify(params));

    $("#compromissosform").submit();
}