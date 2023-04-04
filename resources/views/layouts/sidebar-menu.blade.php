<nav class="mt-2" style="font-size:14px; color:#c3bb10!important;">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item has-treeview">
          <a href="/Inicio" class="nav-link" active-class="active" exact>
            <i class="fa-solid fa-house yellow"></i>

            <p>
            &nbsp Inicio 
            </p>
          </a>
        </li>
        @if (  Auth::user()->type  == "admin")
      <li class="nav-item has-treeview">
        <a href="/User" class="nav-link" active-class="active" exact>
        <i class="fa-solid fa-user-plus yellow"></i>
          <p>
          &nbsp Usuarios 
          </p>
        </a>
      </li>
      @endif
      @if (  Auth::user()->type  == "admin" || Auth::user()->type  == "supervisor")
      <li class="nav-item has-treeview">
        <a href="/proyecto" class="nav-link" active-class="active" exact>
        <i class="fa-solid fa-folder yellow"></i>
          <p>
          &nbsp Administración de proyectos
          </p>
        </a>
      </li>

      <li class="nav-item has-treeview">
        <a href="/Proyecto_usuario" class="nav-link" active-class="active" exact>
        <i class="fa-solid fa-users-gear yellow"></i>
          <p>
          &nbsp Cargar usuarios a proyecto
          </p>
        </a>
      </li>
      @endif
      @if (  Auth::user()->type  == "admin")
      <li class="nav-item has-treeview">
        <a href="/Proyecto_contacto" class="nav-link" active-class="active" exact>
        <i class="fa-solid fa-address-book yellow"></i>
          <p>
          &nbsp Cargar contactos
          </p>
        </a>
      </li>
      @endif
      <li class="nav-item has-treeview">
        <a href="/listaProyectos" class="nav-link" active-class="active" exact>
          <i class="fa-sharp fa-solid fa-phone yellow"></i>
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
            {{ __('Salir') }}
          </p>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
    </ul>
  </nav>