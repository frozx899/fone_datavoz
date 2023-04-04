<template>
    <div class="container-main">
        <button class="btn btn-info btncontacto"  @click="nuevoContacto">Nuevo contacto</button>
        <h1>Contacto</h1>
        
        <div class="">
            <div class="">
                <label for="">Nombre</label>
                <input type="text" name="nombre" class="form-control"  disabled v-model="contacto.nombre">              
                <label for="">Sexo</label>
                <input type="text" name="telefono1" class="form-control" disabled v-model="contacto.sexo">              
                <label for="">Pais</label>
                <input type="text" name="telefono2" class="form-control" disabled v-model="contacto.pais">             
                <label for="">Programa</label>
                <input type="text" name="telefono3" class="form-control" disabled v-model="contacto.programa">
                <label for="">Tipo de programa</label>
                <input type="text" name="telefono3" class="form-control" disabled v-model="contacto.tipo">
            </div>
            <div class="row tworow"> 
                <div class="col-4">
                    <label for="">Teléfono 1</label>
                    <input type="text" name="custom1" class="form-control" disabled v-model="contacto.telefono1">
                    <label v-if="contacto.estadotelefono2 == 1" for="">Teléfono 2</label>
                    <input v-if="contacto.estadotelefono2 == 1" type="text" name="custom2" class="form-control" disabled v-model="contacto.telefono2">
                    <label v-if="contacto.estadotelefono3 == 1" for="">Teléfono 3</label>
                    <input v-if="contacto.estadotelefono3 == 1" type="text" name="custom3" class="form-control" disabled v-model="contacto.telefono3">
                    <label v-if="contacto.estadotelefono4 == 1" for="">Teléfono 4</label>
                    <input v-if="contacto.estadotelefono4 == 1" type="text" name="custom3" class="form-control" disabled v-model="contacto.telefono4">
                    <label v-if="contacto.estadotelefono5 == 1" for="">Teléfono 5</label>
                    <input v-if="contacto.estadotelefono5 == 1" type="text" name="custom3" class="form-control" disabled v-model="contacto.telefono5">
                </div>
                <div class="col-4">
                    <label for="">Código de disposición final</label>
                    <select name="" id="" class="form-control" v-model="contacto.incidencia1">
                        <option value="" selected>Seleccionar incidencia</option>
                        <option v-for="inci in incidencias" v-bind:key="inci.nombre" v-bind:value="inci.value"> {{ inci.nombre }}</option>
                    </select>
                    
                    <select v-if="contacto.estadotelefono2 == 1" name="" id="" class="form-control selectinci" v-model="contacto.incidencia2">
                        <option value="" selected>Seleccionar incidencia</option>
                        <option v-for="inci in incidencias" v-bind:key="inci.nombre" v-bind:value="inci.value"> {{ inci.nombre }}</option>
                    </select>
                    
                    <select v-if="contacto.estadotelefono3 == 1" name="" id="" class="form-control selectinci" v-model="contacto.incidencia3">
                        <option value="" selected>Seleccionar incidencia</option>
                        <option v-for="inci in incidencias" v-bind:key="inci.nombre" v-bind:value="inci.value"> {{ inci.nombre }}</option>
                    </select>
                    
                    <select v-if="contacto.estadotelefono4 == 1" name="" id="" class="form-control selectinci" v-model="contacto.incidencia4">
                        <option value="" selected>Seleccionar incidencia</option>
                        <option v-for="inci in incidencias" v-bind:key="inci.nombre" v-bind:value="inci.value"> {{ inci.nombre }}</option>
                    </select>
                    
                    <select v-if="contacto.estadotelefono5 == 1" name="" id="" class="form-control selectinci" v-model="contacto.incidencia5">
                        <option value="" selected>Seleccionar incidencia</option>
                        <option v-for="inci in incidencias" v-bind:key="inci.nombre" v-bind:value="inci.value"> {{ inci.nombre }}</option>
                    </select>
                </div>
                <div class="col-2">           
                    <a href="#" id="iniEncuesta" type="button"  target="_blank" class="btn btn-info btninci" @click="btnInicioEncuesta">Iniciar encuesta</a>
                    <a href="{{}}" type="button"  target="_blank" v-if="contacto.estadotelefono2 == 1" class="btn btn-info btninci" @click="btnInicioEncuesta">Iniciar encuesta</a>
                    <a href="{{}}" type="button"  target="_blank" v-if="contacto.estadotelefono3 == 1" class="btn btn-info btninci" @click="btnInicioEncuesta">Iniciar encuesta</a>
                    <a href="{{}}" type="button"  target="_blank" v-if="contacto.estadotelefono4 == 1" class="btn btn-info btninci" @click="btnInicioEncuesta">Iniciar encuesta</a>
                    <a href="{{}}" type="button"  target="_blank" v-if="contacto.estadotelefono5 == 1" class="btn btn-info btninci" @click="btnInicioEncuesta">Iniciar encuesta</a>
                </div>
                
                <div class="col-2">           
                    <button class="btn btn-success btninci" @click="gIncidencia1">Guardar incidencia</button>
                    <button v-if="contacto.estadotelefono2 == 1" class="btn btn-success btninci" @click="gIncidencia2">Guardar incidencia</button>
                    <button v-if="contacto.estadotelefono3 == 1" class="btn btn-success btninci" @click="gIncidencia3">Guardar incidencia</button>
                    <button v-if="contacto.estadotelefono4 == 1" class="btn btn-success btninci" @click="gIncidencia4">Guardar incidencia</button>
                    <button v-if="contacto.estadotelefono5 == 1" class="btn btn-success btninci" @click="gIncidencia5">Guardar incidencia</button>
                </div>
            </div>
        </div>
        
        <div class="next">          
            <button type="button" class="btn btn-info" id="btnEncuestaFinalizada" @click="finalizarEncuesta" hidden>Encuesta finalizada</button>
        </div>

        <div class="container contIncidencia" style="">
            <h1>Incidencias</h1>
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
            </vue-good-table>
        </div>      
    </div>
</template>

<script>

export default ({
    data() {
        return{
            contacto:{
                id:'',
                rut:'',
                tipo:'',
                programa:'',
                nombre:'',
                sexo:'',
                pais:'',
                telefono1:'',
                telefono2:'',
                telefono3:'',
                telefono4:'',
                telefono5:'',
                incidencia1:'',
                incidencia2:'',
                incidencia3:'',
                incidencia4:'',
                incidencia5:'',
                estado:'',
                estadotelefono1:'',
                estadotelefono2:'',
                estadotelefono3:'',
                estadotelefono4:'',
                estadotelefono5:'',
                ultimo_contacto:'',
                link:'',
                estado_encuesta:''
            },
            columns: [
                {
                label: 'Teléfono',
                field: 'telefono',
                },
                {
                label: 'CDF',
                field: 'nombre',
                },
                {
                label: 'Fecha de incidencia',
                field: 'fecha',
                },
            ],
            rows: [],
            incidenciasCont:[],
            nuevaIncidencia:{
                idcontacto:'',
                incidencia:'',
                telefono:'',              
            },
            incidencias: [
                {nombre:'Encuesta Parcial',
                value:'1',
                },
                {nombre:'Interrupcion',
                value:'2',
                },
                {nombre:'Encuestado nunca disponible',
                value:'3',
                },
                {nombre:'Mala calidad de audio de la llamada',
                value:'4',
                },
                {nombre:'Ubicación/ actividad que no permite realizar una entrevista',
                value:'5',
                },
                {nombre:'Teléfono fuera de servicio',
                value:'6',
                },
                {nombre:'No contactado/Ocupado',
                value:'7',
                },
                {nombre:'Teléfono siempre ocupado',
                value:'8',
                },
                {nombre:'Contestador telefónico',
                value:'9',
                },
                {nombre:'Rechazo del entrevistado',
                value:'10',
                },
                {nombre:'Muerte',
                value:'11',
                },
                {nombre:'Incapacidad física y / o mental del entrevistado',
                value:'12',
                },
                {nombre:'Barrera de idioma',
                value:'13',
                },
                {nombre:'Otros casos de no disponibilidad',
                value:'14',
                },
                {nombre:'Empresa u oficina',
                value:'15',
                },
                {nombre:'Institucion o unidad residencial',
                value:'16',
                },
                {nombre:'Persona no perteneciente al hogar',
                value:'17',
                },
            ],
            link:'',          
        }     
    },
    mounted(){
        this.cargarContacto();
        
        
    },
    methods:{
        cargarContacto(){
            axios.get('/api/obtenerContacto/'+this.$route.query.sort)
            .then(response =>{
                if(response.data[0]=== undefined)
                { 
                    this.$router.push({ name: 'lista'});
                    Toast.fire({icon: 'error',title: 'Sin contactos disponibles'});
                }
                else{
                    this.contacto= response.data[0];
                    this.cargarIncidencias();
                    $('#iniEncuesta').attr('href', this.contacto.link)
                }
                
            })
            .catch(e=>{
                console.log(e);
            })
        },
        cargarIncidencias(){
            axios.get('/api/inciContacto/'+this.contacto.id)
            .then(response=>{
                this.rows = response.data;
            })
            .catch(e=>{
                console.log(e);
            })
        },
        gIncidencia1(){
            this.nuevaIncidencia.idcontacto = this.contacto.id;
            this.nuevaIncidencia.telefono = this.contacto.telefono1;
            this.nuevaIncidencia.incidencia = this.contacto.incidencia1;
            if(this.contacto.incidencia1 == 10 || this.contacto.incidencia1 == 11 || this.contacto.incidencia1 == 12 || this.contacto.incidencia1 == 13 || this.contacto.incidencia1 == 14 || this.contacto.incidencia1 == 15 || this.contacto.incidencia1 == 16 || this.contacto.incidencia1 == 17)
            {
                this.contacto.estado = 'Cerrado';
            }
            else if (this.contacto.incidencia1 == 6 || this.contacto.incidencia1 == 9 )
            {
                this.contacto.estadotelefono1 = 0;
            }
            axios.post('/api/incidencia1',this.contacto)
            .then(response=>{
                this.guardarIncidencia();
                this.cargarIncidencias();
                Toast.fire({icon: 'success',title: 'Se ha subido correctamente!'});
            })
            .catch(e=>{
                    console.log(e);
            })
        },
        gIncidencia2(){
            this.nuevaIncidencia.idcontacto = this.contacto.id;
            this.nuevaIncidencia.telefono = this.contacto.telefono2;
            this.nuevaIncidencia.incidencia = this.contacto.incidencia2;
            if(this.contacto.incidencia2 == 10 || this.contacto.incidencia2 == 11 || this.contacto.incidencia2 == 12 || this.contacto.incidencia2 == 13 || this.contacto.incidencia2 == 14 || this.contacto.incidencia2 == 15 || this.contacto.incidencia2 == 16 || this.contacto.incidencia2 == 17)
            {
                this.contacto.estado = 'Cerrado';
            }
            else if (this.contacto.incidencia2 == 6 || this.contacto.incidencia2 == 9 )
            {
                this.contacto.estadotelefono2 = 0;
            }
            axios.post('/api/incidencia2',this.contacto)
            .then(response=>{
                this.guardarIncidencia();
                this.cargarIncidencias();
                Toast.fire({icon: 'success',title: 'Se ha subido correctamente!'});
            })
            .catch(e=>{
                    console.log(e);
            })
        },
        gIncidencia3(){
            this.nuevaIncidencia.idcontacto = this.contacto.id;
            this.nuevaIncidencia.telefono = this.contacto.telefono3;
            this.nuevaIncidencia.incidencia = this.contacto.incidencia3;
            if(this.contacto.incidencia3 == 10 || this.contacto.incidencia3 == 11 || this.contacto.incidencia3 == 12 || this.contacto.incidencia3 == 13 || this.contacto.incidencia3 == 14 || this.contacto.incidencia3 == 15 || this.contacto.incidencia3 == 16 || this.contacto.incidencia3 == 17)
            {
                this.contacto.estado = 'Cerrado';
            }
            else if (this.contacto.incidencia3 == 6 || this.contacto.incidencia3 == 9 )
            {
                this.contacto.estadotelefono3 = 0;
            }
            axios.post('/api/incidencia3',this.contacto)
            .then(response=>{
                this.guardarIncidencia();
                this.cargarIncidencias();
                Toast.fire({icon: 'success',title: 'Se ha subido correctamente!'});
            })
            .catch(e=>{
                    console.log(e);
            })
        },
        gIncidencia4(){
            this.nuevaIncidencia.idcontacto = this.contacto.id;
            this.nuevaIncidencia.telefono = this.contacto.telefono4;
            this.nuevaIncidencia.incidencia = this.contacto.incidencia4;
            if(this.contacto.incidencia4 == 10 || this.contacto.incidencia4 == 11 || this.contacto.incidencia4 == 12 || this.contacto.incidencia4 == 13 || this.contacto.incidencia4 == 14 || this.contacto.incidencia4 == 15 || this.contacto.incidencia4 == 16 || this.contacto.incidencia4 == 17)
            {
                this.contacto.estado = 'Cerrado';
            }
            else if (this.contacto.incidencia4 == 6 || this.contacto.incidencia4 == 9 )
            {
                this.contacto.estadotelefono4 = 0;
            }
            axios.post('/api/incidencia4',this.contacto)
            .then(response=>{
                this.guardarIncidencia();
                this.cargarIncidencias();
                Toast.fire({icon: 'success',title: 'Se ha subido correctamente!'});
            })
            .catch(e=>{
                    console.log(e);
            })
        },
        gIncidencia5(){
            this.nuevaIncidencia.idcontacto = this.contacto.id;
            this.nuevaIncidencia.telefono = this.contacto.telefono5;
            this.nuevaIncidencia.incidencia = this.contacto.incidencia5;
            if(this.contacto.incidencia5 == 10 || this.contacto.incidencia5 == 11 || this.contacto.incidencia5 == 12 || this.contacto.incidencia5 == 13 || this.contacto.incidencia5 == 14 || this.contacto.incidencia5 == 15 || this.contacto.incidencia5 == 16 || this.contacto.incidencia5 == 17)
            {
                this.contacto.estado = 'Cerrado';
            }
            else if (this.contacto.incidencia5 == 6 || this.contacto.incidencia5 == 9 )
            {
                this.contacto.estadotelefono5 = 0;
            }
            axios.post('/api/incidencia5',this.contacto)
            .then(response=>{
                this.guardarIncidencia();
                this.cargarIncidencias();
                Toast.fire({icon: 'success',title: 'Se ha subido correctamente!'});
            })
            .catch(e=>{
                    console.log(e);
            })
        },
        guardarIncidencia(){
            axios.post('/api/incidencia',this.nuevaIncidencia)
            .then(response=>{
                this.nuevaIncidencia.idcontacto = '';
                this.nuevaIncidencia.telefono = '';
                this.nuevaIncidencia.incidencia = '';
            })
            .catch(e=>{
                    console.log(e);
            })
        },
        nuevoContacto(){
            this.cargarContacto();
            $('#btnEncuestaFinalizada').prop('hidden', true);
        },
        btnInicioEncuesta(){
            this.contacto.estado_encuesta = 1;
            axios.post('/api/gInicioEncuesta', this.contacto)
            .then(response=>{
                $('#btnEncuestaFinalizada').prop('hidden', false);
            })
            .catch(e=>{
                console.log(e);
            })
        },
        finalizarEncuesta(){
            this.contacto.estado = 'Finalizado';
            axios.post('/api/fEncuesta', this.contacto)
            .then(response=>{
                this.nuevoContacto();
            })
            .catch(e=>{
                console.log(e);
            })
        }


    },
    updated() {
        if(this.contacto.incidencia1 === null || this.contacto.incidencia1 === ''){
            $("#btnIncidencia1").prop('disabled',true);
        }
        else{
            $("#btnIncidencia1").prop('disabled',false);
        }
        if(this.contacto.incidencia2 === null || this.contacto.incidencia2 === ''){
            $("#btnIncidencia2").prop('disabled',true);
        }
        else{
            $("#btnIncidencia2").prop('disabled',false);
        }
        if(this.contacto.incidencia3 === null || this.contacto.incidencia3 === ''){
            $("#btnIncidencia3").prop('disabled',true);
        }
        else{
            $("#btnIncidencia3").prop('disabled',false);
        }
        if(this.contacto.incidencia4 === null || this.contacto.incidencia4 === ''){
            $("#btnIncidencia4").prop('disabled',true);
        }
        else{
            $("#btnIncidencia4").prop('disabled',false);
        }
        if(this.contacto.incidencia5 === null || this.contacto.incidencia5 === ''){
            $("#btnIncidencia5").prop('disabled',true);
        }
        else{
            $("#btnIncidencia5").prop('disabled',false);
        }
    },
})
</script>

<style>
.container-main{
    margin: 40px;
    
}
.btninci{
    margin-top: 31px;
    width: 100%;
}
.selectinci{
    margin-top: 31px;
}
.tworow{
    margin-top: 10px;
}
.contIncidencia{
    background-color: #BBEEED; 
    margin-top: 25px;
}
.next{
    margin-top: 10px;
    display: flex;
    justify-content: center;
}
.btncontacto{
    position:absolute; 
    right:40px;
}
</style>