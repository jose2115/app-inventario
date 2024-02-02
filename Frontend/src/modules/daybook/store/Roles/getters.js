
export const getRoles = ( state ) => ( term = '' ) => {
    
     return state.roles
}

export const getPermisos = ( state ) => ( term = '' ) => {
     console.log("bbbbb", state.allPermisos)
     return state.permisos
}

export const getAllPermisos = ( state ) => ( term = '' ) => {
    
     console.log("aaaaaa", state.allPermisos)
     return state.allPermisos
}




