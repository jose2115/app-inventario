import api from '@/api/authApi'
import Swal from 'sweetalert2';

async function obtenerToken() {
  const token = await localStorage.getItem('token');
  return token;
}



export const editUser = async ({ commit }, data ) => {

  const token = await obtenerToken();

        try {
            const response = await api.put('/user/update/'+data.id, data, {
              headers: {
                'Authorization': `Bearer ${token}`
              },
            });
            // Si la solicitud se realizó correctamente
            if (response.status === 200) {
              // Muestra la alerta de éxito
              console.log("actualizando ", response.data)
              commit('setProfile', response.data.data)

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

export const changePassword = async ({ commit }, data ) => {

  const token = await obtenerToken();

  try {
      const response = await api.post('/user/change/password', data, {
        headers: {
          'Authorization': `Bearer ${token}`
        },
      });
      // Si la solicitud se realizó correctamente
      if (response.status === 200) {
        // Muestra la alerta de éxito
        console.log("actualizando ", response.data)
        //commit('setProfile', response.data.data)

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

export const uploadUser = async ({ commit }, data ) => {

  const token = await obtenerToken();

  try {
      const response = await api.post('/user/upload', data, {
        headers: {
          'Authorization': `Bearer ${token}`
        },
      });
      // Si la solicitud se realizó correctamente

      if (response.status === 200) {
        // Muestra la alerta de éxito
        console.log("resouensta ", response.data.data.url)
        const entries = response.data
        commit('setImage', response.data.data.url )

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

export const loadImage = async ({ commit }, data ) => {

  const token = await obtenerToken();
  
  try {
      const response = await api.get('/user/profile', {
        headers: {
          'Authorization': `Bearer ${token}`
        },
      });
      // Si la solicitud se realizó correctamente

      if (response.status === 200) {
        // Muestra la alerta de éxito

        if(response.data.image){
          commit('setImage', response.data.image )
        }
        
        commit('setProfile', response.data.data)
        
      }
    } catch (error) {
      // Si la solicitud falla, maneja el error aquí
    }

}




