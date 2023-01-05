import { createWebHistory, createRouter } from 'vue-router';

import inicio from './components/App.vue';

//proyectos
import proyIndex from './components/proyecto/index.vue';

//usuarios
import indexUser from './components/usuario/indexUsuario.vue';
import usuarioProyecto from './components/usuario/cargarusuarios.vue';

//operaciones
import indexOperacion from './components/operacion/indexOperacion.vue';
import vistaOperacion from './components/operacion/vistaProyectos.vue';

const routes = [
    {
        path: '/proyecto',
        name: 'proyecto',
        component: proyIndex
    },
    {
        path: '/User',
        name: 'usuarios',
        component: indexUser
    },
    {
        path: '/Operaciones',
        name: 'operaciones',
        component: indexOperacion
    },
    {
        path: '/listaProyectos',
        name: 'lista',
        component: vistaOperacion
    },
    {
        path: '/Inicio',
        name: 'inicio',
        component: inicio
    },
    {
        path: '/Proyecto_usuario',
        name: 'Proyecto_usuario',
        component: usuarioProyecto
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;

