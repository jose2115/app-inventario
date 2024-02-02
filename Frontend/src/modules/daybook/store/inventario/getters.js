
export const getZonas = ( state ) => ( term = '' ) => {
     return state.zonas
}


export const getZonasPublic = ( state ) => ( term = '' ) => {
  return state.zonasPublic
}


export const getItems = ( state ) => ( search ) => {

     const resultados = buscarItems(search, state.items);

     return resultados;
}


export const getHistorial  = ( state ) => ( search ) =>  {

     const resultados = buscarRegistros(search, state.historial);

     return resultados;
}


export const getInventarios = ( state ) => ( term = '' ) => {
     return state.inventarios
}



export const getMessageError = ( state ) => {
     return state.messageError
 }

function normalizeString(str) {
     return typeof str === 'string' ? str.toLowerCase().trim() : '';
}


 function buscarRegistros(search, data) {
     // Normaliza el parámetro de búsqueda
     const parametroBusqueda = normalizeString(search);
   
     // Filtra los registros que cumplen con los criterios de búsqueda
     const resultadosFinales = data.filter(registro => {
       // Normaliza los campos de texto en los registros y verifica si el parámetro de búsqueda se encuentra en al menos uno de los campos normalizados
       return [
         'name',
         'total',
         'color',
         'talla',
         'zona',
         'ref',
         'cod-barra-1',
         'cod-barra-2',
         'cod-barra-3',
       ].some(prop =>
         normalizeString(registro?.[prop]).includes(parametroBusqueda)
       );
     });
   
     return resultadosFinales;
   }



   function buscarItems(search, data) {
     // Normaliza el parámetro de búsqueda
     const parametroBusqueda = normalizeString(search);
   
     // Filtra los registros que cumplen con los criterios de búsqueda
     const resultadosFinales = data.filter(registro => {
       // Normaliza los campos de texto en los registros y verifica si el parámetro de búsqueda se encuentra en al menos uno de los campos normalizados
       return [
         'description',
         'unidad',
         'color',
         'talla',
         'zona',
         'ref',
         'cod-barra-1',
         'cod-barra-2',
         'cod-barra-3',
       ].some(prop =>
         normalizeString(registro?.[prop]).includes(parametroBusqueda)
       );
     });
   
     return resultadosFinales;
   }







