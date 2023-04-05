<?php

/**____________________________________________________________________________________________________________________________
 * Код пишется в header.php. Пишется для того, чтобы на главной странице тег body был пустой, а на всех остальных страницах
 * в тег body добавлялся класс inner. Функция is_front_page(); дает true если мы на главной странице. Но нам нужен обратный
 * эффект.
 * 
 */

?>
<?php $body_class = '';
if (!is_front_page()) {
    $body_class = 'inner';
} ?>

<body class="<?php echo $body_class; ?>"></body>

<?php /**^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ */ ?>





































<?php /**__________________________________________________________________________________________________________________________
 * Код, который убирает админбар. Пишется в функциях в любом месте.*/ ?>
<?php add_filter('show_admin_bar', '__return_false'); ?>
<?php /**^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ */ ?>





































<?php /**______________________________________________________________________________________________________________
 * Выводим меню через цикл */ ?>

<?php

$locations = get_nav_menu_locations();
$menu_id = $locations['menu_footer']; // Где menu_footer это id локации, получено c помощью var_dump();
$menu_items  = wp_get_nav_menu_items(
    $menu_id,
    [
        'order' => 'ASC',
        'orderby' => 'menu_order',
    ]
); ?>

<nav class="main-navigation">
    <ul class="main-navigation__list">
        <?php
        foreach ($menu_items as $item) : ?>

            <li>
                <a href="<?php echo $item->url ?>"><?php echo $item->title; ?></a>
            </li>

        <?php endforeach; ?>
    </ul>
</nav>
<?php /*^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ */ ?>
































<?php /**__________________________________________________________________________________________________________________________________
 * Функция которая возвращает дату в виде "Этот пост был написана 2 недели назад." */ ?>

<?php function return_data_last_public_post()
{
    return sprintf(esc_html__('%s ago', 'textdomain'), human_time_diff(get_the_time('U'), current_time('timestamp')));
}
add_filter('the_time', 'return_data_last_public_post'); ?>
<?php /**^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ */ ?>









































<?php /**_____________________________________________________________________________________________________________________________________________ ?>
<?php * Функции которые возвращают классический вид sidebar */ ?>

<?php

//Возвращает классический вид sidebars
add_filter('gutenberg_use_widgets_block_editor', '__return_false');
add_filter('use_widgets_block_editor', '__return_false');

?>
<?php /**^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ */ ?>













































<?php
/**___________________________________________________________________________________________________________
 * Функция с помощью которой можно получить одну любую запись.
 */
?>
<?php

//Получаем в переменную объект. 21-id поста.
// и выводим изначально заглавие поста,
// содержание поста и данные с acf поля с названием 'price'.
// Так же выводим картинку с acf. Название поля photo.
//
$post = get_post(21);
?>

<!-- Заголовок поста -->
<h1><?php echo $post->post_title; ?></h1>

<!-- Вывод содержимого поста. Первый параметр 'the_content'-->
<?php echo apply_filters('the_content', $post->post_content); ?>

<!-- Вывод acf поля с помощью функции get_post_meta -->
<p>
    <?php echo get_post_meta($post->ID, 'price', true) ?>
</p>

<!-- Вместо get_post_meta можно использовать get_field() или get_fields(). Варианты ниже -->
<?php echo get_field('price', $post->ID); ?>
<?php echo get_fields($post_ID)['price'] ?>

<!-- Вывод картинки с acf поля  -->
<?php $image = get_post_meta($post->ID, 'photo', true); ?>
<?php echo wp_get_attachment_image($image, 'full', false, array()) ?>

<?php /**
 * ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
 * 
 */
?>




































<?php /**______________________________________________________________________________________________________
 * Функция с помощь которой можно получить указанные записи.
 * */ ?>
<!-- Функция возвращает массив объектов -->

<?php
$results = get_posts(array(
    'post_type' => 'houses', //указываем тип поста(по умолчанию post).
    'posts_per_page' => 3, //получаем три записи
    'orderby' => 'title', //вариант сортировки - по заголовку
    'order' => 'ASC', //сама сортировка от меньшего к большему

    // Вариант сортировки
    'meta_key' => 'price', //сортируем по цене в поле acf
    'orderby' => 'meta_value' //
));

// Вывод с помощью цикла foreach. 
// Это пример, который показывает как работать
// за пределами стандартного цикл 

foreach ($results as $post) :
    setup_postdata($post)
?>

    <!-- Вывод заголовка без функции setup_postdata($post) -->
    <h1>
        <?php echo $post->post_title; ?>
    </h1>
    <!-- Вывод заголовка с функцией setup_postdata($post) -->
    <h1>
        <?php the_title(); ?>
    </h1>


    <!-- Вывод контента без функции setup_postdata($post) -->
    <p>
        <?php echo apply_filters('the_content', $post->post_content); ?>
    </p>
    <!-- Вывод контента с функцией setup_postdata($post) -->
    <p>
        <?php the_content(); ?>
    </p>


    <!-- Вывод поля acf без функции setup_postdata($post) -->
    <strong>
        Price: <?php echo get_field('price', $post->ID); ?>
    </strong>
    <!-- Вывод поля acf с функцией setup_postdata($post) -->
    <strong>
        Price: <?php echo the_field('price'); ?>
    </strong>



<?php endforeach;
wp_reset_postdata(); ?>

<?php /** 
 * 
 * ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
 * */ ?>

















































<?php /**____________________________________________________________________________________________________________
 * 
 * Пример сложного запроса WP_Query()
 *  */ ?>

<?php $query = new WP_Query([
    'post_type' => 'houses',
    'posts_per_page' => 3,
    'meta_key' => 'price',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'tax_query' => [
        'relation' => 'AND',
        [
            'taxonomy' => 'type',
            'field' => 'slug',
            'terms' => 'appartments'
        ],
        [
            'taxonomy' => 'method',
            'field' => 'slug',
            'terms' => 'sell'
        ],
        [
            'taxonomy' => 'type',
            'field' => 'slug',
            'terms' => 'new'
        ],
        [
            'taxonomy' => 'status',
            'field' => 'slug',
            'terms' => 'not_in_use',
            'operator' => 'NOT IN'  
        ],
        'meta_query' => [
            [
                'key' => 'price',
                'value' =>  50000,
                'compare' => '<='
            ]
        ]


    ]


]);

if ($query->have_posts()) :
    while ($query->have_posts()) :
        $query->the_post();

?>

        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
        <p>
            Price: <?php the_field('price') ?>
        </p>

<?php endwhile;
    wp_reset_postdata();
endif; ?>

<?php /**
 * 
 * ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
 * 
 *  */ ?>