import api from '@/api/authApi'
import Swal from 'sweetalert2';

async function obtenerToken() {
  const token = await localStorage.getItem('token');
  return token;
}

export const loadProducts = async ({ commit }) => {

  const token = await obtenerToken();

    const data  = await api.get('/list/products',{
      headers: {
        'Authorization': `Bearer ${token}`
      },
    });

    if ( !data.data){
        commit('setProductos', [] )
        return
    }

    

    const productos = []
    for( let id of Object.keys( data.data.data ) ) {
      productos.push({
            id,
            ...data.data.data[id]
        })
    }
    

    commit('setProductos', productos )
}


export const uploadExcel = async ({ commit }, {formData, data} ) => {

  const token = await obtenerToken();

  try {
      const response = await api.post('/upload/data', formData,{
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'multipart/form-data',
        },
      });

      console.log("data", response.data.data)

      if (response.status === 200) {
        // Muestra la alerta de éxito
        commit('addImportado', response.data.data )

        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: response.data.smg,
          showConfirmButton: false,
          timer: 1500
        })
      }
    } catch (error) {

      console.log("error ", error)

    }

}

export const searchProduct = async ({ commit }, code ) => {

  const token = await obtenerToken();

  try {
      const response = await api.get('/show/product/'+code, {
        headers: {
          'Authorization': `Bearer ${token}`
        },
      });

      if (response.data.status == 'ok') {
        // Muestra la alerta de éxito
       
        commit('addProduct', response.data.data[0] )

      }

      
    } catch (error) {
      // Si la solicitud falla, maneja el error aquí
    }

}



