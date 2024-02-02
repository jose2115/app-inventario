import api from '@/api/authApi'
import Swal from 'sweetalert2';

async function obtenerToken() {
  const token = await localStorage.getItem('token');
  return token;
}

export const loadUsers = async ({ commit }) => {

  const token = await obtenerToken();

    const data  = await api.get('/list/user',{
      headers: {
        'Authorization': `Bearer ${token}`
      },
    });

    console.log("usuarios ", data)

    if ( !data.data.data){
        commit('setUsers', [] )
        return
    }

    const entries = []
    for( let id of Object.keys( data.data.data ) ) {
        entries.push({
            id,
            ...data.data.data[id]
        })
    }
    
    console.log("usuarios a", entries)

    commit('setUsers', entries )
}

export const createUser = async ({ commit }, data ) => {

  const token = await obtenerToken();

        try {
            const response = await api.post('/register/user', data, {
              headers: {
                'Authorization': `Bearer ${token}`
              },
            });

            if (response.status === 200) {
              // Muestra la alerta de éxito
              commit('addUser', response.data )

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

export const editUser = async ({ commit }, data ) => {

  const token = await obtenerToken();

        try {
            const response = await api.post('/update/user/'+data.id, data, {
              headers: {
                'Authorization': `Bearer ${token}`
              },
            });
            // Si la solicitud se realizó correctamente
            if (response.status === 200) {
              // Muestra la alerta de éxito
              ///console.log("actualizando ", response.data)
              commit('updateUser', response.data )

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
              email :  error.response.data.data.email[0],
            }
    
            commit('messageError', data)
            // Si la solicitud falla, maneja el error aquí
          }

}


export const changeStateUser = async ({ commit }, id ) => {

  const token = await obtenerToken();

  try {
      const response = await api.get('/changeState/user/'+id, {
        headers: {
          'Authorization': `Bearer ${token}`
        },
      });
      // Si la solicitud se realizó correctamente
      if (response.status === 200) {
        // Muestra la alerta de éxito
        commit('updateUser', response.data )
        //commit('updateChangeState', response.data )

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

