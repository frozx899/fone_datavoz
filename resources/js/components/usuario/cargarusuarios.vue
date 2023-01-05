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
                <span v-if="props.column.field == 'accion'">
                    <span style="font-weight: bold; color: blue;">
                        <button class="btn btn-info" @click="abrirModal(props.row.id)">Cargar usuarios</button>
                    </span> 
                </span>
                </template>
            </vue-good-table>
        </div>
        <!-- fin table -->
        

    <!-- The Modal (Crear usuario)-->
    <div class="modal" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Proyecto-Usuarios</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <form @submit.prevent="validacionesuser">
            <!-- Modal body -->
            <div class="modal-body">
              <label for="">Usuarios activos</label>
              <VueMultiselect
                v-model="selected"
                :options="options"
                :multiple="true"
                :close-on-select="false"
                track-by="username"
                label="username">
            </VueMultiselect>       
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="submit" class="btn btn-success" @click="guardarusuarios">Guardar</button>
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!--Fin Modal crear  (Crear usuario)-->

    </div>
</template>

<script>
import VueMultiselect from 'vue-multiselect'

export default {
    components: { VueMultiselect },
    data(){
        return{
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
                label: 'Opciones',
                field: 'accion',
            },
            ],
            rows: [],
            selected: null,
            options: [],
            codigoProyecto: '',
            userProyecto: {
                proyecto_id :'',
                users_id: '',
            }
        
        }              
    },
    mounted (){
        this.cargarProyectos();
    },
    methods:{
        cargarProyectos(){
            axios.get('/api/proyectoActivos')
            .then(response=>{
                this.rows = response.data;
            })
            .catch(e=>{
                console.log(e);
            })
        },
        abrirModal(id){
            this.codigoProyecto= id;
            $('#myModal').modal('show');
            axios.get('/api/usuariosactivos')
            .then(response=>{
                this.options = response.data;
                console.log(response.data);
            }) 
        },
        guardarusuarios()
        {
            console.log(this.selected);
            this.selected.forEach(element => {
                this.userProyecto.proyecto_id = this.codigoProyecto;
                this.userProyecto.users_id = element['username'];
                axios.post('/api/cargarusuarios',this.userProyecto)
                .then(response=>{
                })
                .catch(e=>{
                        console.log(e);
                })
            });
            Toast.fire({icon: 'success',title: 'Se han cargado los usuarios correctamente!'});
            this.selected = null;
            $('#myModal').modal('hide');
        }
    },
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>


