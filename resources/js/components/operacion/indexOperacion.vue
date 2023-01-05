<template>
    <div class="container-main">
        <h1>Contacto</h1>
        <div class="row">
            <div class="col-6">
                <label for="">Nombre</label>
                <input type="text" name="nombre" class="form-control" id="nombreCont" disabled v-model="contacto.nombre">
                <br>
                <label for="">Teléfono 1</label>
                <input type="text" name="telefono1" class="form-control" id="telefono1" disabled v-model="contacto.telefono1">
                <br>
                <label for="">Teléfono 2</label>
                <input type="text" name="telefono2" class="form-control" id="telefono2" disabled v-model="contacto.telefono2">
                <br>
                <label for="">Teléfono 3</label>
                <input type="text" name="telefono3" class="form-control" id="telefono3" disabled v-model="contacto.telefono3">

            </div>
            <div class="col-6">
                <label for="">Custom 1</label>
                <input type="text" name="custom1" class="form-control" id="custom1" disabled v-model="contacto.custom1">
                <br>
                <label for="">Custom 2</label>
                <input type="text" name="custom2" class="form-control" id="custom2" disabled v-model="contacto.custom2">
                <br>
                <label for="">Custom 3</label>
                <input type="text" name="custom3" class="form-control" id="custom3" disabled v-model="contacto.custom3">
            </div>
        </div>
        <br>
        <div class="container col-4">
            <a v-bind:href="contacto.link" type="button" class="btn btn-info" target="_blank"> Iniciar Encuesta</a>
        </div>

        <div class="container" style="background-color: #BBEEED; margin-top: 25px;">
            <h1>Incidencias</h1>
            
            <form @submit.prevent="guardarIncidencia">
                <div class="row">
                    <div class="col-4">
                        <label for="">Nueva incidencia</label>
                        <select name="incidenciaProyecto" id="incidenciaProyecto" class="form-control" v-model="nuevaIncidencia.nombre_inidencia">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="">Comentarios</label>
                        <input type="text" class="form-control" placeholder="Detalle" v-model="nuevaIncidencia.detalle">
                    </div>
                    <div class="col-4">
                        <label for="">Nueva incidencia</label>
                        <select name="telefonoInc" id="TelefonoInc" class="form-control" aria-placeholder="Seleccionar" v-model="nuevaIncidencia.telefono">
                            <option value="" disabled>Seleccionar teléfono </option>
                            <option  v-bind:value="contacto.telefono1"> {{ contacto.telefono1 }} </option>
                            <option v-if="contacto.telefono2 != ''" v-bind:value="contacto.telefono2"> {{ contacto.telefono2 }} </option>
                            <option v-if="contacto.telefono3 != ''" v-bind:value="contacto.telefono3"> {{ contacto.telefono3 }} </option>
                        </select>
                    </div>
                    <div class="col-4" style="margin-top: 10px;">
                        <button type="submit" class="btn btn-success">Guardar Incidencia</button>
                    </div>
                </div>
            </form>
            
            <br>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Detalle</th>
                        <th>Teléfono</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="incidencia in incidencias" :key="incidencia.id">
                        <td>{{ incidencia.id }}</td>
                        <td>{{ incidencia.nombre_inidencia }}</td>
                        <td>{{ incidencia.telefono }}</td>
                        <td>{{ incidencia.created_at }}</td>                       
                    </tr>
                </tbody>
            </table>  
        </div>      
    </div>
</template>

<script>

export default ({
    data() {
        return{
            contacto:{
                id:"",
                nombre:"",
                telefono1:"",
                telefono2:"",
                telefono3:"",
                custom1:"",
                custom2:"",
                custom3:"",
                link:""
            },
            incidencias:[],
            nuevaIncidencia:{
                contacto_id:this.$route.params.id,
                nombre_inidencia:"",
                detalle:"",
                telefono:"",              
            },
        }
        
    },
    mounted(){
        this.cargarIncidencias()
        this.cargarContactos()
    },
    methods:{
        async cargarIncidencias(){
            await this.axios.get('/api/cargaInc/' + this.$route.params.id)
            .then(response=>{
                this.incidencias= response.data
            })
            .catch(e=>{
                console.log(e)
                this.incidencias=[]
            })
        },
        async cargarContactos(){
            await this.axios.get(`/api/contacto/${this.$route.params.id}`)
            .then(response=>{
                const{id,nombre,telefono1,telefono2,telefono3,custom1,custom2,custom3,link} = response.data
                this.contacto.id = id
                this.contacto.nombre = nombre
                this.contacto.telefono1 = telefono1
                this.contacto.telefono2 = telefono2
                this.contacto.telefono3 = telefono3
                this.contacto.custom1 = custom1
                this.contacto.custom2 = custom2
                this.contacto.custom3 = custom3
                this.contacto.link = link
            })
            .catch(e=>{
                console.log(e)
            })
        },
        async guardarIncidencia(){
            var detalleProyec = this.$route.params.proyecto
            await this.axios.post('/api/incContacto', this.nuevaIncidencia)
            .then(resposne=>{
                alert("Proyecto creado correctamente")
                console.log(detalleProyec)
                this.$router.push({name:"ContactoSelect", params:{id:detalleProyec}})
            })
            .catch(e=>{
                console.log(e)
            })
        }
    }
})
</script>

<style>
.container-main{
    margin: 40px;
    
}
</style>