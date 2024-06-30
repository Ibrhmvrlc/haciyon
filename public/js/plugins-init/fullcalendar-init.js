! function(e) {
    "use strict";
    var t = function() {
        this.$body = e("body"), this.$modal = e("#event-modal"), this.$event = "#external-events div.external-event", this.$calendar = e("#calendar"), this.$saveCategoryBtn = e(".save-category"), this.$categoryForm = e("#add-category form"), this.$extEvents = e("#external-events"), this.$calendarObj = null
    };
    t.prototype.onDrop = function(t, n) {
        var a = t.data("eventObject"),
            o = t.attr("data-class"),
            i = e.extend({}, a);
        i.start = n, o && (i.className = [o]), this.$calendar.fullCalendar("renderEvent", i, !0), e("#drop-remove").is(":checked") && t.remove()
    };

     // Meta etiketten CSRF token'ı al
     var csrfToken = $('meta[name="csrf-token"]').attr('content');

     // AJAX isteğine CSRF token'ını ekle
     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': csrfToken
         }
     });
     

    t.prototype.onEventClick = function(t, n, a) {
        var o = this,
            i = e("<form>@csrf</form>");
        i.append("<label>Change event name</label>"), i.append("<div class='input-group'><input class='form-control' type=text value='" + t.title + "' /><span class='input-group-btn'><button type='submit' class='btn btn-success waves-effect waves-light'><i class='fa fa-check'></i> Save</button></span></div>"), o.$modal.modal({
            backdrop: "static"
        }), o.$modal.find(".delete-event").show().end().find(".save-event").hide().end().find(".modal-body").empty().prepend(i).end().find(".delete-event").unbind("click").on("click", function() {
            o.$calendarObj.fullCalendar("removeEvents", function(e) {
                return e._id == t._id
            }), o.$modal.modal("hide")
        }), o.$modal.find("form").on("submit", function() {
            t.title = i.find("input[type=text]").val();
            $.ajax({
                url: '/program/update', // Güncelleme rotasi
                method: 'POST',
                data: {
                    id: t._id, // Olay ID'si
                    title: t.title,
                    start: t.start.format(), // ISO formatında başlangıç tarihi
                    end: t.end ? t.end.format() : null, // ISO formatında bitiş tarihi
                    category: t.className[0]
                },
                success: function(response) {
                    o.$calendarObj.fullCalendar("updateEvent", t);
                    o.$modal.modal("hide");
                }
            });
            return false;
        });
    };

    t.prototype.onSelect = function(t, n, a) {
        var o = this;
        o.$modal.modal({
            backdrop: "static"
        });
        var i = e("<form></form>");
        i.append("<div class='row'></div>");
        i.find(".row").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Event Name</label><input class='form-control' placeholder='Insert Event Name' type='text' name='title'/></div></div>").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Category</label><select class='form-control' name='category'></select></div></div>").find("select[name='category']").append("<option value='bg-danger'>Danger</option>").append("<option value='bg-success'>Success</option>").append("<option value='bg-dark'>Dark</option>").append("<option value='bg-primary'>Primary</option>").append("<option value='bg-pink'>Pink</option>").append("<option value='bg-info'>Info</option>").append("<option value='bg-warning'>Warning</option></div></div>");
        o.$modal.find(".delete-event").hide().end().find(".save-event").show().end().find(".modal-body").empty().prepend(i).end().find(".save-event").unbind("click").on("click", function() {
            i.submit();
        });
        o.$modal.find("form").on("submit", function() {
            var title = i.find("input[name='title']").val(),
                category = i.find("select[name='category'] option:checked").val();
            if (title) {
                var newEvent = {
                    title: title,
                    start: t,
                    end: n,
                    allDay: false,
                    className: category
                };
                $.ajax({
                    url: '/program/create', // Kaydetme rotanızı ayarlayın
                    method: 'POST',
                    data: {
                        title: title,
                        start: t.format(), // ISO formatında başlangıç tarihi
                        end: n ? n.format() : null, // ISO formatında bitiş tarihi
                        category: category
                    },
                    success: function(response) {
                        newEvent.id = response.id; // Sunucudan dönen ID'yi kullanın
                        o.$calendarObj.fullCalendar("renderEvent", newEvent, true);
                        o.$modal.modal("hide");
                    }
                });
            } else {
                alert("You have to give a title to your event");
            }
            return false;
        });
        o.$calendarObj.fullCalendar("unselect");
    };

    t.prototype.enableDrag = function() {
        e(this.$event).each(function() {
            var t = {
                title: e.trim(e(this).text())
            };
            e(this).data("eventObject", t), e(this).draggable({
                zIndex: 999,
                revert: !0,
                revertDuration: 0
            })
        })
    }, t.prototype.init = function() {
        this.enableDrag();
        var t = new Date,
            n = (t.getDate(), t.getMonth(), t.getFullYear(), new Date(e.now())),
            a = [{
                title: "Chicken Burger",
                start: new Date(e.now() + 158e6),
                className: "bg-dark"
            }, {
                title: "Soft drinkaaas",
                start: n,
                end: n,
                className: "bg-danger"
            }, {
                title: "Hot dog",
                start: new Date(e.now() + 338e6),
                className: "bg-primary"
            }],
            o = this;
        o.$calendarObj = o.$calendar.fullCalendar({
            slotDuration: "00:30:00",
            minTime: "07:00:00",
            maxTime: "21:00:00",
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
            }
        }), this.$saveCategoryBtn.on("click", function() {
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