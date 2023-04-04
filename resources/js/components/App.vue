<template>
    <div class="container-main">
      <section class="h-100 gradient-form" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="https://www.datavoz.cl/prueba.datavoz.cl/logo.png"
                    style="width: 185px;" alt="logo">
                  <h4 class="mt-1 mb-5 pb-1">Equipo Datavoz/Statcom</h4>
                </div>

                <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <p>Ingrese su cuenta</p>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="email">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Dirección de correo" />
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <div class="text-center pt-1 mb-5 pb-1">
                    <button class="btn btn-dark btn-block fa-lg gradient-custom-2 mb-3" type="submit"><b>{{ __('Login') }}</b> </button>
                  </div>


                </form>

              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4"><b> Hablar fielmente por otros, esa es nuestra motivación</b></h4>
                <p class="small mb-0" style="text-align: justify;">
                  En Datavoz hacemos investigación aplicada en ciencias sociales. Nuestra especialidad es el desarrollo de 
                  estudios de alta complejidad metodológica mediante técnicas cuantitativas y cualitativas.
                  <br>
                  <br>
                  Con más de 25 años de experiencia, somos reconocidos en el mercado como una empresa experta en el diseño y selección de 
                  muestras, realización y levantamiento de encuestas, procesamiento y análisis estadístico de información. Así también 
                  en la aplicación de técnicas cualitativas como focus groups, entrevistas en profundidad y en el diseño y construcción 
                  de sistemas de información como en el manejo de base de datos de diferentes tamaños y complejidad.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
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
.gradient-custom-2 {
/* fallback for old browsers */
background: #fccb90;



/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(90deg, #ffff45 0, #ffff3a 12.5%, #fffe31 25%, #ede92a 37.5%, #c4d225 50%, #9eba22 62.5%, #7da520 75%, #60911f 87.5%, #47801f 100%);
}

@media (min-width: 768px) {
.gradient-form {
height: 100vh !important;
}
}
@media (min-width: 769px) {
.gradient-custom-2 {
border-top-right-radius: .3rem;
border-bottom-right-radius: .3rem;
}
}
</style>