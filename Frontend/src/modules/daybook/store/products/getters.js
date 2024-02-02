
export const getProductos = ( state ) => ( search ) => {

     console.log("buscar", search)
     const resultados = buscarRegistros(search, state.productos);

     return resultados;

}

export const getProduct = ( state ) => ( search ) => {

  
  const resultados = buscarProducts(search, state.productos);
  console.log("buscar producto", state.productos)
  return resultados;

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


   function buscarProducts(search, data) {
    // Normaliza el parámetro de búsqueda
    const parametroBusqueda = normalizeString(search);
  
    // Filtra los registros que cumplen con los criterios de búsqueda
    const resultadosFinales = data.filter(registro => {
      // Normaliza los campos de texto en los registros y verifica si el parámetro de búsqueda es igual a al menos uno de los campos normalizados
      return ['cod-barra-1', 'cod-barra-2', 'cod-barra-3'].some(prop =>
        normalizeString(registro?.[prop]) === parametroBusqueda
      );
    });
  
    return resultadosFinales;
  }





