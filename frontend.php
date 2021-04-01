<?php
    $vk_feedback_data = array();

    add_shortcode('vk_reviews','wp_vk_feedback');

    /**
     * Основная функция, к котоой привязывается шорткод
     * Параметры принимает, но их все ровно перебивать будут опции из базы 
     */
    function wp_vk_feedback($content){
        add_action('wp_footer', 'wp_vk_feedback_add_style' );
        add_action('wp_footer', 'wp_vk_feedback_add_script');
        
        return '<div id="feedback_vk">'.$content.'</div>';
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