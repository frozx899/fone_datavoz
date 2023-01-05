<template>
    <div class="container-main">
    <div class="row">
      <div class="col-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" @click="resetuser">Crear usuario</button>
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
          <span v-if="props.column.field == 'created_at'">
              <span>
                  {{  dateTime(props.row.created_at)  }}
              </span> 
          </span>
          <span v-if="props.column.field == 'accion'">
              <span style="font-weight: bold; color: blue;">
                  <button class="btn btn-info" @click="abrirEditModal(props.row.username)">Editar</button>
              </span> 
              <span style="font-weight: bold; color: blue;">
                  <button class="btn btn-danger tbneliminar" @click="eliminarUsuario(props.row.username)">Eliminar</button>
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
            <h4 class="modal-title">Nuevo Usuario</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <form @submit.prevent="validacionesuser">
            <!-- Modal body -->
            <div class="modal-body">
              <label for="">UserName</label>
              <input type="text" class="form-control"  placeholder="Username" v-model="usuario.username">
              <label for="">Nombre</label>
              <input type="text" class="form-control"  placeholder="Nombre" v-model="usuario.name">
              <label for="">Password</label>
              <input type="text" class="form-control"  placeholder="Password" v-model="usuario.password">
              <label for="">Confirmar password</label>
              <input type="text" class="form-control"  placeholder="confirmar password" v-model="usuario.confirmpasword">
              <label for="">Rol</label>
              <select name="" id="" class="form-control" v-model="usuario.type">
                <option value="admin">admin</option>
                <option value="supervisor">supervisor</option>
                <option value="usuario">usuario</option>
              </select>        
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
    <!--Fin Modal crear  (Crear usuario)-->


    <!-- The Modal (Editar usuario)-->
    <div class="modal" id="myModalEdit">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Nuevo Usuario</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <form @submit.prevent="validacionesuserEdit">
            <!-- Modal body -->
            <div class="modal-body">
              <label for="">UserName</label>
              <input type="text" class="form-control"  placeholder="Username" v-model="usuarioE.username" disabled>
              <label for="">Nombre</label>
              <input type="text" class="form-control"  placeholder="Nombre" v-model="usuarioE.name">
              <label for="">Password</label>
              <input type="password" class="form-control"  placeholder="Password" v-model="usuarioE.password">
              <label for="">Confirmar password</label>
              <input type="password" class="form-control"  placeholder="confirmar password" v-model="usuarioE.confirmpasword">
              <label for="">Rol</label>
              <select name="" id="" class="form-control" v-model="usuarioE.type">
                <option value="admin">admin</option>
                <option value="supervisor">supervisor</option>
                <option value="usuario">usuario</option>
              </select>        
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
    <!--Fin Modal crear  (Editar usuario)-->



  </div>
</template>

<script>
import moment from 'moment';
  export default {
  data(){
    return {
      columns: [
        {
          label: 'ID',
          field: 'id',
        },
        {
          label: 'Username',
          field: 'username',
        },
        {
          label: 'Nombre',
          field: 'name',
        },
        {
          label: 'Rol',
          field: 'type',
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
      usuario:{
        username:'',
        name:'',
        type:'',
        email:'',
        password:'',
        confirmpasword:'',
      },
      usuarioE:{
        id:'',
        username:'',
        name:'',
        type:'',
        email:'',
        password:'',
        confirmpasword:'',
      },
      optionedit :'',
    };
  },
  mounted () {
    this.cargarUsuarios();
  },
  methods: {
    dateTime(value) {
      return moment(value).format('DD-MM-YYYY');
    },
    cargarUsuarios(){
      axios.get('/api/users')
      .then(response=>{
        this.rows = response.data
      })
      .catch(e=>{
        console.log(e);
      })
    },
    crearUsuario(){
      this.usuario.email = this.usuario.username + '@datavoz.cl';
      axios.post('/api/users/', this.usuario)
      .then(response=>{
        Toast.fire({icon: 'success',title: 'Se ha subido correctamente!'});
        $('#myModal').modal('hide');
        this.resetuser();      
        this.cargarUsuarios();

      })
      .catch(e=>{
            console.log(e);
      })
    },
    validacionesuser(){
      if(this.usuario.username == '' || this.usuario.name == '' || this.usuario.type == '' || this.usuario.password == '' || this.usuario.confirmpasword == ''){
        Toast.fire({icon: 'error',title: 'Todos los campos son obligatorios'});
      }
      else{
        if(this.usuario.password == this.usuario.confirmpasword){
          this.crearUsuario();
        }
        else{
          Toast.fire({icon: 'error',title: 'Las password no coinciden'});
        }
      }
    },
    resetuser(){
      this.usuario.username = '';
      this.usuario.name = '';
      this.usuario.type='';
      this.usuario.email= '';
      this.usuario.password= '';
      this.usuario.confirmpasword= '';
    },
    resetuserE(){
      this.usuarioE.id = '';
      this.usuarioE.username = '';
      this.usuarioE.name = '';
      this.usuarioE.type='';
      this.usuarioE.email= '';
      this.usuarioE.password= '';
      this.usuarioE.confirmpasword= '';
    },
    validacionesuserEdit(){
      if(this.usuarioE.username == '' || this.usuarioE.name == '' || this.usuarioE.type == '' || this.usuarioE.password == '' || this.usuarioE.confirmpasword == ''){
        Toast.fire({icon: 'error',title: 'Todos los campos son obligatorios'});
      }
      else{
        if(this.usuarioE.password == this.usuarioE.confirmpasword){
          this.editUsuario();
        }
        else{
          Toast.fire({icon: 'error',title: 'Las password no coinciden'});
        }
      }
    },
    abrirEditModal(id){
      this.optionedit = id
      axios.get('/api/buscarUsuario/'+this.optionedit)
      .then(response =>{
        this.usuarioE.id = response.data[0]['id'];
        this.usuarioE.username = response.data[0]['username'];
        this.usuarioE.name = response.data[0]['name'];
        this.usuarioE.type=response.data[0]['type'];
        this.usuarioE.email= response.data[0]['email'];
        this.usuarioE.password= response.data[0]['password'];
        this.usuarioE.confirmpasword= response.data[0]['password'];
      })
      $('#myModalEdit').modal('show');     
    },
    editUsuario(){
      axios.post('/api/userEdit',this.usuarioE)
        .then(response=>{
        Toast.fire({icon: 'success',title: 'Se ha subido correctamente!'});
        $('#myModalEdit').modal('hide');
        this.cargarUsuarios();
        this.resetuserE();

      })
      .catch(e=>{
            console.log(e);
      })
    },
    eliminarUsuario(id){
      this.optionedit = id
      axios.get('/api/buscarUsuario/'+this.optionedit)
      .then(response =>{
        this.usuarioE.id = response.data[0]['id'];
        this.eliminar();   
      })
    },
    eliminar(){
      Swal.fire({
        title: '¿Seguro que quiere confirmar los contactos? Este cambio es irreversible',
        showCancelButton: true,
        confirmButtonText: 'Continuar',
        }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          axios.delete('/api/users/' + this.usuarioE.id)
          .then(response=>{
            Toast.fire({icon: 'success',title: 'Se ha eliminado correctamente!'});
            this.cargarUsuarios();
          })
          .catch(e=>{
            console.log(e);
          })
        } else if (result.isDenied) {
            Swal.fire('No se realizaron los cambios', '', 'info')
        }
        })
      
    }


  },

};
</script>
<style>
.container-main{
  margin: 40px;  
}
.tbneliminar{
  margin-left: 5px;
}
</style>