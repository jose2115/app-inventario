
// export const myAction = ( state ) => {

// }
import router from '@/router';


export const loginUser = ( state, token) => {

    router.push({name: 'Home'})
    
    if ( token ) {
        localStorage.setItem( 'token', token )
        state.token = token
    }

    state.status = 'authenticated'
}

export const verifyAuthenticated = (state) => {

    state.status = 'authenticated'
}

export const setUser = (state, user ) => {

    state.user = user

}

export const setImageUser = (state, image ) => {

    state.userImage = image

}

export const setPermission = (state, permisos ) => {

    localStorage.setItem( 'permisos', permisos )
}

export const setRoles = (state, roles ) => {

    state.roles = roles
    localStorage.setItem( 'roles', roles )
}


export const logout = (state) => {
    
    state.user = null
    state.token = null
    state.refreshToken = null
    state.status = 'not-authenticated'

    localStorage.removeItem('token')
    localStorage.removeItem('permisos')
    localStorage.removeItem('roles')

    router.push({ name: 'login' })

}

export const messageError = (state, message) => {

    state.messageError = message
}


export const setNotification = ( state, notification ) => {
    state.notification = []
    state.notification = [ ...state.notification, ...notification ]
}