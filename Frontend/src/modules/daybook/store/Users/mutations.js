

export const setUsers = ( state, users ) => {
    state.users = []
    state.users = [ ...state.users, ...users ]
    state.isLoading = false
}


export const addUser = (state, user ) => {
    
    state.users = [ user.data, ...state.users  ]
    state.messageError = ''
}

export const updateUser = ( state, user  ) => { 
    
    const idx = state.users.map( e => e.id ).indexOf( user.data.id )
    state.users[idx] = user.data
    
}

export const updateChangeState = ( state, user  ) => { 
    
    const idx = state.users.map( e => e.id ).indexOf( user.data.id )
    state.users[idx] = user.data
    
}

export const messageError = (state, data) => {

    state.messageError.email = data.email

}
