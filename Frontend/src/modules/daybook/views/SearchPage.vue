<template>
        
    <div class="w-full h-auto mt-20 flex justify-center ">
        <span class="p-input-icon-left w-11/12 lg:w-1/2 mx-4">
            <i class="pi pi-search" />
            <InputText v-model="searchTerm" @input="search"  class="w-full" placeholder="Buscar" />
        </span>
    </div>

    <div class="w-full h-auto mt-5 flex justify-center">

        <div class="w-11/12 lg:w-1/2">

            <div v-for="(item, index) in searchResults" :key="index" class=" w-full h-auto bg-gray-50 rounded-lg mb-4 p-2 px-3 mt-4 hover:shadow-lg">
                <router-link :to="item.link" exact-active-class="bg-gray-100 text-blue-600 rounded-md">
                    <p class="font-sans font-semibold text-gray-700 cursor-pointer hover:underline "> {{item.name}} </p>
                </router-link>
                
                <p> {{item.description}} </p>
                <p class="font-sans font-semibold cursor-pointer hover:underline">{{item.type}} </p>
            </div>

        </div>

    </div>

</template>

<script>
import { ref, onMounted } from "vue";
import { ProductService } from '../service/ProductService';
import { SearchService } from '../service/SearchService';


export default {

    setup() {
        const products = ref();

        onMounted(() => {
        ProductService.getProductsSmall().then((data) => (products.value = data.slice(0, 9)));
        });

        return {
        products,

        };
    },
    props:{
       parametroSearch:String,
    },
    methods: {
    
        contenido(value){
            
            this.question = value.question
            this.content = value.content
            this.visible = true

        },

        search() {
            // Filtrar resultados basados en el término de búsqueda

            this.searchResults = this.allData.filter(item =>
                item.name.toLowerCase().includes(this.searchTerm.toLowerCase())
            );
        },

    },
    computed: {

        noticiasFiltradas() {
            // Filtrar las noticias basándose en la búsqueda
            return this.products.filter(noticia =>
                noticia.name.toLowerCase().includes(this.search.toLowerCase())
            );
        }
    
    },

    data(){

        return{
            searchTerm: '',
            searchResults: [],
            allData: SearchService.getSearchsData(),
            
        }
    },
   
    created(){

        this.searchTerm = this.parametroSearch

        this. searchResults = SearchService.getSearchsData()

   
    }
}
</script>

<style>

</style>