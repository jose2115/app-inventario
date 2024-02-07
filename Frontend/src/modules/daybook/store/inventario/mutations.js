

export const addItems = ( state, item) => {

    console.log("agregando...", item.description)
    state.items = [ item, ...state.items  ]
}

export const deleteItems = ( state ) => {
    
    state.items  = []
}

export const deleteItem = (state, position) => {
    state.items = state.items.filter((_, index) => index !== position);
};



export const setZonas = ( state, zonas ) => {
    state.zonas = []
    state.zonas = [ ...state.zonas, ...zonas ]
}

export const setZonasPublic = ( state, zonas ) => {
    state.zonasPublic = []
    state.zonasPublic = [ ...state.zonasPublic, ...zonas ]
}

export const addZona = (state, zona ) => {
    
    state.zonas = [ zona, ...state.zonas  ]

}

export const updateZona = ( state, zona  ) => { 
    
    const idx = state.zonas.map( e => e.id ).indexOf( zona.id )
    state.zonas[idx] = zona
    
}

export const deleteZona = ( state, id ) => {
    
    state.zonas = state.zonas.filter( zona => zona.id !== id )
}





export const updateUnidad = ( state, data  ) => { 
    
    console.log("unidad", state.items[0] )

    const idx = data.index
    state.items[idx] = data.data
    
}

export const addImportado = (state, importado ) => {
    
    state.importados = [ importado, ...state.importados  ]
    state.messageError = ''
}


export const setHistorial = ( state, historial ) => {
    state.historial = []
    state.historial = [ ...state.historial, ...historial]
}

export const addHistorial = (state, historia ) => {
    
    const hExist = state.historial.filter( histo => histo.id == historia.id )

    console.log("estado ", state.historial)
    console.log("response ", hExist)
    if(hExist.length == 0){

        state.historial = [ historia, ...state.historial  ]
    }
    

}


//inventarios
export const setInventarios = (state, inventarios ) => {

    state.inventarios = []
    state.inventarios = [...state.inventarios, ...inventarios]
}


export const addInventario = (state, inventario ) => {
    
    state.inventarios = [ inventario, ...state.inventarios  ]

}

export const deleteInventario = ( state, id ) => {
    
    state.inventarios = state.inventarios.filter( inventario => inventario.id !== id )
}





