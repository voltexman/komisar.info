<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/backend/web/images/avatar.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Максим Комисар</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Материалы', 'options' => ['class' => 'header']],
                    ['label' => 'Статьи', 'icon' => 'file-text-o', 'url' => ['article/index'], 'active' => in_array($this->context->route, ['article/index', 'article/update'])],
                    ['label' => 'Комментарии', 'icon' => 'comment-o', 'url' => ['comment/index'], 'active' => in_array($this->context->route, ['comment/index', 'comment/view'])],
                    ['label' => 'Сообщения', 'icon' => 'envelope-o', 'url' => ['message/index'], 'active' => in_array($this->context->route, ['message/index', 'message/view'])],
                ],
            ]
        ) ?>

    </section>

</aside>
