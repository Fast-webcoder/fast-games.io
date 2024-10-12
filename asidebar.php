        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3"><?php echo $panelname?> ACP</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="/admin">
                <i class="fas fa-fw fa-home"></i>
                <span>Главная</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">Пользователи</div>
            <li class="nav-item">
                <a class="nav-link" href="/admin?action=users">
                <i class="fas fa-user"></i>
                <span>Управление Пользователями</span></a>
            </li> 
            <li class="nav-item">
                <a class="nav-link" href="/admin?action=invoices">
                <i class="fas fa-wallet"></i>
                <span>Платежи</span></a>
            </li> 
			<hr class="sidebar-divider">
            <div class="sidebar-heading">
                Промо
            </div>
            <li class="nav-item">
                <a class="nav-link" href="/admin?action=promo">
                <i class="fas fa-percent"></i>
                <span>Все Промокоды</span></a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="/admin?action=promoadd">
                <i class="fas fa-plus"></i>
                <span>Создание Промокода</span></a>
            </li>
			<hr class="sidebar-divider">
            <div class="sidebar-heading">
                Новости
            </div>
            <li class="nav-item">
                <a class="nav-link" href="/admin?action=news">
				<i class="fas fa-newspaper"></i>
                <span>Все новости</span></a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="/admin?action=newsadd">
                <i class="fas fa-bullhorn"></i>
                <span>Создание Новости</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Магазин
            </div>
            <li class="nav-item">
                <a class="nav-link" href="/admin?action=shops">
                <i class="fas fa-shopping-basket"></i>
                <span>Управление Товарами</span></a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="/admin?action=shopadd">
                <i class="fas fa-shopping-cart"></i>
                <span>Создание товара</span></a>
            </li>
			<hr class="sidebar-divider">
            <div class="sidebar-heading">
                Покупки
            </div>
            <li class="nav-item">
                <a class="nav-link" href="/admin?action=purchases">
                <i class="fas fa-tags"></i>
                <span>Просмотр покупок</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="sidebar-heading">Другое</div>
            <li class="nav-item">
                <a class="nav-link" href="/admin?action=system">
                    <i class="fas fa-cogs"></i>
                <span>Система</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            <div class="sidebar-card d-none d-lg-flex">
                <p class="text-center mb-2"><?php echo $user['Balance']?> рублей</p>
                <a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#PayModal">Пополнить баланс</a>
            </div>
        </ul>