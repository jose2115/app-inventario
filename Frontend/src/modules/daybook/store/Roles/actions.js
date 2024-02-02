import countryApi from '@/api/authApi'
import Swal from 'sweetalert2';

async function obtenerToken() {
  const token = await localStorage.getItem('token');
  return token;
}

export const loadRoles = async ({ commit }) => {

  const token = await obtenerToken();

    const data  = await countryApi.get('/role/list',{
      headers: {
        'Authorization': `Bearer ${token}`
      },
    });

    if ( !data.data.data){
        commit('setRoles', [] )
        return
    }

    commit('setRoles', data.data.data )
    

    
}

export const loadRolesConfig = async ({ commit }) => {

  const token = await obtenerToken();

  const data  = await countryApi.get('/config/roles/list',{
    headers: {
      'Authorization': `Bearer ${token}`
    },
  });

  if ( !data.data.data){
      commit('setRoles', [] )
      return
  }

  commit('setRoles', data.data.data )
  

  
}

export const loadAllPermisos = async ({ commit }) => {

  const token = await obtenerToken();

  const data  = await countryApi.get('/all/permission',{
    headers: {
      'Authorization': `Bearer ${token}`
    },
  });

  if ( !data.data.data){
      commit('setAllPermisos', [] )
      return
  }

  

  const entries = []
  for( let id of Object.keys( data.data.data ) ) {
      entries.push({
          id,
          ...data.data.data[id]
      })
  }
  

  commit('setAllPermisos', entries )
}

export const loadPermisos = async ({ commit }, id) => {

  const token = await obtenerToken();

  const data  = await countryApi.get('/role/permissions/list/'+id,{
    headers: {
      'Authorization': `Bearer ${token}`
    },
  });

  if ( !data.data.data){
      commit('setPermisos', [] )
      return
  }

  const entries = []
  for( let id of Object.keys( data.data.data ) ) {
      entries.push({
          id,
          ...data.data.data[id]
      })
  }
  

  commit('setPermisos', entries )
}

export const changeStatePermiso = async ({ commit }, data ) => {

  const token = await obtenerToken();

  try {
      const response = await countryApi.get('/role/'+data.rol+'/permission/'+data.permiso+'/'+data.accion, {
        headers: {
          'Authorization': `Bearer ${token}`
        },
      });
      // Si la solicitud se realizó correctamente
      if (response.status === 200) {
        // Muestra la alerta de éxito
        commit('updatePermiso', response.data )


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
