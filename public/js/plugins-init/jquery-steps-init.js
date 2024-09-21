(function($) {
    "use strict";

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
        onStepChanging: function (event, currentIndex, newIndex) {
            // Form validasyonunu kontrol ediyoruz
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        }
    });
    
    // Her adım içeriğine sabit yükseklik verip scroll ekleme
    $(".content").css({
        "height": "30rem",
        "overflow-y": "visible",   // Dikey kaydırmayı etkinleştir
        "overflow-x": "auto"  // Yatay kaydırmayı devre dışı bırak
    });
    
})(jQuery);
