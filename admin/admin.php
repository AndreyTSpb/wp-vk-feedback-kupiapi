<?php
/**
 * Добавления страницы настроек плагина в опциях
 */
add_action('admin_menu', 'wpvkrws_add_option_page');
function wpvkrws_add_option_page(){
    add_options_page( 
        'VK_FeedBack', 
        'VK_FeedBack', 
        'manage_options', 
        'wpvkrws_options', 
        'wpvkrws_option_page' 
    );
}


/**
 *  Функции, которая отвечает за код страницы этого пункта меню
 */
function wpvkrws_option_page(){
    echo '<div class="wrap">';
    screen_icon();                                    
    echo '<form id="wpvkrws_options" action="options.php" method="post" enctype="multipart/form-data">'; 
    do_settings_sections('wpvkrws_options');		//вывод блоков с полями формы для page (page из add_settings_section)               
    settings_fields('wpvkrws_options');	//выводит на экран скрытые поля input (группа опций из register_setting)                 
    submit_button();                                  
    echo '</form>';
    echo '</div>';
}

/* регистрация настроек в системе */
function wpvkrws_settings_init() {

    register_setting(
        'wpvkrws_options',			    //группа опций (уникальное имя) используется в атрибуте name поля поля в форме ввода данных.
        'wpvkrws_options',			    //под каким названием группа опций хранится в БД
        'wpvkrws_options_sanitize',	    //функция проверки введенных данных данных
        'wpvkrws_options'				//page
    );

    /**
     * Описание
     */
    add_settings_section(
        'wpvkrws_options',				//section id
        'Основные настройки для использования плагина.',		//title
        'wpvkrws_options_desc',		//function
        'wpvkrws_options'				//page
    );

    /**
     * Ключ для подключения отзывов
     */
    add_settings_field(
        'wpvkrws_apikey_template', 		//id (равен id поля в форме ввода данных)
        'API KEY для feedback KupiAPP',		//title
        'wpvkrws_apikey_field',			//функция вывода поля формы
        'wpvkrws_options',				//page
        'wpvkrws_options'				//section id в которую добавляем поле
    );

    /**
     * Количество подгружаемых отзывов
     */
    add_settings_field(
        'wpvkrws_counts_template',
        'Количество подгружаемых отзывов (число):',		
        'wpvkrws_counts_field',
        'wpvkrws_options',
        'wpvkrws_options'
    );

    /**
     * Настройки самого слайдера
     */
    add_settings_section(
        'wpvkrws_slider_options',				//section id
        'Настройки для слайдера.',		//title
        'wpvkrws_slider_options_desc',		//function
        'wpvkrws_options'				//page
    );
    /**
     * Кол-во отображаемы слайдов на странице
     */
    add_settings_field(
        'wpvkrws_qnt_slider_template',
        'Кол-во отображаемых слайдов:',		
        'wpvkrws_qnt_slider_field',
        'wpvkrws_options',
        'wpvkrws_slider_options'
    );
    /**
     * Кол-во прокручиваемых слайдов за раз
     */
    add_settings_field(
        'wpvkrws_qnt_slick_slider_template',
        'Кол-во прокручиваемых слайдов за раз:',		
        'wpvkrws_qnt_slick_slider_field',
        'wpvkrws_options',
        'wpvkrws_slider_options'
    );
    /**
     * Скорость анимации в милесекундах
     */
    add_settings_field(
        'wpvkrws_speed_slider_template',
        'Скорость анимации (в милесекундах):',		
        'wpvkrws_speed_slider_field',
        'wpvkrws_options',
        'wpvkrws_slider_options'
    );
    /**
     * Скорость прокрутки в милесекундах
     */
    add_settings_field(
        'wpvkrws_autoplay_speed_slider_template',
        'Скорость автоматической прокрутки (в милесекундах):',		
        'wpvkrws_autoplay_speed_slider_field',
        'wpvkrws_options',
        'wpvkrws_slider_options'
    );
    /**
     * Включить автопрокрутку autoplay
     */
    add_settings_field(
        'wpvkrws_autoplay_slider_template',
        'Включить автопрокрутку:',		
        'wpvkrws_autoplay_slider_check',
        'wpvkrws_options',
        'wpvkrws_slider_options'
    );
    /**
     * arrows
     */
    add_settings_field(
        'wpvkrws_arrows_slider_template',
        'Включить стрелки навигации:',		
        'wpvkrws_arrows_slider_check',
        'wpvkrws_options',
        'wpvkrws_slider_options'
    );
    /**
     * dots
     */
    add_settings_field(
        'wpvkrws_dots_slider_template',
        'Включить точки навигации:',		
        'wpvkrws_dots_slider_check',
        'wpvkrws_options',
        'wpvkrws_slider_options'
    );
}

add_action('admin_init', 'wpvkrws_settings_init');

/* описание */
function wpvkrws_options_desc() {
    echo "<p>На данной странице перечислены основные настройки для плагина, они используются для получения отзывов со страницы в ВК.</p>";
}

function wpvkrws_slider_options_desc() {
    echo "<p>Настройки работы слайдера</p>";
}

/**
 * поле для ввода API KEY 
 */
function wpvkrws_apikey_field(){
    $options = get_option('wpvkrws_options');
    $showApiKey = (isset($options['wpvkrws_apikey'])) ? 'value='.$options['wpvkrws_apikey'] : "placeholder = 'УКАЖИТЕ СВОЙ КЛЮЧ...'";
    echo '<input type="text" id="wpvkrws_apikey_template" name="wpvkrws_options[wpvkrws_apikey]"'.$showApiKey.'>';
}

/**
 * Поле для ввода количество подгружаемых отзывов
 */
function wpvkrws_counts_field(){
    $options = get_option('wpvkrws_options');
    $showCoords = (isset($options['wpvkrws_counts'])) ? 'value='.$options['wpvkrws_counts'] : "placeholder = 'кол-во отзывов'";
    echo '<input type="text" id="wpvkrws_counts_template" name="wpvkrws_options[wpvkrws_counts]"'.$showCoords.'>';
}

/**
 * Поле для ввода кол-во отображаемых слайдов
 */
function wpvkrws_qnt_slider_field(){
    $options = get_option('wpvkrws_options');
    $showCoords = (isset($options['wpvkrws_qnt_slider'])) ? 'value='.$options['wpvkrws_qnt_slider'] : "placeholder = 'кол-во отображаемых слайдов'";
    echo '<input type="text" id="wpvkrws_qnt_slider_template" name="wpvkrws_options[wpvkrws_qnt_slider]"'.$showCoords.'>';
}

/**
 * Поле для ввода скорости прокрутки слайдов
 */
function wpvkrws_speed_slider_field(){
    $options = get_option('wpvkrws_options');
    $showCoords = (isset($options['wpvkrws_speed_slider'])) ? 'value='.$options['wpvkrws_speed_slider'] : "placeholder = 'кол-во скорости прокрутки слайдов'";
    echo '<input type="text" id="wpvkrws_speed_slider_template" name="wpvkrws_options[wpvkrws_speed_slider]"'.$showCoords.'>';
}

/**
 * Поле для ввода скорости прокрутки слайдов
 */
function wpvkrws_qnt_slick_slider_field(){
    $options = get_option('wpvkrws_options');
    $showCoords = (isset($options['wpvkrws_qnt_slick_slider'])) ? 'value='.$options['wpvkrws_qnt_slick_slider'] : "placeholder = ''";
    echo '<input type="text" id="wpvkrws_qnt_slick_slider_template" name="wpvkrws_options[wpvkrws_qnt_slick_slider]"'.$showCoords.'>';
}

/**
 * Поле для ввода скорости прокрутки слайдов
 */
function wpvkrws_autoplay_slider_check(){
    $options = get_option('wpvkrws_options');
    $showCoords = (isset($options['wpvkrws_autoplay_slider']) AND !empty($options['wpvkrws_autoplay_slider'])) ? ' checked' : "";
    echo '<input type="checkbox" id="wpvkrws_autoplay_slider_template" name="wpvkrws_options[wpvkrws_autoplay_slider]" value = "1" '.$showCoords.'>';
}

/**
 * Поле для ввода скорости прокрутки слайдов
 */
function wpvkrws_arrows_slider_check(){
    $options = get_option('wpvkrws_options');
    $showCoords = (isset($options['wpvkrws_arrows_slider']) AND !empty($options['wpvkrws_arrows_slider'])) ? ' checked' : "";
    echo '<input type="checkbox" id="wpvkrws_arrows_slider_template" name="wpvkrws_options[wpvkrws_arrows_slider]" value = "1" '.$showCoords.'>';
}

/**
 * Поле для ввода скорости прокрутки слайдов
 */
function wpvkrws_dots_slider_check(){
    $options = get_option('wpvkrws_options');
    $showCoords = (isset($options['wpvkrws_dots_slider']) AND !empty($options['wpvkrws_dots_slider'])) ? ' checked' : "";
    echo '<input type="checkbox" id="wpvkrws_dots_slider_template" name="wpvkrws_options[wpvkrws_dots_slider]" value = "1" '.$showCoords.'>';
}
/**
 * autoplay_speed
 */
function wpvkrws_autoplay_speed_slider_field(){
    $options = get_option('wpvkrws_options');
    $showCoords = (isset($options['wpvkrws_autoplay_speed_slider'])) ? 'value='.$options['wpvkrws_autoplay_speed_slider'] : "placeholder = ''";
    echo '<input type="text" id="wpvkrws_autoplay_speed_slider_template" name="wpvkrws_options[wpvkrws_autoplay_speed_slider]"'.$showCoords.'>';
}
/**
 * Валидация введенных данных
 */
function wpvkrws_options_sanitize($options){
    /*
    Array ( 
        [wpyma_apikey] => evefefevhr 
        [wpyma_slug_size] => 40,40 
        [wpyma_coords_center] => 30.4545,54.5555 
        ) 
    $_POST    
    Array ( 
        [wpyma_options] => Array ( 
            [wpyma_apikey] => evefefevhr 
            [wpyma_slug_size] => 40,40 
            [wpyma_coords_center] => 30.4545,54.5555 
            ) 
        [option_page] => wpyma_options 
        [action] => update 
        [_wpnonce] => 4424296da6 
        [_wp_http_referer] => /wp-admin/admin.php?page=wpyma_options 
        [submit] => Сохранить изменения 
        )
    $_FILES 
    Array (
        [wpyma_slug] => Array
                (
                    [name] => map-marker-red.png
                    [type] => image/png
                    [tmp_name] => /Applications/MAMP/tmp/php/php7IGVU8
                    [error] => 0
                    [size] => 24922
                )
        )
    // */
    // echo "<pre>";
    // print_r($options);
    // print_r($_FILES);
    // print_r($_POST);
    // echo "</pre>";
    // exit;
    // if( !empty($_FILES['wpyma_slug']['tmp_name']) ){
    //     $overrides = array('test_form' => false);
    //     $file = wp_handle_upload( $_FILES['wpyma_slug'], $overrides );
    //     $options['file'] = $file['url'];
    // }else{
    //     $old_oprions = get_option( 'wpyma_options' );
    //     $options['file'] = $old_oprions['file'];
    // }

    $clean_options = array();
    foreach($options as $k => $v){
        $clean_options[$k] = strip_tags($v);
    }
    return $clean_options;
}