<div class="category-sidebar">
    <div class="widget category-list">
        <h4 class="widget-header">Principais Categorias</h4>
        <ul class="category-list">

            <?php foreach (categories_adverts(limit: 10) as $categorySidebar) : ?>

                <li><a href="<?php echo route_to('adverts.category', $categorySidebar->slug); ?>"><?php echo $categorySidebar->name; ?> <span><?php echo $categorySidebar->total_adverts; ?></span></a></li>

            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Se temos um category vindo do controller, então exibimos a div-->
    <?php if (isset($category)) : ?>

        <div class="widget category-list">
            <h4 class="widget-header">Cidades</h4>
            <ul class="category-list">

                <!-- o categorySlug está vindo do controller... Não esqueçam disso -->
                <?php foreach (cities_adverts(limit: 5, categorySlug: $category->slug) as $cityAdverts) : ?>

                    <li><a href="<?php echo route_to('adverts.category.city', $category->slug, $cityAdverts->city_slug); ?>"><?php echo $cityAdverts->city(); ?> <span><?php echo $cityAdverts->total_adverts; ?></span></a></li>

                <?php endforeach; ?>

            </ul>
        </div>

    <?php endif; ?>


</div>