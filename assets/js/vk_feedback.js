window.addEventListener("DOMContentLoaded", function(){
    /**
     * jQuery(function($) {}); добавлено для избежания конфликта
     */
    jQuery(function($) {
        console.log(feedbackObj);
        /**
         * Скрипт переправлен под свои параметры
         */
        let feedback_vk = {
            idBox: 'feedback_kupiapp',
            gid: '1',
            count: feedbackObj.counts_feedbacks,
            url_wiget: 'https://feedbackcloud.kupiapp.ru/widget/widget.php',
            init: function(obj) {
                if (!obj.id) { obj.id = this.idBox; }
                if (!obj.gid) { obj.gid = this.gid; }
                if (!obj.count) { obj.count = this.count; }

                if (document.getElementById(obj.id)) {
                    $.ajax({
                        type: 'GET',
                        url: this.url_wiget,
                        data: {gid: obj.gid, style: obj.style, count: obj.count},
                        success: function (html){
                            //вырезаем все лишнее
                            let replase_text = '\t<div>\n' +
                                '\t\t<img src="https://mc.yandex.ru/watch/48714419" style="position:absolute; left:-9999px;" alt="" />\n' +
                                '\t</div>';
                            let replase_2_text = '<div class="center_kupiapp">\n' +
                                '\t\t\t<a target="_blank" href="https://vk.com/app6326142_-54415638" class="button_kupiapp">Читать другие отзывы</a>\n' +
                                '\t\t</div> \n';
                            let str_1 = html.replace(replase_text, "");
                            document.getElementById(obj.id).innerHTML = str_1.replace(replase_2_text, "");

                            sliderInit($('#feedback_kupiapp'));
                        }
                    });

                }
                else { console.log('Р‘Р»РѕРє СЃ id "'+obj.id+'" РЅРµ РЅР°Р№РґРµРЅ РЅР° СЃС‚СЂР°РЅРёС†Рµ'); }
            }

        };

        sliderInit = function(slick_container){
            if(!slick_container.hasClass('slick-initialized')) {
                // слайдер
                slick_container.slick({
                    centerMode: true,
                    //centerPadding: '160px',
                    infinite: true,
                    slidesToShow: +feedbackObj.slidesToShow,
                    slidesToScroll: +feedbackObj.slidesToScroll,
                    arrows: !!feedbackObj.arrows_slider,
                    dots: !!feedbackObj.dots_slider,
                    variableWidth: true,
                    speed: +feedbackObj.speed,
                    autoplay: !!feedbackObj.autoplay_slider,
                    autoplaySpeed: +feedbackObj.autoplaySpeed,
                    responsive: [
                        {
                            breakpoint: 1025,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1,
                                initialSlide: 2
                            }
                        },
                        {
                            breakpoint: 750,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1,
                                initialSlide: 1
                            }
                        },
                        {
                            breakpoint: 450,
                            settings: {
                                centerMode: true,
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                initialSlide: 2
                            }
                        },
                        {
                            breakpoint: 320,
                            settings: {
                                centerMode: true,
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                initialSlide: 1
                            }
                        }
                    ]
                });
            }

            //let fff = document.querySelector("#feedback_kupiapp");
            //console.log(fff);
        };

        document.addEventListener("DOMContentLoaded", feedback_vk.init({id:'feedback_vk', gid:feedbackObj.apikey}));
    });
});