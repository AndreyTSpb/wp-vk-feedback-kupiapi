window.addEventListener("DOMContentLoaded", function(){
    /**
     * jQuery(function($) {}); добавлено для избежания конфликта
     */
    jQuery(function($) {
        let feedback_vk = {
            idBox: 'feedback_kupiapp',
            gid: '1',
            count: '8',
            style: 'standart',
            url_wiget: 'https://feedbackcloud.kupiapp.ru/widget/widget.php',
            init: function(obj) {
                if (!obj.id) { obj.id = this.idBox; }
                if (!obj.gid) { obj.gid = this.gid; }
                if (!obj.count) { obj.count = this.count; }

                switch (obj.style) {
                    case 'standart':
                        obj.style = this.style;
                        break;
                    default:
                        obj.style = this.style;
                }

                if (document.getElementById(obj.id)) {
                    //this.addStyle(obj); //отключил подключения стилей через скрипт
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
            },
            addStyle: function(obj) {
                /**
                 * Выбор файла стилей, 
                 * наверно надо отключить это, 
                 * так как проще файл стиля подключеть через штатную функцию wordpress
                 */
                switch (obj.style) {
                    case 'standart':
                        var url_style = '../css/vk_feedback_base.css';
                        break;
                    case 'custom':
                        var url_style = '../css/vk_feedback_custom.css';
                }
                style = document.createElement('link');
                style.rel = 'stylesheet';
                style.type = 'text/css';
                style.href = url_style;
                document.head.appendChild(style);
            },

        };

        sliderInit = function(slick_container){
            if(!slick_container.hasClass('slick-initialized')) {
                // слайдер
                slick_container.slick({
                    centerMode: true,
                    //centerPadding: '160px',
                    infinite: true,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    //arrows: false,
                    variableWidth: true,
                    speed: 300,
                    autoplay: true,
                    autoplaySpeed: 2000,
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
            };
            let fff = document.querySelector("#feedback_kupiapp");
            console.log(fff);
        };

        document.addEventListener("DOMContentLoaded", feedback_vk.init({id:'feedback_vk', gid:54415638}));
    });
});