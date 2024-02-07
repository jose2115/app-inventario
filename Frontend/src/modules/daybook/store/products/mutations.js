

export const setProductos = ( state, productos ) => {
    state.productos = []
    state.productos = [ ...state.productos, ...productos ]
    state.isLoading = false
}

export const updateRoutes = ( state, route  ) => { 
    
    const idx = state.routes.map( e => e.id ).indexOf( route.data.id )
    state.routes[idx] = route.data
    
}

export const addProduct = (state, product) => {

    const pExist = state.productos.filter( prod => prod.id == product.id )
    
    if(pExist.length == 0){
        state.productos = [product, ...state.productos]
    }
    
}

export const addImportado = (state, importado ) => {
    
    state.importados = [ importado, ...state.importados  ]
    state.messageError = ''
}



export const updateChangeState = ( state, remitente  ) => { 
    
    const idx = state.remitentes.map( e => e.id ).indexOf( remitente.data.id )
    state.remitentes[idx] = remitente.data
    
}

export const deleteRoutes = ( state, id ) => {
    
    state.routes = state.routes.filter( route => route.id !== id )
}

export const messageError = (state, data) => {

    state.messageError.email = data.email
    state.messageError.identification = data.identification

    console.log("errores", state.messageError )
}
