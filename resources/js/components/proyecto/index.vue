<template>
  <div class="container-main">
    <div class="row">
      <div class="col-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Crear nuevo proyecto</button>
      </div>
    </div>

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
        :search-options="{
          enabled: true,
          trigger: 'enter',
          placeholder: 'Busqueda...',       
        }">
        <template #table-row="props">
          <span v-if="props.column.field == 'estado'">
              <span>                
                  <label class="clactivo" v-if="props.row.estado == 'Abierto'"> {{ props.row.estado }}</label>
                  <label class="clcerrado" v-if="props.row.estado == 'Cerrado'"> {{ props.row.estado }}</label>
              </span> 
          </span>
          <span v-if="props.column.field == 'created_at'">
              <span>
                  {{  dateTime(props.row.created_at)  }}
              </span> 
          </span>
          <span v-if="props.column.field == 'accion'">
              <span style="font-weight: bold; color: blue;">
                  <button class="btn btn-danger" @click="abrirEditModal(props.row.id , props.row.estado)">Cambiar estado</button>
              </span> 
          </span>
        </template>
      </vue-good-table>
    </div>
    <!-- fin table -->

    <!-- The Modal -->
    <div class="modal" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Nuevo proyecto</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <form @submit.prevent="valirDatosProyecto">
            <!-- Modal body -->
            <div class="modal-body">
              <label for="">Nombre proyecto</label>
              <input type="text" class="form-control" id="proyectonombre" placeholder="Nombre proyecto" v-model="proyecto.nombre">
              <label for="">Código</label>
              <input type="text" class="form-control" id="proyectocodigo" placeholder="Código proyecto" v-model="proyecto.codigo">
          
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="submit" class="btn btn-success" >Guardar</button>
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!--Fin Modal crear -->

        <!-- The Modal Editar -->
    <div class="modal" id="myModalEdit">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Cambiar estado</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <form @submit.prevent="guardarEditModal">
            <!-- Modal body -->
            <div class="modal-body">
              <select name="" id="" v-model="editproyecto.estado" class="form-control">
                <option value="Abierto">Abierto</option>
                <option value="Cerrado">Cerrado</option>
              </select>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Cambiar</button>
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!--Fin Modal editar -->
  </div>
</template>

<script>
import moment from 'moment';
  export default {
  data(){
    return {
      proyecto: {
        nombre: '',
        codigo:'',
        estado:'',
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
          field: 'created_at',
        },
        {
          label: 'Opciones',
          field: 'accion',
        },
      ],
      rows: [],
      resultado : 0,
      editproyecto:{
        id:'',
        estado:'',
      }
    };
  },
  mounted () {
    this.cargarProyectos();
  },
  methods: {
    cargarProyectos(){
      axios.get('/api/proyectos')
      .then(response =>{
        this.rows = response.data;
      })
      .catch(e=>{
        console.log(e)
      })
    },
    valirDatosProyecto(){
      if(this.proyecto.nombre == '' || this.proyecto.codigo ==''){
        Toast.fire({icon: 'error',title: 'Todos los campos son obligatorios'});
      }
      else{
        axios.get('/api/codigoExistente/' + this.proyecto.codigo)
        .then(response =>{      
          this.resultado = response.data
          this.saveproyect();
        })
        .catch(e=>{
          console.log(e)
        })
      }

    },
    dateTime(value) {
      return moment(value).format('DD-MM-YYYY');
    },
    saveproyect(){
      this.proyecto.estado = 'Abierto';
      if(this.resultado == 1){
        axios.post('/api/proyectos/', this.proyecto)
          .then(response=>{
            Toast.fire({icon: 'success',title: 'Se ha subido correctamente!'});
            $('#myModal').modal('hide');
            this.resetForm();
            this.cargarProyectos();
          })
          .catch(e=>{
            console.log(e);
          })
      }
      else{
        Toast.fire({icon: 'error',title: 'El código ingresado ya existe en sistema'});
      }
    },
    resetForm(){
      this.proyecto.codigo ='';
      this.proyecto.nombre ='';
      this.proyecto.estado ='';
    },
    abrirEditModal(id , estado){
      this.editproyecto.id = id;
      this.editproyecto.estado = estado;
      $('#myModalEdit').modal('show');     
    },
    guardarEditModal(){
      axios.post('/api/editEstadoProy/', this.editproyecto)
      .then(response=>{
        Toast.fire({icon: 'success',title: 'Se ha modificado el estado'});
        $('#myModalEdit').modal('hide');
        this.cargarProyectos();  
      })
      .catch(e=>{
        console.log(e);
      })
    },
  },

};
</script>

<style>
.container-main{
  margin: 40px;
  
}
.table_contenido{
  margin-top: 15px;
}
.clcerrado{
  background-color: red;
  color: black;
  border-radius: 20px;
  padding: 5px;
}
.clactivo{
  background-color: green;
  color: black;
  border-radius: 20px;
  padding: 5px;
}
</style>