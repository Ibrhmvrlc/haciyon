(function($) {
    "use strict"

    var form = $("#step-form-horizontal");
    form.children('div').steps({
        headerTag: "h4",
        bodyTag: "section",
        autoFocus: true, 
        transitionEffect: "fade",
        enableAllSteps: false,
        labels: {
            finish: "Tamamla",
            next: "İleri",
            previous: "Geri",
            loading: "Yükleniyor...",
        },
        onStepChanging: function (event, currentIndex, newIndex)
        {
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        }
    });

})(jQuery);