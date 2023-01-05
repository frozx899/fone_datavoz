<template>
    <div class="container-main">

    </div>
  </template>
  
  <script>
    import 'vue-good-table-next/dist/vue-good-table-next.css'
    import { VueGoodTable } from 'vue-good-table-next';
    export default {
    name: 'my-component',
    components: {
    VueGoodTable,
    },
    data(){
      return {
        proyecto: {
                id: '',
                nombre: '',
                codigo:'',
                estado:'Activo',
            },
        columns: [
          {
            label: 'ID',
            field: 'id',
          },
          {
            label: 'Nombre',
            field: 'nombre',
          },
          {
            label: 'Código',
            field: 'codigo',
          },
          {
            label: 'Estado',
            field: 'estado',
          },
          {
            label: 'Fecha de creación',
            field: 'createdAt',
          },
          {
            label: 'Opciones',
            field: 'accion',
          },
        ],
        rows: [],
      };
    },
  };
  </script>

<style>
.container-main{
    margin: 40px;
    
}
</style>