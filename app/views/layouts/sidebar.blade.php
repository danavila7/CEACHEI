<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("img/avatar-default.jpeg") }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->nombre }}</p>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            @if(Entrust::hasRole('recepcion'))
                <li class="header">Recepcíon</li>
                <li class="">
                    <a href="{{ url('admin/home') }}"><span>Home</span></a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <span>Usuarios</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="">
                            <a href="{{ url('admin/alumnos/lista') }}" class="" alt="Usuarios"><i class="fa fa-users"></i><span>Alumnos</span></a>
                        </li>
                        <li class="">
                            <a href="{{ url('admin/alumnos/lista/1') }}" class="" alt="Usuarios"><i class="fa fa-user"></i><span>Alumnos Activos</span></a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <span>Contabilidad</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="">
                            <a href="{{ url('admin/gastosacma') }}" class="" alt="Gastos"><i class="fa fa-hand-o-right"></i><span>Gastos</span></a>
                        </li>
                        <li class="">
                            <a href="{{ url('admin/ListaIngresosAcma') }}" class="" alt="Ingresos"><i class="fa fa-hand-o-left"></i><span>Ingresos</span></a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <span>Escuela</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="">
                            <a href="{{ url('admin/matriculas/lista') }}" class="" alt="Matricula"><i class="fa fa-file-o"></i><span>Matricula</span></a>
                        </li>
                        <li class="">
                            <a href="{{ url('admin/planes') }}" class="" alt="Planes"><i class="fa fa-file-text-o"></i><span>Planes</span></a>
                        </li>
                        <li class="">
                            <a href="{{ url('admin/ListaLabores') }}" class="" alt="Labores"><i class="fa fa-check-square-o"></i><span>Labores</span></a>
                        </li>
                        <li class="">
                            <a href="{{ url('admin/AllHorario') }}" class="" alt="Horarios"><i class="fa fa-table"></i><span>Horarios</span></a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(Entrust::hasRole('instructores'))
                <li class="header">Instructor</li>
                <li class="">
                    <a href="{{ url('admin/home') }}"><span>Home</span></a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <span>Evaluaciones</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="">
                            <a href="{{ url('admin/ListaExamenes') }}" class="" alt="Examenes"><i class="fa fa-file"></i><span>Examenes</span></a>
                        </li>
                        <li class="">
                            <a href="{{ url('admin/ListaEvaluaciones') }}" class="" alt="Usuarios"><i class="fa fa-file-text"></i><span>Evaluaciones</span></a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="{{ url('admin/alumnos/lista/1') }}" class="" alt="Usuarios"><i class="fa fa-users"></i><span>Alumnos</span></a>
                </li>
                <li class="">
                    <a href="{{ url('admin/ListaLaboresUser') }}/{{ Auth::user()->id }}" class="" alt="Labores"><i class="fa fa-check-square-o"></i><span>Labores</span></a>
                </li>
            @endif
            @if(Entrust::hasRole('administracion'))
                <li class="header">Administración</li>
                <li class="">
                    <a href="{{ url('admin/home') }}"><span>Home</span></a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <span>Usuarios</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="">
                            <a href="{{ url('admin/alumnos/lista') }}" class="" alt="Usuarios"><i class="fa fa-users"></i><span>Alumnos</span></a>
                        </li>
                        <li class="">
                            <a href="{{ url('admin/alumnos/lista/1') }}" class="" alt="Usuarios"><i class="fa fa-user"></i><span>Alumnos Activos</span></a>
                        </li>
                        <li class="">
                            <a href="{{ url('admin/instructores/lista') }}" class="" alt="Usuarios"><i class="fa fa-graduation-cap"></i><span>Instructores</span></a>
                        </li>
                        <li class="">
                            <a href="{{ url('admin/ListaUsuarios/administracion') }}" class="" alt="Usuarios"><i class="fa fa-university"></i><span>Administración</span></a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <span>Evaluaciones</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="">
                            <a href="{{ url('admin/ListaExamenes') }}" class="" alt="Examenes"><i class="fa fa-file"></i><span>Examenes</span></a>
                        </li>
                        <li class="">
                            <a href="{{ url('admin/ListaEvaluaciones') }}" class="" alt="Evaluaciones"><i class="fa fa-file-text"></i><span>Evaluaciones</span></a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <span>Contabilidad</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="">
                            <a href="{{ url('admin/ListaOpex') }}" class="" alt="Gastos"><i class="fa fa-money"></i><span>Opex</span></a>
                        </li>
                        <li class="">
                            <a href="{{ url('admin/ListaCapex') }}" class="" alt="Gastos"><i class="fa fa-money"></i><span>Capex</span></a>
                        </li>
                        <li class="">
                            <a href="{{ url('admin/gastosacma') }}" class="" alt="Gastos"><i class="fa fa-hand-o-right"></i><span>Gastos</span></a>
                        </li>
                        <li class="">
                            <a href="{{ url('admin/ListaIngresosAcma') }}" class="" alt="Ingresos"><i class="fa fa-hand-o-left"></i><span>Ingresos</span></a>
                        </li>
                        <li class="">
                            <a href="{{ url('admin/infofinanciero') }}" class="" alt="Informe Financiero"><i class="fa fa-line-chart"></i><span>Informe Financiero</span></a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <span>Escuela</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="">
                            <a href="{{ url('admin/matriculas/lista') }}" class="" alt="Matricula"><i class="fa fa-file-o"></i><span>Matricula</span></a>
                        </li>
                        <li class="">
                            <a href="{{ url('admin/planes') }}" class="" alt="Planes"><i class="fa fa-file-text-o"></i><span>Planes</span></a>
                        </li>
                        <li class="">
                            <a href="{{ url('admin/ListaLabores') }}" class="" alt="Labores"><i class="fa fa-check-square-o"></i><span>Labores</span></a>
                        </li>
                        <li class="">
                            <a href="{{ url('admin/AllHorario') }}" class="" alt="Horarios"><i class="fa fa-table"></i><span>Horarios</span></a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(Entrust::hasRole('inventario'))
                <li class="header">Inventario</li>
                <li class="">
                    <a href="{{ url('admin/home') }}"><span>Home</span></a>
                </li>
                 <li class="">
                    <a href="{{ url('admin/alumnos/lista/1') }}" class="" alt="Usuarios"><i class="fa fa-users"></i><span>Sucursales</span></a>
                </li>
                <li class="">
                    <a href="{{ url('admin/alumnos/lista/1') }}" class="" alt="Usuarios"><i class="fa fa-users"></i><span>Proveedores</span></a>
                </li>
                <li class="">
                    <a href="{{ url('admin/alumnos/lista/1') }}" class="" alt="Usuarios"><i class="fa fa-users"></i><span>Productos</span></a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <span>Flujo Productos</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="">
                            <a href="{{ url('admin/ListaExamenes') }}" class="" alt="Examenes"><i class="fa fa-file"></i><span>Ingresos</span></a>
                        </li>
                        <li class="">
                            <a href="{{ url('admin/ListaEvaluaciones') }}" class="" alt="Usuarios"><i class="fa fa-file-text"></i><span>Salidas</span></a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <span>Informes</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="">
                            <a href="{{ url('admin/ListaExamenes') }}" class="" alt="Examenes"><i class="fa fa-file"></i><span>Ingresos/Salidas</span></a>
                        </li>
                        <li class="">
                            <a href="{{ url('admin/ListaEvaluaciones') }}" class="" alt="Usuarios"><i class="fa fa-file-text"></i><span>Salidas</span></a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>