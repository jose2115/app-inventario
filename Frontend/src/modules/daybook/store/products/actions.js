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






export const loadRemitentesPublic = async ({ commit }) => {

  const token = await obtenerToken();

  const data  = await countryApi.get('/public/remitente/list',{
    headers: {
      'Authorization': `Bearer ${token}`
    },
  });

  if ( !data.data.data){
      commit('setRemitente', [] )
      return
  }

  const entries = []
  for( let id of Object.keys( data.data.data ) ) {
      entries.push({
          id,
          ...data.data.data[id]
      })
  }
  

  commit('setRemitente', entries )
}

export const createRemitente = async ({ commit }, data ) => {

  const token = await obtenerToken();

        try {
            const response = await countryApi.post('/remitente/create', data, {
              headers: {
                'Authorization': `Bearer ${token}`
              },
            });

            if (response.status === 200) {
              // Muestra la alerta de éxito
              commit('addRemitente', response.data )

              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: response.data.smg,
                showConfirmButton: false,
                timer: 1500
              })
            }
          } catch (error) {

            const data = {
              email :  error.response.data.errors.email[0],
              identification: error.response.data.errors.identification[0] 
            }
            commit('messageError', data)
            // Si la solicitud falla, maneja el error aquí
          }

}

export const editRemitente = async ({ commit }, data ) => {


  const token = await obtenerToken();

        try {
            const response = await countryApi.post('/remitente/update/'+data.id, data, {
              headers: {
                'Authorization': `Bearer ${token}`
              },
            });
            // Si la solicitud se realizó correctamente
            if (response.status === 200) {
              // Muestra la alerta de éxito
              commit('updateRemitente', response.data )

              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: response.data.smg,
                showConfirmButton: false,
                timer: 1500
              })
            }
          } catch (error) {
            // Si la solicitud falla, maneja el error aquí
          }

}

//changeStateRemitente

export const changeStateRemitente = async ({ commit }, id ) => {


  const token = await obtenerToken();

  try {
      const response = await countryApi.get('/remitente/changeState/'+id, {
        headers: {
          'Authorization': `Bearer ${token}`
        },
      });
      // Si la solicitud se realizó correctamente
      if (response.status === 200) {
        // Muestra la alerta de éxito
        commit('updateChangeState', response.data )

        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: response.data.smg,
          showConfirmButton: false,
          timer: 1500
        })
      }
    } catch (error) {
      // Si la solicitud falla, maneja el error aquí
    }

}

export const deleteRemitente = async ({ commit }, id ) => {

  const token = await obtenerToken();

  try {
            const response = await countryApi.get('/route/delete/'+id, {
              headers: {
                'Authorization': `Bearer ${token}`
              },
            });
            // Si la solicitud se realizó correctamente
            if (response.status === 200) {
              // Muestra la alerta de éxito
              commit('deleteRoutes', id )

              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: response.data.smg,
                showConfirmButton: false,
                timer: 1500
              })
            }
          } catch (error) {
            // Si la solicitud falla, maneja el error aquí
          }

}
