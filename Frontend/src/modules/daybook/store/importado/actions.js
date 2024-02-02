import api from '@/api/authApi'
import Swal from 'sweetalert2';

async function obtenerToken() {
  const token = await localStorage.getItem('token');
  return token;
}


export const loadImportados = async ({ commit }) => {

  const token = await obtenerToken();

 
    const data  = await api.get('/list/excel',{
      headers: {
        'Authorization': `Bearer ${token}`
      },
    });


    if ( !data.data){
        commit('setImportado', [] )
        return
    }

    

    const importados = []
    for( let id of Object.keys( data.data ) ) {
      importados.push({
            id,
            ...data.data[id]
        })
    }
    

    commit('setImportado', importados )
}


export const uploadExcel = async ({ commit }, {formData, data} ) => {

  const token = await obtenerToken();

  commit('stateload')
  
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


export const deleteExcel = async ({ commit }, id ) => {

  const token = await obtenerToken();

  try {
      const response = await api.delete('/delete/excel/'+id, {
        headers: {
          'Authorization': `Bearer ${token}`
        },
      });


      console.log("asasa")
      // Si la solicitud se realizó correctamente
      if (response.status === 200) {
        // Muestra la alerta de éxito
        commit('deleteExcel', id )

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



