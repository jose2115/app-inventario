import authApi from '@/api/authApi'
import Swal from 'sweetalert2';

async function obtenerToken() {
  const token = await localStorage.getItem('token');
  return token;
}

export const createUser = async ({ commit }, user ) => {

  const token = await obtenerToken();

    const { name, email, password } = user

    try {
        
        const { data } = await authApi.post(':signUp', { email, password, returnSecureToken: true })
        const { idToken, refreshToken } = data

        await authApi.post(':update', { displayName: name, idToken, refreshToken })
        
        delete user.password
        commit('loginUser', { user, idToken, refreshToken })

        return { ok: true }

    } catch (error) {
        return { ok: false, message: error.response.data.error.message }
    }

}


export const changePassword = async ({ commit }, data ) => {

  const token = await obtenerToken();

  try {
      const response = await authApi.post('/change/password', data, {
        headers: {
          'Authorization': `Bearer ${token}`
        },
      });
      // Si la solicitud se realizó correctamente
      if (response.status === 200) {

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


export const signInUser = async ({ commit }, user ) => {

  const token = await obtenerToken();

    const { email, password } = user

    try {
        
        const { data } = await authApi.post('/login', { email, password, returnSecureToken: true })
        const { displayName, idToken, refreshToken } = data
        
        user.name = displayName

        commit('loginUser', { user, idToken, refreshToken })

        return { ok: true }

    } catch (error) {
        return { ok: false, message: error.response.data.error.message }
    }

}

export const login = async ({ commit }, data ) => {

  const token = await obtenerToken();


        try {
            
            const response = await authApi.post('/login', data);
            console.log("error", response.data)
            if (response.status === 200) {
              // Muestra la alerta de éxito
              commit('loginUser', response.data.token )

              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Bienvenido',
                showConfirmButton: false,
                timer: 1500
              })
              //retornar ruta en la vista
            }else{

                Swal.fire({
                  position: 'top-end',
                  icon: 'error',
                  title: response.data.error,
                  showConfirmButton: false,
                  timer: 1500
                })
                
                
            }
          } catch (error) {

              Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: error.response.data.error,
                showConfirmButton: false,
                timer: 1500
              })
 
            //commit('messageError', error.response.data.message)
          }

}


export const checkAuthentication = async ({ commit }) => {
    
    
    const token      = localStorage.getItem('token')
    const refreshToken = localStorage.getItem('refreshToken')

    if( !token ) {
        commit('logout')
        return { ok: false, message: 'No hay token' }
    }

    try {
        const response = await authApi.get('/show/user',{
          headers: {
            'Authorization': `Bearer ${token}`
          },
        });
        // Si la solicitud se realizó correctamente
        if (response.status === 200) {

          
          // Muestra la alerta de éxit
          const roles = []

          response.data.roles.forEach(element => {
            roles.push(element)
          });
          
          commit('setPermission', response.data.permisos )
          commit('setRoles',roles )
          commit('setUser', response.data.data)
          commit('setImageUser', response.data.image)
        
          
          return { ok: true }

        }
      } catch (error) {
        commit('logout')
      }


}


export const notificationUser = async ({ commit }, ) => {

  
  const token = localStorage.getItem('token')

  try {
      const response = await authApi.get('/user/notification',{
        headers: {
          'Authorization': `Bearer ${token}`
        },
      });
      // Si la solicitud se realizó correctamente
      if (response.status === 200) {

          if ( !response.data.data){
            commit('setNotification', [] )
            return
        }
    
        const notification = []
        for( let id of Object.keys( response.data.data ) ) {
          notification.push({
                id,
                ...response.data.data[id]
            })
        }

        console.log("notificaciones ", notification)
    
        commit('setNotification', notification )

      }
    } catch (error) {
      
    }

}

export const logout = async ({ commit },) => {

  const token = await obtenerToken();
  
  try {
    const response = await authApi.get('/logout',{
      headers: {
        'Authorization': `Bearer ${token}`
      },
    });
    // Si la solicitud se realizó correctamente
    if (response.status === 200) {

      commit('logout')

    }
  } catch (error) {

    // Si la solicitud falla, maneja el error aquí
  }


}

