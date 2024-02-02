<template>
        
<div class="lg:px-24 lg:py-24 md:py-20 md:px-44 px-4 py-24 items-center flex justify-center flex-col-reverse lg:flex-row md:gap-28 gap-16">
            <div class="xl:pt-24 w-full xl:w-1/2 relative pb-12 lg:pb-0">
                <div class="relative">
                    <div class="absolute">
                        <div class="">
                            <h1 class="my-2 text-gray-800 font-bold text-2xl">
                                La pagina se encuentra en construcción
                            </h1>
                            <p class="my-2 text-gray-800">Lo sentimos. Vuelve al inicio del sitio web.</p>
                            <router-link to="/" exact-active-class="bg-gray-100 text-blue-600 rounded-md">
                            <button class="sm:w-full lg:w-auto my-2 border rounded md py-4 px-8 text-center bg-portal text-white hover:bg-portalhover focus:outline-none focus:ring-2 focus:ring-indigo-700 focus:ring-opacity-50">Volvir a Inicio!</button>
                            </router-link>
                        </div>
                    </div>
                    <div>
                        
                    </div>
                </div>
            </div>
            <div>
                <img src="https://i.ibb.co/ck1SGFJ/Group.png" />
            </div>
        </div>
</template>

<script>



export default {

    props:{
       
    },
    methods: {
    
        contenido(value){
            
            this.question = value.question
            this.content = value.content
            this.visible = true

        }

    },
    computed: {

    
    },

    data(){

        return{
            visible:false,
            value: 'https://portal.zonaparqueo.com/wp-content/uploads/2023/10/figura-4-removebg-preview.png',
            question: '',
            content: '',
            
        }
    },
   
    created(){
   
    }
}
</script>

<style>

</style>