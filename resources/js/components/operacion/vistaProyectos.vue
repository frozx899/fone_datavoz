<template>
    <div class="container-main">
        <!-- Inicio table -->
        <div class="table_contenido">
            <vue-good-table
                :columns="columns"
                :rows="rows"
                :pagination-options="{
                enabled: true,
                mode: 'records',
                perPageDropdown: [10],
                nextLabel: 'Siguiente',
                prevLabel: 'Anterior',
                rowsPerPageLabel: 'Filas por columna',
                }"
                >
                <template #table-row="props">
                <span v-if="props.column.field == 'estado'">
                    <span class="clactivo_span">                
                        <label class="clactivo" v-if="props.row.estado == 'Abierto'"> {{ props.row.estado }}</label>
                        <label class="clcerrado" v-if="props.row.estado == 'Cerrado'"> {{ props.row.estado }}</label>
                    </span> 
                </span>
                <span class="clactivo_span" v-if="props.column.field == 'accion'">
                    <span style="font-weight: bold; color: blue;">
                        <router-link :to="{path:'Operaciones', query:{sort: props.row.codigo}}" class="btn btn-info">Contactar</router-link>
                    </span> 
                </span>
                </template>
            </vue-good-table>
        </div>
        <!-- fin table -->
    </div>
</template>
<script>
export default {
    data(){
        return{        
        columns: [
            {
            label: 'Nombre',
            field: 'nombre',
            },
            {
            label: 'Estado',
            field: 'estado',
            },
            {
            label: 'Opciones',
            field: 'accion',
            },
        ],
        rows: [],
        user_id: document.querySelector("meta[name='user-id']").getAttribute('content'),
            
        }

    },
    mounted(){
        this.cargarproyectos();
    },
    methods:{
        cargarproyectos(){
            axios.get('/api/proyectoUsuarios/'+this.user_id)
            .then(response=>{
                this.rows = response.data;

            })
            .catch(e=>{
                console.log(e);
            })
        },
    },
    
}

</script>

<style>
.container-main{
    margin: 40px;
    
}
.clcerrado{
  background-color: red;
  color: black;
  border-radius: 20px;
  padding: 5px;
  width: 50%;
  text-align: center;
}
.clactivo{
  background-color: green;
  color: black;
  border-radius: 20px;
  padding: 5px;
  width: 50%;
  text-align: center;
}
.clactivo_span{

    display: flex;
    justify-content: center;

}
</style>
