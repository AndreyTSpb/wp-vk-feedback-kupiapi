<?php
    $vk_feedback_data = array();

    add_shortcode('vk_reviews','wp_vk_feedback');

    /**
     * Основная функция, к котоой привязывается шорткод
     * Параметры принимает, но их все ровно перебивать будут опции из базы 
     */
    function wp_vk_feedback($content){
        vp_vk_feedback_get_options();
        add_action('wp_footer', 'wp_vk_feedback_add_style' );
        add_action('wp_footer', 'wp_vk_feedback_add_script');

        return '<div id="feedback_vk">'.$content.'</div>';
    }

    /**
     * Получаем опции для плагина
     */
    function vp_vk_feedback_get_options(){
        global $vk_feedback_data;
         /**
         * Array ( 
         *  [wpvkrws_apikey] => 54415638 
         *  [wpvkrws_counts] => 30 
         *  [wpvkrws_qnt_slider] => 1 
         *  [wpvkrws_qnt_slick_slider] => 2 
         *  [wpvkrws_speed_slider] => 100 
         *  [wpvkrws_autoplay_slider] => 1 
         *  [wpvkrws_arrows_slider] => 1 
         * )
         */
        $arr = get_option('wpvkrws_options');
        print_r($arr);
        $vk_feedback_data = array(
            'apikey'           => (isset($arr['wpvkrws_apikey']))?$arr['wpvkrws_apikey']:false, 
            'counts_feedbacks' => (isset($arr['wpvkrws_counts']))?$arr['wpvkrws_counts']:3, 
            'slidesToShow'     => (isset($arr['wpvkrws_qnt_slider']))?$arr['wpvkrws_qnt_slider']:1, 
            'slidesToScroll'   => (isset($arr['wpvkrws_qnt_slick_slider']))?$arr['wpvkrws_qnt_slick_slider']:1, 
            'speed'            => (isset($arr['wpvkrws_speed_slider']))?$arr['wpvkrws_speed_slider']:300, 
            'autoplaySpeed'    => (isset($arr['wpvkrws_autoplay_speed_slider']))?$arr['wpvkrws_autoplay_speed_slider']:300, 
            'autoplay_slider'  => (isset($arr['wpvkrws_autoplay_slider']) AND !empty($arr['wpvkrws_autoplay_slider']))?true:false, 
            'arrows_slider'    => (isset($arr['wpvkrws_arrows_slider']) AND !empty($arr['wpvkrws_arrows_slider']))?true:false,
            'dots_slider'      => (isset($arr['wpvkrws_dots_slider']) AND !empty($arr['wpvkrws_dots_slider']))?true:false,  
        );
    }

    /**
    * зарезервировать и подключить стили
    */
    function wp_vk_feedback_add_style(){
        global $vk_feedback_data;
        /**
         * Если в параметрах передано style => true,
         * то использовать файл с кастомными стилями, иначе базовый файл
         */
        $src = (isset($vk_feedback_data['style']) AND !empty($vk_feedback_data['style'])) ? plugins_url( 'assets/css/vk_feedback_custom.css', __FILE__ ):plugins_url( 'assets/css/vk_feedback_base.css', __FILE__ );
        //exit($src);
        wp_register_style( 'vkFeedbackCss', $src);

        wp_enqueue_style( 'vkFeedbackCss');
    }

    /**
    * Подключение скриптов
    */
    function wp_vk_feedback_add_script(){
        global $vk_feedback_data;

        /**
         * регистрация скриптов
         */
        //wp_register_script( 'yandexMapApi', 'https://api-maps.yandex.ru/2.1/?lang=ru_RU' );
        wp_register_script('vkFeedbackScript', plugins_url( 'assets/js/vk_feedback.js', __FILE__ ));

        
        /**
         * подключение скриптов
         */
        //wp_enqueue_script('yandexMapScript');
        wp_enqueue_script('vkFeedbackScript');
        
        
        /**
         * Параматры для скрипта
         */
        wp_localize_script( 'vkFeedbackScript', 'feedbackObj', $vk_feedback_data );
    }