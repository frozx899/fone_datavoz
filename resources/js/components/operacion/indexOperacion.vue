<template>
    <div class="container-main">
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
                    <label for="">Teléfono 2</label>
                    <input type="text" name="custom2" class="form-control" disabled v-model="contacto.telefono2">
                    <label for="">Teléfono 3</label>
                    <input type="text" name="custom3" class="form-control" disabled v-model="contacto.telefono3">
                    <label for="">Teléfono 4</label>
                    <input type="text" name="custom3" class="form-control" disabled v-model="contacto.telefono4">
                    <label for="">Teléfono 5</label>
                    <input type="text" name="custom3" class="form-control" disabled v-model="contacto.telefono5">
                </div>
                <div class="col-7">
                    <label for="">Código de disposición final</label>
                    <select name="" id="" class="form-control">
                        <option value="" selected>Seleccionar incidencia</option>
                        <option v-for="inci in incidencias" v-bind:key="inci.nombre" v-bind:value="inci.value"> {{ inci.nombre }}</option>
                    </select>
                    
                    <select name="" id="" class="form-control selectinci">
                        <option value="" selected>Seleccionar incidencia</option>
                        <option v-for="inci in incidencias" v-bind:key="inci.nombre" v-bind:value="inci.value"> {{ inci.nombre }}</option>
                    </select>
                    
                    <select name="" id="" class="form-control selectinci">
                        <option value="" selected>Seleccionar incidencia</option>
                        <option v-for="inci in incidencias" v-bind:key="inci.nombre" v-bind:value="inci.value"> {{ inci.nombre }}</option>
                    </select>
                    
                    <select name="" id="" class="form-control selectinci">
                        <option value="" selected>Seleccionar incidencia</option>
                        <option v-for="inci in incidencias" v-bind:key="inci.nombre" v-bind:value="inci.value"> {{ inci.nombre }}</option>
                    </select>
                    
                    <select name="" id="" class="form-control selectinci">
                        <option value="" selected>Seleccionar incidencia</option>
                        <option v-for="inci in incidencias" v-bind:key="inci.nombre" v-bind:value="inci.value"> {{ inci.nombre }}</option>
                    </select>
                </div>
                <div class="col-1">           
                    <button class="btn btn-success btninci">Guardar</button>
                    <button class="btn btn-success btninci">Guardar</button>
                    <button class="btn btn-success btninci">Guardar</button>
                    <button class="btn btn-success btninci">Guardar</button>
                    <button class="btn btn-success btninci">Guardar</button>
                </div>
            </div>
        </div>
        
        <div class="next">
            <a href="#" type="button" class="btn btn-info" target="_blank"> Siguiente encuestado</a>
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
            },
            columns: [
                {
                label: 'ID',
                field: 'id',
                },
                {
                label: 'CdF',
                field: 'nombre',
                },
                {
                label: 'Fecha de incidencia',
                field: 'codigo',
                },
            ],
            rows: [],
            incidencias:[],
            nuevaIncidencia:{
                contacto_id:this.$route.params.id,
                nombre_inidencia:"",
                detalle:"",
                telefono:"",              
            },
            incidencias: [
                {nombre:'Encuesta Parcial',
                value:'Encuesta Parcial',
                },
                {nombre:'Interrupcion',
                value:'Interrupcion',
                },
                {nombre:'Encuestado nunca disponible',
                value:'Encuestado nunca disponible',
                },
                {nombre:'Mala calidad de audio de la llamada',
                value:'Mala calidad de audio de la llamada',
                },
                {nombre:'Ubicación/ actividad que no permite realizar una entrevista',
                value:'Ubicación/ actividad que no permite realizar una entrevista',
                },
                {nombre:'Teléfono fuera de servicio',
                value:'Teléfono fuera de servicio',
                },
                {nombre:'No contactado/Ocupado',
                value:'No contactado/Ocupado',
                },
                {nombre:'Teléfono siempre ocupado',
                value:'Teléfono siempre ocupado',
                },
                {nombre:'Contestador telefónico',
                value:'Contestador telefónico',
                },
                {nombre:'Rechazo del entrevistado',
                value:'Rechazo del entrevistado',
                },
                {nombre:'Muerte',
                value:'Muerte',
                },
                {nombre:'Incapacidad física y / o mental del entrevistado',
                value:'Incapacidad física y / o mental del entrevistado',
                },
                {nombre:'Barrera de idioma',
                value:'Barrera de idioma',
                },
                {nombre:'Otros casos de no disponibilidad',
                value:'Otros casos de no disponibilidad',
                },
                {nombre:'Empresa u oficina',
                value:'Empresa u oficina',
                },
                {nombre:'Institucion o unidad residencial',
                value:'Institucion o unidad residencial',
                },
                {nombre:'Persona no perteneciente al hogar',
                value:'Persona no perteneciente al hogar',
                },

            ],
            
        }
        
    },
    mounted(){
        this.cargarContacto();
    },
    methods:{
        cargarContacto(){
            axios.get('/api/obtenerContacto/'+this.$route.query.sort)
            .then(response =>{
                this.contacto= response.data[0];
            })
            .catch(e=>{
                console.log(e);
            })
        },
        cargarIncidencias(){
            console.log(this.$route.query.sort)
            console.log(this.contacto)
            console.log(this.contacto.nombre)
        },

    }
})
</script>

<style>
.container-main{
    margin: 40px;
    
}
.btninci{
    margin-top: 31px;
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
</style>