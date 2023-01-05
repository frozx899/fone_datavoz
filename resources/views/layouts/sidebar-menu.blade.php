<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item has-treeview">
          <a href="/Inicio" class="nav-link" active-class="active" exact>
            <i class="fa fa-users yellow"></i>
            <p>
            &nbsp Inicio 
            </p>
          </a>
        </li>

      @can('isAdmin')
      <li class="nav-item has-treeview">
        <a href="/User" class="nav-link" active-class="active" exact>
          <i class="fa fa-users yellow"></i>
          <p>
          &nbsp Usuarios 
          </p>
        </a>
      </li>
      @endcan

      <li class="nav-item has-treeview">
        <a href="/User" class="nav-link" active-class="active" exact>
          <i class="fa fa-users yellow"></i>
          <p>
          &nbsp Usuarios 
          </p>
        </a>
      </li>
      

      <li class="nav-item has-treeview">
        <a href="/proyecto" class="nav-link" active-class="active" exact>
        <i class="fa-regular fa-folder yellow"></i>
          <p>
          &nbsp Proyectos 
          </p>
        </a>
      </li>

      <li class="nav-item has-treeview">
        <a href="/Proyecto_usuario" class="nav-link" active-class="active" exact>
        <i class="fa-regular fa-folder yellow"></i>
          <p>
          &nbsp Proyectos/Usuarios
          </p>
        </a>
      </li>
      
      <li class="nav-item has-treeview">
        <a href="/listaProyectos" class="nav-link" active-class="active" exact>
          <i class="fa fa-users yellow"></i>
          <p>
          &nbsp Contactar 
          </p>
        </a>
      </li>


      
      <li class="nav-item">
        <a href="#" class="nav-link" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <i class="nav-icon fas fa-power-off red"></i>
          <p>
            {{ __('Logout') }}
          </p>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
    </ul>
  </nav>