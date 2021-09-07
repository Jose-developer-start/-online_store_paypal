<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
    <div>
      <p class="app-sidebar__user-name">{{ Auth::user()->name }}</p>
      <p class="app-sidebar__user-designation">Administrador</p>
    </div>
  </div>
  <ul class="app-menu">
    <li><a class="app-menu__item " href="/mystore"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>

    <li class="treeview"><a class="app-menu__item" href="{{ route('product.index') }}"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Productos</span></a>
      
    </li>
    <li class="treeview"><a class="app-menu__item" href="#"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Categoria</span></a>
      
    </li>
  </ul>
</aside>
{{ dd(request()->routeIs("mystore"))}}