

export const setImportado = ( state, importados ) => {
    state.importados = []
    state.importados = [ ...state.importados, ...importados ]
    state.isLoading = false
}

export const updateRoutes = ( state, route  ) => { 
    
    const idx = state.routes.map( e => e.id ).indexOf( route.data.id )
    state.routes[idx] = route.data
    
}

export const addImportado = (state, importado ) => {
    
    state.importados = [ importado, ...state.importados  ]
    state.messageError = ''
    state.isLoading = false
}

export const deleteExcel = ( state, id ) => {
    
    state.importados = state.importados.filter( importado => importado.id !== id )
}


export const messageError = (state, data) => {

    state.messageError.email = data.email
    state.messageError.identification = data.identification

    console.log("errores", state.messageError )
}

export const stateload = (state) => {

    state.isLoading = true
}
