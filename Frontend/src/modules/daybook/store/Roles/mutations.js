

export const setRoles = ( state, roles ) => {

    state.roles = []
    state.roles = [ ...state.roles, ...roles ]
    state.isLoading = false
}

export const setAllPermisos = ( state, permisos ) => {

    state.allPermisos = []
    state.allPermisos = [ ...state.allPermisos, ...permisos ]
    state.isLoading = false
}

export const setPermisos = ( state, permisos ) => {

    state.allPermisos = []
    state.allPermisos = [ ...state.allPermisos, ...permisos ]
    state.isLoading = false
}

export const updatePermiso = ( state, permiso  ) => { 
    
    const idx = state.allPermisos.map( e => e.id ).indexOf( permiso.data.id )
    state.allPermisos[idx] = permiso.data
    
}

export const addOffices = (state, office ) => {
    
    state.offices = [ office.data, ...state.offices  ]
}
