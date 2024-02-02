<template>

<!-- header page -->
    <div class="w-full h-9 fixed z-50 bg-white flex justify-center md:justify-end items-center ">
    
            <span class="p-input-icon-left bg-white w-11/12  md:w-1/4 ">
                <i class="pi pi-search" />
                <InputText size="small" class="h-8 w-full md:w-32"  v-model="searchTerm" @input="handleInput" @keyup.enter="handleEnter" @blur="search" placeholder="Buscar" />
                
            </span>
   
    </div>
    <header   class="w-full h-24 flex bg-portal fixed mt-9 z-40 items-center lg:justify-center">
        <!-- logo -->

        

        <div class="flex w-full justify-between lg:justify-center px-2 lg:w-3/4 h-auto">

            <div class=" flex justify-around">
                <div class="flex items-center cursor-pointer">
                    <router-link to="/" exact-active-class="">
                        <img class="h-24 lg:w-auto " src="../../../assets/zpp.png" alt="plchldr.co" />
                    </router-link>
                    
                    <img class="h-24 ml-4 " src="../../../assets/franja.png" alt="plchldr.co" />
                </div>
                <div class="hidden lg:flex w-auto px-12">
                    <ul class="flex font-semibold cursor-pointer">
                        <li @mouseover="handleMouseOut" >
                            <router-link to="/" exact-active-class="bg-gray-100 text-blue-600 rounded-md">
                                <a class="text-center flex items-center  py-2 px-4 h-24 hover:bg-portalhover text-white"> Inicio</a>
                            </router-link>
                            
                        </li>
                        <li @mouseover="handleMouseOver(1)"  >
                            <router-link to="/conocenos" exact-active-class="bg-gray-100 text-blue-600 rounded-md">
                                <a class="text-center flex items-center  py-2 px-4 h-24 hover:bg-portalhover text-white">Conócenos</a>
                            </router-link>
                            <ul  v-if="isconocenos" class="absolute h-auto z-50 bg-portal ">
                                <router-link to="/conocenos" exact-active-class="bg-gray-100 text-blue-600 rounded-md">
                                    <li    class=" w-full px-4 py-3 flex justify-center items-center hover:bg-portalhover  text-white">
                                        ¿Quiénes somos?
                                    </li>
                                </router-link>
                                <router-link to="/conocenos" exact-active-class="bg-gray-100 text-blue-600 rounded-md">
                                    <li class=" w-full px-4 py-3 flex justify-center items-center hover:bg-portalhover text-white">
                                        Normatividad
                                    </li>
                                </router-link>
                                
                                <a href="https://www.terminaldetransporte.gov.co/la-entidad/transparencia-y-acceso-a-la-informacion-publica/" target="_blank">
                                <li class=" w-full px-4 py-3 flex justify-center items-center hover:bg-portalhover text-white">
                                    Ley de transparencia
                                </li>
                                </a>
                                
                                
                            </ul>
                        </li>
                        <li @mouseover="handleMouseOver(2)" >
                            <router-link to="/estacionate" exact-active-class="bg-gray-100 text-blue-600 rounded-md">
                                <a class="text-center flex items-center  py-2 px-4 h-24 hover:bg-portalhover text-white" > Estaciónate</a>
                            </router-link>
                            <ul  v-if="isestacionate" class="absolute h-auto z-50 bg-portal  ">
                                <router-link to="/estacionate" exact-active-class="bg-gray-100 text-blue-600 rounded-md">
                                    <li    class=" w-full px-4 py-3 flex justify-center items-center hover:bg-portalhover  text-white">
                                        ¿Donde estamos?
                                    </li>
                                </router-link>

                                <router-link to="/estacionate" exact-active-class="bg-gray-100 text-blue-600 rounded-md">
                                    <li class=" w-full px-4 py-3 flex justify-center items-center hover:bg-portalhover  text-white">
                                        ¿Como usarlas?
                                    </li>
                                </router-link>
                                
                                <li class=" w-full px-4 py-3 flex justify-center items-center hover:bg-portalhover  text-white">
                                    Horarios y Tarifas
                                </li>

                                <router-link to="/estacionate" exact-active-class="bg-gray-100 text-blue-600 rounded-md">
                                    <li class=" w-full px-4 py-3 flex justify-center items-center hover:bg-portalhover  text-white">
                                        Politicas de CEPOS
                                    </li>
                                </router-link>
                                
                                
                            </ul>
                        </li>
                        <li @mouseover="handleMouseOver(3)" >
                            <router-link to="/atencion-al-ciudadano" exact-active-class="aver text-blue-600 rounded-md">
                            <a class="text-center flex items-center  py-2 px-4 h-24 hover:bg-portalhover text-white" > Atención al ciudadano</a>
                            </router-link> 

                            <ul  v-if="isciudadano" class="absolute h-auto z-50 bg-portal ">
                                <li    class=" w-full px-4 py-3 flex justify-center items-center hover:bg-portalhover  text-white">
                                    Preguntas frecuentes
                                </li>
                                <li class=" w-full px-4 py-3 flex justify-center items-center hover:bg-portalhover  text-white">
                                    Canales de atencion
                                </li>
                                <li class=" w-full px-4 py-3 flex justify-center items-center hover:bg-portalhover  text-white">
                                    PQRS
                                </li>
                                <li class=" w-full px-4 py-3 flex justify-center items-center hover:bg-portalhover  text-white">
                                    Gobierno abierto
                                </li>
                                
                            </ul>

                        </li>
                        <li @mouseover="handleMouseOut" >
                            <router-link to="/noticia/nvklal433" exact-active-class="bg-portalhover text-blue-600 rounded-md">
                            <a class="text-center flex items-center   py-2 px-4 h-24 hover:bg-portalhover  text-white" >Enterate</a>
                            </router-link> 
                        </li>
                        <!-- <li >
                            <router-link to="/alianzas" exact-active-class="bg-gray-100 text-blue-600 rounded-md">
                                <a class="text-center flex items-center  py-2 px-4 h-24 hover:bg-portalhover text-white" > Alianzas</a>
                            </router-link>
                        </li>
                        <li >
                            <router-link to="/enterate" exact-active-class="bg-gray-100 text-blue-600 rounded-md">
                                <a class="text-center flex items-center  py-2 px-4 h-24 hover:bg-portalhover text-white" > Entérate</a>
                            </router-link>
                            
                        </li> -->
                    
                    </ul>
                </div>
                <div class="w-auto h-24 flex justify-center items-center pl-10 lg:pl-2">
                
                        <div class="w-full flex text-white">
                            <a href="https://www.instagram.com/zonadeparqueopago/" target="_blank" rel="noopener noreferrer">
                                <img class="h-8 w-auto" src="../../../assets/iconos/instagram-white.png" alt="plchldr.co" />
                            </a>
                            <a href="https://www.facebook.com/ZonaDeParqueoPago" target="_blank" rel="noopener noreferrer">
                                <img class="h-8 w-auto" src="../../../assets/iconos/facebook-white.png" alt="plchldr.co" />
                            </a>
                            <a href="https://twitter.com/ZonaParqueoPago" target="_blank" rel="noopener noreferrer">
                                <img class="h-8 w-auto" src="../../../assets/iconos/x-white.png" alt="plchldr.co" />
                            </a>
                        </div>
                    
            
                    
                </div>
            </div>
            
            <div class="h-24 flex lg:hidden items-center">
                <span @click="onMenu" class="text-white text-3xl pi pi-bars"></span>
            </div>
            
        </div>
        
    </header>

    <div  @mouseover="handleMouseOut" class="w-full lg:h-48 z-30 fixed mt-12 cursor-pointer">
       
    </div>

    <div v-if="menu" class="w-full h-screen fixed bg-portal z-50 mt-32 pt-5">
        <ul @click="menu=false" class="w-full text-xl font-semibold">
                    <li >
                        <router-link to="/" exact-active-class="bg-gray-100 text-blue-600 rounded-md">
                            <a class="text-center flex items-center  py-2 px-4 h-20 hover:bg-portalhover text-white"> Inicio</a>
                        </router-link>
                    </li>
                    <li >
                        <router-link to="/conocenos" exact-active-class="bg-gray-100 text-blue-600 rounded-md">
                            <a class="text-center flex items-center  py-2 px-4 h-20 hover:bg-portalhover text-white">Conócenos</a>
                        </router-link>
                    </li>
                    <li >
                        <router-link to="/estacionate" exact-active-class="bg-gray-100 text-blue-600 rounded-md">
                            <a class="text-center flex items-center  py-2 px-4 h-20 hover:bg-portalhover text-white" > Estaciónate</a>
                        </router-link>
                        
                    </li>
                    <li >
                        <router-link to="/atencion-al-ciudadano" exact-active-class="bg-gray-100 text-blue-600 rounded-md">
                        <a class="text-center flex items-center  py-2 px-4 h-20 hover:bg-portalhover text-white" > Atención al ciudadano</a>
                        </router-link> 
                    </li>
                    <li >
                        <router-link to="/noticia/nvklal433" exact-active-class="bg-portalhover text-blue-600 rounded-md">
                        <a class="text-center flex items-center   py-2 px-4 h-24 hover:bg-portalhover  text-white" >Enterate</a>
                        </router-link> 
                    </li>
                    <!-- <li >
                        <router-link to="/alianzas" exact-active-class="bg-gray-100 text-blue-600 rounded-md">
                            <a class="text-center flex items-center  py-2 px-4 h-20 hover:bg-portalhover text-white" > Alianzas</a>
                        </router-link>
                    </li>
                    <li >
                        <router-link to="/enterate" exact-active-class="bg-gray-100 text-blue-600 rounded-md">
                            <a class="text-center flex items-center  py-2 px-4 h-20 hover:bg-portalhover text-white" > Entérate</a>
                        </router-link>
                        
                    </li> -->
                   
        </ul>

        <div class="w-12 h-2 z-30 flex justify-center mt-4 ">
            <div class="flex ">
                <a href="https://api.whatsapp.com/send/?phone=573059393333&text&type=phone_number&app_absent=0" target="_blank">
                    <span class="pi pi-whatsapp text-4xl text-white mr-4"></span>
                </a>
                <a href="https://play.google.com/store/apps/details?id=com.parqueadero.parqueaderos&pli=1" target="_blank">
                    <span class="pi pi-android text-4xl text-white mr-4"></span>
                </a>
                <a href="https://apps.apple.com/co/app/zpp-bogot%C3%A1/id6450557001?l=en-GB" target="_blank">
                    <span class="pi pi-apple text-4xl text-white"></span>
                </a>
            </div>
            
        </div>
    </div>

    <div class="w-12 h-2 hidden fixed z-40 top-48 right-0 lg:flex justify-end ">
        <div>
            <a href="https://api.whatsapp.com/send/?phone=573059393333&text&type=phone_number&app_absent=0" target="_blank">
                <img class="h-12 lg:w-auto cursor-pointer " src="../../../assets/whatsapp.png" alt="plchldr.co" />
            </a>
            <a href="https://play.google.com/store/apps/details?id=com.parqueadero.parqueaderos&pli=1" target="_blank">
                <img class="h-12 lg:w-auto cursor-pointer" src="../../../assets/playstore.png" alt="plchldr.co" />
            </a>
            <a href="https://apps.apple.com/co/app/zpp-bogot%C3%A1/id6450557001?l=en-GB" target="_blank">
                <img class="h-12 lg:w-auto cursor-pointer bg-gray-100" src="../../../assets/iphone.png" alt="plchldr.co" />
            </a>
            
        </div>
        
    </div>

    <!-- <Chat class="z-40" ></Chat> -->


</template>

<script>

import { defineAsyncComponent } from 'vue'


export default {

    components: {
        Chat: defineAsyncComponent(() => import('../components/Chat.vue')),
    },

    methods: {
    
        onMenu(){
            this.menu = !this.menu;
        },

        handleInput() {
            // Limpiar el temporizador existente si existe
            clearTimeout(this.typingTimer);

            // Configurar un nuevo temporizador
            this.typingTimer = setTimeout(() => {
                // Realizar la redirección después del tiempo de espera
                this.$router.push({ path: '/search/' + this.searchTerm });
            }, this.typingTimeout);
        },
        handleEnter() {
            // Realizar la redirección al presionar "Enter"
            this.$router.push({ path: '/search/' + this.searchTerm });
        },

        search() {
            // Filtrar resultados basados en el término de búsqueda

            console.log("Buscar ", this.searchTerm)

            // Utilizar la propiedad $route para construir la URL
            const ruta = {
                name: "enterate",
                
            };

            console.log('Ruta:', ruta);

            if (this.searchTerm.trim() !== '') {
                
                this.$router.push({ path: '/search/' + this.searchTerm});
    
            } else {
                console.error('El término de búsqueda no puede estar vacío');
            }

            // Redirigir a la ruta construida
            
   
        },

        handleMouseOver(value) {
        

            if(value == 1){
                this.isconocenos = true;
                this.isestacionate = false;
                this.isciudadano = false;
            }

            if(value == 2 ){
                this.isconocenos = false;
                this.isestacionate = true;
                this.isciudadano = false;
            }

            if(value == 3 ){
                this.isconocenos = false;
                this.isestacionate = false;
                this.isciudadano = true;
            }
            
        },

        handleMouseOut() {
            this.isconocenos = false;
            this.isestacionate = false;
            this.isciudadano = false;
        },

        

    },
    computed: {

    
    },

    data(){

        return{
            menu: false,
            searchTerm: '',
            typingTimer: null,
            typingTimeout: 1000,
            isconocenos:false,
            isestacionate:false,
            isciudadano:false,
        }
    },
   
    created(){
   
    }
}

</script>

<style>

.aver{
    background-color: aqua;
}
</style>