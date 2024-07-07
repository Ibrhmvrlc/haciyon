
! function(e) {
    "use strict";
    var t = function() {
        this.$body = e("body"), this.$modal = e("#event-modal"), this.$event = "#external-events div.external-event", this.$calendar = e("#calendar"), this.$saveCategoryBtn = e(".save-category"), this.$categoryForm = e("#add-category form"), this.$extEvents = e("#external-events"), this.$calendarObj = null
    };

    // CSRF tokenini meta etiketinden al
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

   /* t.prototype.onDrop = function(t, n) {
        var a = t.data("eventObject"),
            o = t.attr("data-class"),
            i = e.extend({}, a);
        i.start = n, o && (i.className = [o]), this.$calendar.fullCalendar("renderEvent", i, !0), e("#drop-remove").is(":checked") && t.remove();
    };
    */

    t.prototype.onEventClick = function(t, n, a) {
        var o = this,
            i = e("<form></form>");
        i.append("<label>Programı Güncelle</label>"), i.append("<div class='input-group'><input class='form-control' type=text value='" + t.title + "' /><input class='form-control' type=hidden name='id' value='" + t._id + "' /><span class='input-group-btn'><button type='submit' class='btn btn-success waves-effect waves-light'><i class='fa fa-check'></i> Save</button></span></div>"), o.$modal.modal({
            backdrop: "static"
        }), o.$modal.find(".delete-event").show().end().find(".save-event").hide().end().find(".modal-body").empty().prepend(i).end().find(".delete-event").unbind("click").on("click", function() {
            o.$calendarObj.fullCalendar("removeEvents", function(e) {
                return e._id == t._id
            }), o.$modal.modal("hide");
    
            // AJAX request to delete event from the database
            $.ajax({
                url: '/path/to/your/delete/event',
                type: 'POST',
                data: {
                    id: t._id,
                    _token: csrfToken
                },
                success: function(response) {
                    console.log('Event deleted successfully:', response);
                },
                error: function(xhr, status, error) {
                    console.error('Failed to delete event:', error);
                }
            });
        });

        function kacinciTekilSayi(sayi) {
            if (sayi <= 0) {
                return 0; // Negatif veya sıfır verildiğinde 0 döndürsün
            }
        
            let tekilSayiSayaci = 0;
            let currentNumber = 1;
        
            while (true) {
                if (isTekilSayi(currentNumber)) {
                    tekilSayiSayaci++;
                }
                if (currentNumber === sayi) {
                    return tekilSayiSayaci;
                }
                currentNumber++;
            }
        }
        
        function isTekilSayi(num) {
            return num % 2 !== 0; // Tekil sayıyı kontrol eden fonksiyon
        }

        o.$modal.find("form").on("submit", function(id) {
            e._id = parseInt(i.find("input[name='id']").val().replace(/\D/g, ''), 10),
            e._id = kacinciTekilSayi(parseInt(i.find("input[name='id']").val().replace(/\D/g, ''), 10)),
            t.title = i.find("input[type=text]").val(),
            o.$calendarObj.fullCalendar("updateEvent", t), 
            o.$modal.modal("hide");
 
            // AJAX request to update event in the database
            $.ajax({
                url: '/program/update',
                type: 'POST',
                data: {
                    id: e._id, // You need to pass the event ID to update the correct event
                    title: t.title, // Use t.title instead of e
                    start: t.start.format(), // Assuming you're using moment.js for date formatting
                    end: t.end.format(), // Assuming you're using moment.js for date formatting
                    className: 'mikserlii', // Assuming t.className is the correct property
                    _token: csrfToken
                },
                success: function(response) {
                    console.log('Event updated successfully:', response);
                },
                error: function(xhr, status, error) {
                    console.error('Failed to update event:', error);
                    console.error('Error status:', status);
                    console.error('Error xhr:', xhr.responseText);
                }
            });
    
            return !1;
        })
    };
    
    

    t.prototype.onSelect = function(t, n, a) {
        var o = this;
        o.$modal.modal({
            backdrop: "static"
        });
        var i = e("<form></form>");
            i.append("<div class='row'></div>"), 
            i.find(".row")
            .append("<div class='col-md-12'><div class='form-group'><label class='control-label'>Müşteri Ünvanı</label><input class='form-control' placeholder='Ünvan Giriniz' type='text' name='title'/></div></div>")
            
            i.find(".row")
            .append("<div class='col-md-6'><div class='form-group' id='beton-cinsi-group'><label class='control-label'>Beton Cinsi</label><select class='form-control' name='betoncinsi'><option value='' selected disabled>Lütfen seçiniz...</option></select></div></div>")
            .find("select[name='betoncinsi']")
            .append("<option value='Gro'>C16</option>")
            .append("<option value='C20'>C20</option>")
            .append("<option value='C25'>C25</option>")
            .append("<option value='C30'>C30</option>")
            .append("<option value='C35'>C35</option>")
            .append("<option value='C40'>C40</option>")
            .append("<option value='C45'>C45</option>")
            .append("<option value='C50'>C50</option>");

            i.find(".row")
            .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Metraj</label><input class='form-control' placeholder='Metraj Giriniz' type='text' name='metraj'/></div></div>");

            i.find(".row")
            .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Döküm Şekli</label><select class='form-control' name='category'></select></div></div>")
            .find("select[name='category']")
            .append("<option value='' disabled selected>Seçiniz</option>")
            .append("<option value='pompali'>Pompalı</option>")
            .append("<option value='mikserli'>Mikserli</option>")
            .append("<option value='santralalti'>Santral Altı</option>");

            i.find(".row")
            .append("<div class='col-md-6'><div class='form-group' id='pompaci-group' style='display:none;'><label class='control-label'>Pompa ve Operatörü</label><select class='form-control' name='pompaci'><option value='' selected disabled>Lütfen seçiniz...</option></select></div></div>")
            .find("select[name='pompaci']")
            .append("<option value='pompacibir'>P1 38lik - Ahmet Kaya</option>")
            .append("<option value='pompaciiki'>P2 38lik - Şaban Kaya</option>")
            .append("<option value='pompaciuc'>P3  47lik - Lütfü Taş</option>");

            i.find(".row")
            .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Şantiye</label><input class='form-control' placeholder='Şantiye Giriniz' type='text' name='santiye'/></div></div>");

            i.find(".row")
            .append("<div class='col-md-6'><div class='form-group' id='yapi-elemani-group'><label class='control-label'>Yapı Elemanı</label><select class='form-control' name='yapielemani'><option value='' selected disabled>Lütfen seçiniz...</option></select></div></div>")
            .find("select[name='yapielemani']")
            .append("<option value='Yer'>Yer</option>")
            .append("<option value='Saha'>Saha</option>")
            .append("<option value='Temel'>Temel</option>")
            .append("<option value='Perde'>Perde</option>")
            .append("<option value='Kolon'>Kolon</option>")
            .append("<option value='Kiriş'>Kiriş</option>")
            .append("<option value='Tabliye'>Tabliye</option>")
            .append("<option value='Diğer'>Diğer</option>");
            
        o.$modal.find(".delete-event").hide().end().find(".save-event").show().end().find(".modal-body").empty().prepend(i).end().find(".save-event").unbind("click").on("click", function() {
            i.submit()
        });

        // Olay dinleyicisi ekleyin
        i.find("select[name='category']").on("change", function() {
            if ($(this).val() === 'pompali') {
                $("#pompaci-group").show();
            } else {
                $("#pompaci-group").hide();
                $("#pompaci-group select").val('');
            }
        });

        o.$modal.find("form").on("submit", function() {
            var e = i.find("input[name='title']").val(),
                a = (i.find("input[name='beginning']").val(), i.find("input[name='ending']").val(), i.find("select[name='category'] option:checked").val()),
                c = i.find("select[name='category'] option:checked").val(),
                p = i.find("select[name='pompaci'] option:checked").val(),
                s = i.find("input[name='santiye']").val(),
                m = i.find("input[name='metraj']").val(),
                y = i.find("select[name='yapielemani'] option:checked").val(),
                u = i.find("select[name='betoncinsi'] option:checked").val();

            return null !== e && 0 != e.length ? (o.$calendarObj.fullCalendar("renderEvent", {
                title: e,
                start: t,
                end: n.add(1, 'hours').add(45, 'minutes').format(),
                allDay: !1,
                className: a,
                pompaci: p,
                dokum_sekli: c,
                santiye: s,
                metraj: m,
                yapi_elemani: y,
                beton_cinsi: u,
            }, !0), o.$modal.modal("hide"),
            
            // AJAX request to save new event to the database
            $.ajax({
                url: '/program/create',
                type: 'POST',
                data: {
                    title: e,
                    start: t.format(), // Assuming you're using moment.js for date formatting
                    end: t.add(2, 'hours').format(), // Assuming you're using moment.js for date formatting
                    className: a,
                    pompaci: p,
                    santiye: s,
                    metraj: m,
                    yapi_elemani: y,
                    beton_cinsi: u,
                    _token: csrfToken
                },
                success: function(response) {
                    console.log('Event saved successfully:', response);
                },
                error: function(xhr, status, error) {
                    console.log('Failed to save event:', error);
                }
            })) : alert("You have to give a title to your event"), !1
        }), o.$calendarObj.fullCalendar("unselect")
    };

    
    t.prototype.enableDrag = function() {
        var o = this;
        e(this.$event).each(function() {
            var t = {
                title: e.trim(e(this).text())
            };
            e(this).data("eventObject", t), e(this).draggable({
                zIndex: 999,
                revert: !0,
                revertDuration: 0,
                stop: function(t, n) {
                    var a = e(this).data("eventObject");
                        a.start = o.$calendarObj.fullCalendar("getDate"),
                        a.className = [e(this).attr("data-class")],
                        o.$calendarObj.fullCalendar("renderEvent", a, !0);
                }
            })
        })
    };

    t.prototype.init = function() {
        this.enableDrag();
        var t = new Date,
            n = (t.getDate(), t.getMonth(), t.getFullYear(), new Date(e.now())),
            a = [],
            o = this;

        // Fetch events from the database
        $.ajax({
            url: '/program/events',
            type: 'GET',
            success: function(data) {
                a = data.map(function(event) {
                    return {
                        id: event.id,
                        title: event.musteri_adi,
                        start: event.baslangic_saati, // Assuming start date is in correct format
                        end: event.bitis_saati, // Assuming end date is in correct format
                        className: event.dokum_sekli,
                        pompaci: event.pompaci,
                        metraj: event.metraj,
                        santiye: event.santiye,
                        yapi_elemani: event.yapi_elemani
                    };
                });

                o.$calendarObj = o.$calendar.fullCalendar({
                    slotDuration: "00:15:00",
                    minTime: "07:00:00",
                    maxTime: "20:00:00",
                    defaultView: "agendaDay",
                    handleWindowResize: !0,
                    height: e(window).height() - 100,
                    header: {
                        left: "prev,next today",
                        center: "title",
                        right: "month,agendaWeek,agendaDay, list"
                    },
                    events: a,
                    editable: !0,
                    droppable: !0,
                    eventLimit: !0,
                    selectable: !0,
                    timeFormat: 'H:mm', // 24 saat formatı
                    slotLabelFormat: 'H:mm', // 24 saat formatı
                    drop: function(t) {
                        o.onDrop(e(this), t)
                    },
                    select: function(e, t, n) {
                        o.onSelect(e, t, n)
                    },
                    eventClick: function(e, t, n) {
                        o.onEventClick(e, t, n)
                    },
                    eventRender: function(event, element) {
                        if (event.pompaci) {
                            element.find('.fc-title').append('<div class="fc-operator"><b>Pompa:</b> ' + event.pompaci + '</div>');
                        }else{
                            element.find('.fc-title').append('<div class="fc-dokumsekli"><b>Mikserli</b></div>');
                        }
                        if (event.metraj) {
                            element.find('.fc-title').append('<div class="fc-metraj"><b>Metraj:</b> ' + event.metraj + ' m3</div>');
                        }
                        if (event.santiye) {
                            element.find('.fc-title').append('<div class="fc-santiye"><b>Şantiye:</b> ' + event.santiye + '</div>');
                        }
                        if (event.yapi_elemani) {
                            element.find('.fc-title').append('<div class="fc-santiye"><b>Yapı Elemanı:</b> ' + event.yapi_elemani + '</div>');
                        }
                    },
                    eventDrop: function(event, revertFunc) {
                        // Update the event in the database
                        $.ajax({
                            url: '/program/update-drag',
                            type: 'POST',
                            data: {
                                id: event.id,
                                start: event.start.format(), // Use the updated start date
                                end: event.end.format(), // Use the updated end date
                                _token: csrfToken // Ensure this token is correct and present
                            },
                            success: function(response) {
                                console.log('Event updated successfully:', response);
                            },
                            error: function(xhr, status, error) {
                                console.error('Failed to update event:', xhr.responseText); // Log the full response for debugging
                                revertFunc(); // Revert the event to its original position if the update fails
                            }
                        });
                    }
                    
                               
                });
            },
            error: function(xhr, status, error) {
                console.error('Failed to fetch events:', error);
            }
        });
       
        this.$saveCategoryBtn.on("click", function() {
                var e = o.$categoryForm.find("input[name='category-name']").val(),
                    t = o.$categoryForm.find("select[name='category-color']").val();
                null !== e && 0 != e.length && (o.$extEvents.append('<div class="external-event bg-' + t + '" data-class="bg-' + t + '" style="position: relative;"><i class="fa fa-move"></i>' + e + "</div>"), o.enableDrag())
        })
    }, e.CalendarApp = new t, e.CalendarApp.Constructor = t
}(window.jQuery),
function(e) {
    "use strict";
    e.CalendarApp.init()
}(window.jQuery);
