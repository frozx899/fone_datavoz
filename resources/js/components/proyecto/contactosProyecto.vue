<template>
    <div class="container-main">
        <select name="" id="" v-model="id_proyecto" class="form-control">
            <option value="" selected>Seleccione un proyecto</option>
            <option v-for="proy in proyectos" v-bind:key="proy.codigo" v-bind:value="proy.codigo"> {{proy.nombre}}</option>
        </select>

        <div class="row subida" v-if="id_proyecto != ''">
                        <!--Form agregar Datos Trabajadores-->
                        <div class="">
                            <form @submit.prevent="submitFile">
                                <div class="text-center border-right border-left">
                                    <h2>Contactos</h2><br>
                                    <div class="form-group">
                                        <input type="file" name="file" id="file" accept=".csv"
                                        @change="handleFileUpload($event)" ref="myFileInput"><br>
                                        <a href="/csv/ejemploCallFone.csv" download="">Archivo Base</a>
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-success mb-2" name="submit">Ingresar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            proyectos :[],
            id_proyecto: '',
            file:'',

        }
    },
    mounted(){
        this.cargarProyectos();
    },
    methods: {
        cargarProyectos(){
            axios.get('/api/proyectoActivos')
            .then(response=>{
                this.proyectos = response.data;
            })
            .catch(e=>{
                console.log(e)
            })
        },
        handleFileUpload(event){
                this.file = event.target.files[0];
        },
        submitFile(){
                let formData = new FormData();
                formData.append('file', this.file);
                formData.append('id_proyecto', this.id_proyecto);
                if(this.file == ''){
                    Toast.fire({icon: 'warning',title: 'Seleccione un archivo!'});
                }else{
                    axios.post('/api/importCSVContactos',
                    formData,{headers: {'Content-Type': 'multipart/form-data'}})
                    .then((response)=>{
                        Toast.fire({icon: 'success',title: 'Se ha subido correctamente!'});
                    }).catch(e=>{
                        console.log(e)
                        Toast.fire({icon: 'error',title: 'Ocurrió un error! Formato de fecha debe ser 2022 - 11 - 05'});
                    });
                   
                }
        },

    }

}

</script>

<style>
.container-main{
  margin: 40px;
  
}
.subida {
    margin-top: 10px;
}

</style>