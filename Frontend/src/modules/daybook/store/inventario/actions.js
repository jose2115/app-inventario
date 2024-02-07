import api from '@/api/authApi'
import Swal from 'sweetalert2';

async function obtenerToken() {
  const token = await localStorage.getItem('token');
  return token;
}


export const searchProduct = async ({ commit }, {code, zona}  ) => {

  const token = await obtenerToken();

  try {
      const response = await api.get('/show/product/'+code, {
        headers: {
          'Authorization': `Bearer ${token}`
        },
      });

      if (response.data.status == 'ok') {
        // Muestra la alerta de éxito
        const data = [
          {
            'prod': response.data.data,
            'zona': zona
          }
        ]

        const objetoUnido = await addItem(data);

        commit('addItems', objetoUnido )

      }

      
    } catch (error) {
      // Si la solicitud falla, maneja el error aquí
    }

}


async function addItem (data) {

  
  const objetoUnido = {  ...data[0].prod[0], ...data[0].zona };

  Object.keys(data[0].prod[0]).forEach(key => {
    if (!(key in objetoUnido)) {
      objetoUnido[key] = data[0].prod[0][key];
    }
  });
  
  Object.keys(data[0].zona).forEach(key => {
    if (!(key in objetoUnido)) {
      objetoUnido[key] = data[0].zona[key];
    }
  });

  objetoUnido.product_id = data[0].prod[0].id
  objetoUnido.zona_id    = data[0].zona.id
  objetoUnido.unidad     = 1

  return objetoUnido;
  
}


export const deleteItems = async({commit}) => {

  commit('deleteItems');
}

export const deleteItem = async({commit}, id) => {

  commit('deleteItem', id )
}



export const loadZonas = async ({ commit }) => {

  const token = await obtenerToken();
 
    const data  = await api.get('/list/zonas',{
      headers: {
        'Authorization': `Bearer ${token}`
      },
    });


    if ( !data.data.data){
        commit('setZonas', [] )
        return
    }

    console.log("zonas", data.data.data)

    const zonas = []
    for( let id of Object.keys( data.data.data ) ) {
      zonas.push({
            id,
            ...data.data.data[id]
        })
    }

    commit('setZonas', zonas )
}

export const loadZonasPublic = async ({ commit }) => {

  const token = await obtenerToken();
 
    const data  = await api.get('/list/public/zonas',{
      headers: {
        'Authorization': `Bearer ${token}`
      },
    });


    if ( !data.data.data){
        commit('setZonasPublic', [] )
        return
    }

    const zonas = []
    for( let id of Object.keys( data.data.data ) ) {
      zonas.push({
            id,
            ...data.data.data[id]
        })
    }

    commit('setZonasPublic', zonas )
}

export const createZona = async ({ commit }, data ) => {

  const token = await obtenerToken();

  try {
      const response = await api.post('/create/zona', data, {
        headers: {
          'Authorization': `Bearer ${token}`
        },
      });

      if (response.status === 200) {
        // Muestra la alerta de éxito
        commit('addZona', response.data.data )

        console.log("zona ", response.data)

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

export const editZona = async ({ commit }, data ) => {

  const token = await obtenerToken();

  try {
      const response = await api.post('/update/zona/'+data.id, data, {
        headers: {
          'Authorization': `Bearer ${token}`
        },
      });

      if (response.status === 200) {
        // Muestra la alerta de éxito
        commit('updateZona', response.data.data )

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

export const deleteZona = async ({ commit }, id ) => {

  const token = await obtenerToken();

  try {
      const response = await api.delete('/delete/zona/'+id, {
        headers: {
          'Authorization': `Bearer ${token}`
        },
      });

      if (response.data.status == 'ok') {
        // Muestra la alerta de éxito
        commit('deleteZona', id )
      }

      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: response.data.smg,
        showConfirmButton: false,
        timer: 1500
      })

      
    } catch (error) {
      // Si la solicitud falla, maneja el error aquí
    }

}



export const updateUnidad = async ({commit}, data ) => {

  data.data.unidad = parseInt(data.unidad, 10);

  commit('updateUnidad', data)
}



export const sendData = async ({commit}, data) => {

  const token = await obtenerToken();

  const items = 
   {'items': data}
  
  console.log("enviado data", items)

  try {
    const response = await api.post('/add/items/inventario', items, {
      headers: {
        'Authorization': `Bearer ${token}`
      },
    });

    if (response.status === 200) {
      // Muestra la alerta de éxito
      commit('deleteItems');

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



//productos contados
export const loadHistorial = async ({ commit }) => {

  const token = await obtenerToken();
 
  const data  = await api.get('/historial/list',{
    headers: {
      'Authorization': `Bearer ${token}`
    },
  });


  if ( !data.data){
      commit('setHistorial', [] )
      return
  }

  

  const historial = []
  for( let id of Object.keys( data.data.data ) ) {
    historial.push({
          id,
          ...data.data.data[id]
      })
  }
  

  commit('setHistorial', historial )
}


//buscar historial
export const searchHistory = async ({ commit }, code ) => {

  const token = await obtenerToken();

  try {
      const response = await api.get('/show/historial/'+code, {
        headers: {
          'Authorization': `Bearer ${token}`
        },
      });

      if (response.data.status == 'ok') {
        // Muestra la alerta de éxito
       
        commit('addHistorial', response.data.data[0] )

      }

      
    } catch (error) {
      // Si la solicitud falla, maneja el error aquí
    }

}








///lista de inventarios

export const loadInventarios = async({ commit }) => {

  const token = await obtenerToken();

    const data  = await api.get('/list/inventario',{
      headers: {
        'Authorization': `Bearer ${token}`
      },
    });


    if ( !data.data){
        commit('setInventarios', [] )
        return
    }

    

    const inventarios = []
    for( let id of Object.keys( data.data.data ) ) {
      inventarios.push({
            id,
            ...data.data.data[id]
        })
    }
    

    commit('setInventarios', inventarios )

}


export const createInventario = async ({ commit }, data ) => {

  const token = await obtenerToken();

  try {
      const response = await api.post('/create/inventario', data, {
        headers: {
          'Authorization': `Bearer ${token}`
        },
      });

      if (response.status === 200) {
        // Muestra la alerta de éxito
        commit('addInventario', response.data.data )

        console.log("zona ", response.data)

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

export const selectInventario = async ({commit}, id) => {

  const token = await obtenerToken();

  try {
    const response = await api.get('/select/inventario/'+id, {
      headers: {
        'Authorization': `Bearer ${token}`
      },
    });

    if (response.status === 200) {
      // Muestra la alerta de éxito
      //commit('deleteItems');

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

export const deleteInventario = async ({commit}, id) => {

  const token = await obtenerToken();

  try {
    const response = await api.delete('/delete/inventario/'+id, {
      headers: {
        'Authorization': `Bearer ${token}`
      },
    });

    if (response.status === 200) {
      // Muestra la alerta de éxito
      commit('deleteInventario', id);

    }
  } catch (error) {

    // Si la solicitud falla, maneja el error aquí
  }

}





