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
        },
        onStepChanged: function (event, currentIndex, priorIndex) {
            // Sadece 3. adımda yükseklik 50rem olacak
            if (currentIndex === 2) { // 0'dan başlayarak sayıldığı için 3. adım 2. index'tir
                $(".content").css({
                    "height": "45rem",
                    "overflow-y": "scroll",   // Dikey kaydırmayı etkinleştir
                    "overflow-x": "auto"  // Yatay kaydırmayı devre dışı bırak
                });
            } else if(currentIndex === 0) {
                $(".content").css({
                    "height": "auto",
                    "overflow-y": "scroll",   // Dikey kaydırmayı etkinleştir
                    "overflow-x": "auto"  // Yatay kaydırmayı devre dışı bırak
                });
            } else {
                $(".content").css({
                    "height": "auto",
                    "overflow-y": "hidden",   // Dikey kaydırmayı etkinleştir
                    "overflow-x": "auto"  // Yatay kaydırmayı devre dışı bırak
                });
            }
        }
    });

    $(".content").css({
        "height": "auto",
        "overflow-y": "scroll",   // Dikey kaydırmayı etkinleştir
        "overflow-x": "auto"  // Yatay kaydırmayı devre dışı bırak
    });
    
})(jQuery);
