
// export const myGetter = ( state ) => {
//  return state
// }


export const currentState = ( state ) => {
    return state.status
}

export const username = ( state ) => {
    return state.user?.name || ''
}

export const userId = ( state ) => {
    return state.user?.id || ''
}


export const getUser = ( state ) => {
    return state.user
}

export const getImageUser = ( state ) => {
    return state.userImage
}


export const getRoles = ( state ) => {
    return state.roles
}





export const getPermission = ( state ) => ( term = '' ) => {
    return state.permission
}

export const getMessageError = ( state ) => {
    return state.messageError
}

export const getNotifications = ( state ) => ( term = '' ) => {
    return state.notification
}



